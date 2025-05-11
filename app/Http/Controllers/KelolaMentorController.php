<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\User; // Asumsi model User untuk mentee
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KelolaMentorController extends Controller
{
    /**
     * Display a listing of the mentors.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mentors = Mentor::all(); // Atau gunakan pagination: Mentor::paginate(10);
        return view('pages.kelolamentor.index', compact('mentors'));
    }

    /**
     * Display the details of a specific mentor and their mentees.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\View\View
     */
    public function show(Mentor $mentor)
    {
        // Eager load relasi mentees jika ada
        $mentor->load('mentees'); // Asumsi relasi di model Mentor adalah 'mentees'
        return view('pages.kelolamentor.show_mentee', compact('mentor'));
    }

    /**
     * Store a newly created mentor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mentors',
            'password' => 'required|string|min:8|confirmed',
            'posisi' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mentor = Mentor::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'posisi' => $request->posisi,
        ]);

        return response()->json(['success' => 'Mentor berhasil ditambahkan.'], 201);
    }

    /**
     * Add a mentee to the specified mentor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMentee(Request $request, Mentor $mentor)
    {
        $validator = Validator::make($request->all(), [
            'mentee_user_id' => 'required|exists:users,id', // Pastikan user dengan ID ini ada
            'institusi' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date|after:periode_mulai',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Asumsi ada relasi 'mentees' pada model Mentor (many-to-many dengan pivot table)
        $mentor->mentees()->attach($request->mentee_user_id, [
            'institusi' => $request->institusi,
            'posisi' => $request->posisi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Mentee berhasil ditambahkan ke mentor.'], 200);
    }

    /**
     * Remove a mentee from the specified mentor.
     *
     * @param  \App\Models\Mentor  $mentor
     * @param  int  $menteeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMentee(Mentor $mentor, $menteeId)
    {
        // Asumsi ada relasi 'mentees' pada model Mentor
        $mentor->mentees()->detach($menteeId);

        return response()->json(['success' => 'Mentee berhasil dihapus dari mentor.'], 200);
    }

    /**
     * Update the status of the specified mentor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Mentor $mentor)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mentor->status = $request->status;
        $mentor->save();

        return response()->json(['success' => 'Status mentor berhasil diperbarui.']);
    }

    /**
     * Remove the specified mentor from storage.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Mentor $mentor)
    {
        // Hapus semua relasi dengan mentee terlebih dahulu (jika ada)
        $mentor->mentees()->detach();
        $mentor->delete();

        return response()->json(['success' => 'Mentor berhasil dihapus.']);
    }
}
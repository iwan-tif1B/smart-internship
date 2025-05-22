<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- Pastikan ini ada dan mengarah ke model User Anda
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
// Menggunakan model Instansi // Ini adalah komentar, bukan impor yang dibutuhkan Laravel.


class ProfileAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data dummy untuk pengguna
        // Jika Anda menggunakan autentikasi Laravel, lebih baik ambil user dari Auth::user()
        // Daripada data dummy, kecuali ini hanya untuk tujuan pengembangan awal.
        // Misalnya: $user = Auth::user();
        $user = (object)[
            'name' => 'Budi Santoso',
            'position' => 'Senior Web Developer',
            'email' => 'budi.santoso@example.com'
        ];
        return view('pages.profile.index', compact('user')); // Sesuaikan nama view jika perlu
    }

    /**
     * Memperbarui profil pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        /** @var User $user */ // <-- Tambahkan DocBlock ini untuk memberi petunjuk tipe ke linter
        $user = Auth::user();

        // Validasi data input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], // Validasi untuk foto
        ]);

        // Perbarui data pengguna
        $user->name = $request->input('name');
        $user->position = $request->input('position');
        $user->email = $request->input('email');

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada dan bukan placeholder
            // Pastikan 'profile_photo_path' adalah nama kolom yang benar di database Anda
            if ($user->profile_photo_path && $user->profile_photo_path !== 'images/profile_placeholder.jpg') {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path; // Simpan path di database
            // Anda juga bisa menyimpan URL publik jika diperlukan, contoh: $user->profile_photo_url = Storage::url($path);
        }

        $user->save();

        return redirect()->route('profileadmin.show')->with('success', 'Profil berhasil diperbarui!');
    }
}

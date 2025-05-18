<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Search by judul, pagination 10
        $kriteria = Kriteria::where('nama', 'like', '%' . request('nama') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mendapatkan semua posisi untuk dropdown di form.
        $posisi = Posisi::all();

        // Mengembalikan view 'kriteria.create' dengan data posisi.
        return view('kriteria.create', compact('posisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form.
        $validator = Validator::make($request->all(), [
            'posisi_id' => 'required|exists:posisi,id',
            'personal' => 'required|array',
            'personal.*' => 'required|string|max:255',
            'kompetensi' => 'required|array',
            'kompetensi.*' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan response error.
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Memulai transaksi database.
        DB::beginTransaction();
        try {
            // Membuat kriteria untuk bagian "Personal".
            foreach ($request->personal as $kriteriaPersonal) {
                Kriteria::create([
                    'posisi_id' => $request->posisi_id,
                    'jenis' => 'personal',
                    'nama' => $kriteriaPersonal,
                ]);
            }

            // Membuat kriteria untuk bagian "Kompetensi".
            foreach ($request->kompetensi as $kriteriaKompetensi) {
                Kriteria::create([
                    'posisi_id' => $request->posisi_id,
                    'jenis' => 'kompetensi',
                    'nama' => $kriteriaKompetensi,
                ]);
            }

            // Melakukan commit transaksi jika semua operasi berhasil.
            DB::commit();

            // Mengembalikan response sukses.
            return redirect()->route('kriteria.index')->with('success', 'Kriteria penilaian berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Melakukan rollback transaksi jika terjadi error.
            DB::rollback();

            // Mengembalikan response error dengan pesan error.
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kriteria penilaian: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        // Mengembalikan view 'kriteria.show' dengan data kriteria.
        return view('kriteria.show', compact('kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        // Mendapatkan semua posisi untuk dropdown di form.
        $posisi = Posisi::all();

        // Mengembalikan view 'kriteria.edit' dengan data kriteria dan posisi.
        return view('kriteria.edit', compact('kriteria', 'posisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        // Validasi data yang masuk dari form.
        $validator = Validator::make($request->all(), [
            'posisi_id' => 'required|exists:posisi,id',
            'jenis' => 'required|in:personal,kompetensi',
            'nama' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan response error.
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update data kriteria.
        $kriteria->update([
            'posisi_id' => $request->posisi_id,
            'jenis' => $request->jenis,
            'nama' => $request->nama,
        ]);

        // Mengembalikan response sukses.
        return redirect()->route('kriteria.index')->with('success', 'Kriteria penilaian berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria)
    {
        // Hapus data kriteria.
        $kriteria->delete();

        // Mengembalikan response sukses.
        return redirect()->route('kriteria.index')->with('success', 'Kriteria penilaian berhasil dihapus.');
    }
}

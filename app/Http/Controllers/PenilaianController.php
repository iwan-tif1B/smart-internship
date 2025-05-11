<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian; // Ganti dengan Model Penilaian Anda yang sebenarnya
// Jika Anda punya model Peserta atau Tugas, uncomment dan gunakan:
// use App\Models\Peserta;
// use App\Models\Tugas;

class PenilaianController extends Controller
{
    /**
     * Menampilkan daftar data penilaian.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penilaian = Penilaian::latest()->paginate(10); // Ambil semua posisi dengan paginasi
        return view('pages.penilaian.index', compact('penilaian'));
    }


    /**
     * Menampilkan halaman detail penilaian (jika diperlukan).
     * Anda perlu membuat view 'penilaian.detail'.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Cari data penilaian berdasarkan ID, tampilkan error 404 jika tidak ditemukan
        // Gunakan 'with' jika perlu memuat relasi (peserta, tugas, dll)
        $detailPenilaian = Penilaian::with(['peserta', 'tugas'])->findOrFail($id);

        // Kirim data ke view detail
        return view('penilaian.detail', compact('detailPenilaian'));
    }


    /**
     * Memperbarui data nilai di database.
     * Method ini akan dipanggil oleh form di modal Input Nilai.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id ID dari data Penilaian yang akan diupdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nilai' => 'required|numeric|min:0|max:100', // Wajib, angka, antara 0-100
            // Tambahkan validasi untuk field lain jika ada (misal: 'catatan')
            // 'catatan' => 'nullable|string|max:255',
        ]);

        // 2. Cari Data Penilaian
        try {
            $penilaian = Penilaian::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika data tidak ditemukan (misal ID diubah manual)
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Data penilaian tidak ditemukan.'], 404);
            }
            return redirect()->route('penilaian.index')->with('error', 'Data penilaian tidak ditemukan.');
        }

        // 3. Update Data
        $penilaian->nilai = $validated['nilai'];
        $penilaian->status = 'dinilai'; // Otomatis ubah status menjadi 'dinilai'
        // Jika ada field catatan:
        // $penilaian->catatan = $request->input('catatan');
        $penilaian->save(); // Simpan perubahan ke database

        // 4. Berikan Response
        // Cek apakah request datang dari AJAX (seperti contoh di view)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Nilai untuk ' . ($penilaian->peserta->nama ?? $penilaian->nama_peserta) . ' berhasil diperbarui.' // Ambil nama dari relasi atau kolom langsung
            ]);
        }

        // Jika bukan AJAX (submit form biasa), redirect kembali ke halaman index
        return redirect()->route('penilaian.index')
                         ->with('success', 'Nilai untuk ' . ($penilaian->peserta->nama ?? $penilaian->nama_peserta) . ' berhasil diperbarui.');
    }

    // Anda bisa menambahkan method lain jika perlu, seperti:
    // public function create() { ... } // Menampilkan form tambah penilaian
    // public function store(Request $request) { ... } // Menyimpan data penilaian baru
    // public function destroy($id) { ... } // Menghapus data penilaian
}
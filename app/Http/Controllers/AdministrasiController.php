<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan; // Pastikan ini mengarah ke model yang benar
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    /**
     * Menampilkan daftar pendaftar administrasi dengan filter dan pencarian.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Pengajuan::query();

        // Filter berdasarkan status_administrasi
        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status_administrasi', $request->input('status'));
        }

        // Pencarian berdasarkan nama lengkap (sesuaikan dengan relasi dan nama kolom Anda)
        // Asumsi 'nama' adalah relasi ke tabel users/pendaftar dan 'name' adalah kolom nama lengkap
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->whereHas('nama', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }
        // Jika Anda ingin mencari di kolom lain dari model Pengajuan itu sendiri,
        // Contoh: $query->where('nama_kolom_di_pengajuan', 'like', '%' . $searchTerm . '%');


        $administrasi = $query->orderBy('id', 'desc')->paginate(10);

        return view('pages.seleksi.administrasi.index', compact('administrasi'));
    }

    /**
     * Menampilkan dokumen terkait pendaftar (opsional).
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\View\View
     */
    public function dokumen(Pengajuan $pengajuan)
    {
        // Logika untuk menampilkan dokumen, sesuaikan dengan kebutuhan Anda
        // Contoh: return view('pages.administrasi.dokumen', compact('pengajuan'));
        return "Tampilan dokumen untuk Pengajuan ID: " . $pengajuan->id; // Placeholder
    }

    /**
     * Memperbarui status pendaftar menjadi 'diterima'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function terima(Request $request)
    {
        try {
            $administrasi = Pengajuan::findOrFail($request->id); // Mengambil ID dari request body AJAX
            $administrasi->status_administrasi = 'diterima';
            $administrasi->save();

            return response()->json(['success' => true, 'message' => 'Pendaftar berhasil diterima.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Pendaftar tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Memperbarui status pendaftar menjadi 'ditolak'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tolak(Request $request)
    {
        try {
            $administrasi = Pengajuan::findOrFail($request->id); // Mengambil ID dari request body AJAX
            $administrasi->status_administrasi = 'ditolak';
            $administrasi->save();

            return response()->json(['success' => true, 'message' => 'Pendaftar berhasil ditolak.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Pendaftar tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status: ' . $e->getMessage()], 500);
        }
    }
}

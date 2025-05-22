<?php

namespace App\Http\Controllers;

use App\Models\kegiatanku; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PenilaianMentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatanku = kegiatanku::all();
        return view('pages.mentor.penilaian.index', compact('kegiatanku')); // Sesuaikan nama view jika perlu
    }
    public function edit($id)
    {
        // Ambil data penilaian berdasar id
        $kegiatanku = kegiatanku::findOrFail($id);

        // Kirim data ke view edit (buat file resources/views/penilaian/edit.blade.php)
        return view('pages.mentor.penilaian.edit', compact('kegiatanku'));
    }

    // Menampilkan detail penilaian berdasarkan id
    public function show($id)
    {
        // Ambil data penilaian berdasar id
        $kegiatanku = kegiatanku::findOrFail($id);

        // Kirim data ke view show (buat file resources/views/penilaian/show.blade.php)
        return view('pages.mentor.penilaian.show', compact('kegiatanku'));
    }
}

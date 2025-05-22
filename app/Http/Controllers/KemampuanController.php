<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class KemampuanController extends Controller
{
    // Index
    public function index()
    {
        // Search by judul, pagination 10
        $kemampuan = Pengajuan::where('status_tes_kemampuan', 'like', '%' . request('judul') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.seleksi.kemampuan.index', compact('kemampuan'));
    }

    // Create
    public function create()
    {
        $kemampuan = Pengajuan::all();
        return view('pages.seleksi.kemampuan.create_soal', compact('kemampuan'));
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'posisi' => 'required',
            'asal_institusi' => 'required',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'status_tes_kemampuan' => 'required|in:proses,lulus',
        ]);

        Pengajuan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status_tes_kemampuan' => $request->status,
        ]);

        return redirect()->route('kemampuan.index')->with('success', 'Data pengajuan berhasil ditambahkan.');
    }


    // // Update
    // public function update(Request $request, Pengajuan $pengajuan)
    // {
    //     $request->validate([
    //         'nama' => 'required',
    //         'email' => 'required|email',
    //         'no_telp' => 'required',
    //         'posisi' => 'required',
    //         'asal_institusi' => 'required',
    //         'periode_mulai' => 'required|date',
    //         'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
    //         'status' => 'required|in:proses,lulus',
    //     ]);

    //     $pengajuan->update([
    //         'nama' => $request->nama,
    //         'email' => $request->email,
    //         'no_telp' => $request->no_telp,
    //         'posisi' => $request->posisi,
    //         'asal_institusi' => $request->asal_institusi,
    //         'periode_mulai' => $request->periode_mulai,
    //         'periode_selesai' => $request->periode_selesai,
    //         'status' => $request->status,
    //     ]);

    //     return redirect()->route('pengajuan.index')->with('success', 'Data pengajuan berhasil diperbarui.');
    // }

    // Destroy
    // public function destroy(Pengajuan $pengajuan)
    // {
    //     $pengajuan->delete();
    //     return redirect()->route('pengajuan.index')->with('success', 'Data pengajuan berhasil dihapus.');
    // }
}

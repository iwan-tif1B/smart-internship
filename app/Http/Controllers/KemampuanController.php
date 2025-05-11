<?php

namespace App\Http\Controllers;

use App\Models\Kemampuan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KemampuanController extends Controller
{
    // Index
    public function index()
    {
        // Search by judul, pagination 10
        $kemampuan = Kemampuan::where('judul', 'like', '%' . request('judul') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.kemampuan.index', compact('kemampuan'));
    }

    public function showSoal($id)
    {
        $kemampuan = Kemampuan::findOrFail($id);
        return view('pages.kemampuan.show_soal', compact('kemampuan'));
    }


    // Create
    public function create()
    {
        $kemampuan = Kemampuan::all();
        return view('pages.kemampuan.create_soal', compact('kemampuan'));
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
            'status' => 'required|in:proses,lulus',
        ]);

        Kemampuan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('kemampuan.index')->with('success', 'Data kemampuan berhasil ditambahkan.');
    }

    // Edit
    public function edit(Kemampuan $kemampuan)
    {
        $kategori = Kategori::all();
        return view('pages.kemampuan.edit', compact('kemampuan', 'kategori'));
    }

    // Update
    public function update(Request $request, Kemampuan $kemampuan)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'posisi' => 'required',
            'asal_institusi' => 'required',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
            'status' => 'required|in:proses,lulus',
        ]);

        $kemampuan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('kemampuan.index')->with('success', 'Data kemampuan berhasil diperbarui.');
    }

    // Destroy
    public function destroy(Kemampuan $kemampuan)
    {
        $kemampuan->delete();
        return redirect()->route('kemampuan.index')->with('success', 'Data kemampuan berhasil dihapus.');
    }

    // Dokumen (opsional)
    public function dokumen(Kemampuan $kemampuan)
    {
        return view('pages.kemampuan.dokumen', compact('kemampuan'));
    }
}

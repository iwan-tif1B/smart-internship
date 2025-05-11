<?php

namespace App\Http\Controllers;

use App\Models\Wawancara;
use App\Models\Kategori;
use Illuminate\Http\Request;

class WawancaraController extends Controller
{
    // Index
    public function index()
    {
        // Search by judul, pagination 10
        $wawancara = Wawancara::where('judul', 'like', '%' . request('judul') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.wawancara.index', compact('wawancara'));
    }

    // Create
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.wawancara.create', compact('kategori'));
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

        Wawancara::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('wawancara.index')->with('success', 'Data wawancara berhasil ditambahkan.');
    }

    // Edit
    public function edit(Wawancara $wawancara)
    {
        $kategori = Kategori::all();
        return view('pages.wawancara.edit', compact('wawancara', 'kategori'));
    }

    // Update
    public function update(Request $request, Wawancara $wawancara)
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

        $wawancara->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('wawancara.index')->with('success', 'Data wawancara berhasil diperbarui.');
    }

    // Destroy
    public function destroy(Wawancara $wawancara)
    {
        $wawancara->delete();
        return redirect()->route('wawancara.index')->with('success', 'Data wawancara berhasil dihapus.');
    }

    // Dokumen (opsional)
    public function dokumen(Wawancara $wawancara)
    {
        return view('pages.wawancara.dokumen', compact('wawancara'));
    }

    public function terima(Request $request)
    {
        $wawancara = Wawancara::findOrFail($request->wawancara);
        $wawancara->status = 'lulus'; // Atau status yang sesuai
        $wawancara->save();

        return redirect()->route('wawancara.index')->with('success', 'Pendaftar berhasil diterima.');
    }

    public function tolak(Request $request)
    {
        $wawancara = Wawancara::findOrFail($request->administrasi_id);
        $wawancara->status = 'ditolak'; // Atau status yang sesuai
        $wawancara->save();

        return redirect()->route('wawancara.index')->with('success', 'Pendaftar berhasil ditolak.');
    }
}
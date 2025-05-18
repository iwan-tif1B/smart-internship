<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    // Index
    public function index()
    {
        // Search by judul, pagination 10
        $administrasi = Administrasi::where('status_administrasi', 'like', '%' . request('judul') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.administrasi.index', compact('administrasi'));
    }

    // Create
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.administrasi.create', compact('kategori'));
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

        Administrasi::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('administrasi.index')->with('success', 'Data administrasi berhasil ditambahkan.');
    }

    // Edit
    public function edit(Administrasi $administrasi)
    {
        $kategori = Kategori::all();
        return view('pages.administrasi.edit', compact('administrasi', 'kategori'));
    }

    // Update
    public function update(Request $request, Administrasi $administrasi)
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

        $administrasi->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'posisi' => $request->posisi,
            'asal_institusi' => $request->asal_institusi,
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('administrasi.index')->with('success', 'Data administrasi berhasil diperbarui.');
    }

    // Destroy
    public function destroy(Administrasi $administrasi)
    {
        $administrasi->delete();
        return redirect()->route('administrasi.index')->with('success', 'Data administrasi berhasil dihapus.');
    }

    // Dokumen (opsional)
    public function dokumen(Administrasi $administrasi)
    {
        return view('pages.administrasi.dokumen', compact('administrasi'));
    }

    public function terima(Request $request)
    {
        $administrasi = Administrasi::findOrFail($request->administrasi_id);
        $administrasi->status = 'lulus'; // Atau status yang sesuai
        $administrasi->save();

        return redirect()->route('administrasi.index')->with('success', 'Pendaftar berhasil diterima.');
    }

    public function tolak(Request $request)
    {
        $administrasi = Administrasi::findOrFail($request->administrasi_id);
        $administrasi->status = 'ditolak'; // Atau status yang sesuai
        $administrasi->save();

        return redirect()->route('administrasi.index')->with('success', 'Pendaftar berhasil ditolak.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PosisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Search by judul, pagination 10
        $posisi = Posisi::where('nama', 'like', '%' . request('nama') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.posisi.index', compact('posisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.posisi.create_posisi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'total_kuota' => 'required|integer|min:0',
            'kuota_tersedia' => 'required|integer|min:0|lte:total_kuota',
            'persyaratan' => 'nullable|string',
            'status' => 'nullable|in:publish,unpublish',
        ]);

        Posisi::create($request->all());

        Session::flash('success', 'Posisi berhasil ditambahkan.');
        return redirect()->route('posisi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Posisi $posisi)
    {
        return view('posisi.show', compact('posisi')); // Anda bisa membuat view ini jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posisi $posisi)
    {
        return view('posisi.edit', compact('posisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posisi $posisi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'total_kuota' => 'required|integer|min:0',
            'kuota_tersedia' => 'required|integer|min:0|lte:total_kuota',
            'persyaratan' => 'nullable|string',
            'status' => 'nullable|in:publish,unpublish',
        ]);

        $posisi->update($request->all());

        Session::flash('success', 'Posisi berhasil diperbarui.');
        return redirect()->route('posisi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posisi $posisi)
    {
        $posisi->delete();

        Session::flash('success', 'Posisi berhasil dihapus.');
        return redirect()->route('posisi.index');
    }
}

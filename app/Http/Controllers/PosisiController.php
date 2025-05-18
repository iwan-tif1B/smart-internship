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

        return view('pages.masteradmin.posisi.index', compact('posisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('instansi.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'total_kuota' => 'required|integer|min:0',
            'kuota_tersedia' => 'required|integer|min:0|lte:total_kuota',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
        ]);

        Posisi::create($request->all());

        Session::flash('success', 'Posisi berhasil ditambahkan.');
        return redirect()->route('posisi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function show(Posisi $posisi)
    {
        return view('posisi.show', compact('posisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Posisi $posisi)
    {
        return view('posisi.edit', compact('posisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posisi $posisi)
    {
        $request->validate([
            'nama' => 'required|unique:posisi,nama,' . $posisi->id . '|max:255',
        ]);

        $posisi->update($request->all());

        Session::flash('success', 'posisi berhasil diperbarui.');
        return redirect()->route('posisi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posisi $posisi)
    {
        $posisi->delete();

        Session::flash('success', 'posisi berhasil dihapus.');
        return redirect()->route('posisi.index');
    }
}

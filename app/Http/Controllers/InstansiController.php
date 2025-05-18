<?php

namespace App\Http\Controllers;

use App\Models\Instansi; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = Instansi::all();
        return view('pages.instansi.index', compact('instansi')); // Sesuaikan nama view jika perlu
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instansi.create'); // Sesuaikan nama view jika perlu
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:instansi,name|max:255',
            'kuota' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean', // Jika ingin menerima input untuk status aktif
        ]);

        Instansi::create($request->all());

        Session::flash('success', 'Instansi berhasil ditambahkan.');
        return redirect()->route('instansi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        return view('instansi.show', compact('instansi')); // Sesuaikan nama view jika perlu
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function edit(Instansi $instansi)
    {
        return view('instansi.edit', compact('instansi')); // Sesuaikan nama view jika perlu
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'name' => 'required|unique:instansi,name,' . $instansi->id . '|max:255',
            'kuota' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean', // Jika ingin menerima input untuk status aktif
        ]);

        $instansi->update($request->all());

        Session::flash('success', 'Instansi berhasil diperbarui.');
        return redirect()->route('instansi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

        Session::flash('success', 'Instansi berhasil dihapus.');
        return redirect()->route('instansi.index');
    }

    // Metode blacklist dan unblacklist (jika diperlukan)
    public function blacklist(Instansi $instansi)
    {
        $instansi->update(['is_active' => false]); // Contoh: blacklist = tidak aktif
        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil di-blacklist.');
    }

    public function unblacklist(Instansi $instansi)
    {
        $instansi->update(['is_active' => true]); // Contoh: unblacklist = aktif
        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil di-unblacklist.');
    }
}

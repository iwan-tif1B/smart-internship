<?php

namespace App\Http\Controllers;

use App\Models\TemplateSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TemplateSertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sertifikat = TemplateSertifikat::all(); // Atau bisa menggunakan pagination: Jurusan::paginate(10);
        return view('pages.template.sertifikat.index', compact('sertifikat'));
    }

    //     /**
    //      * Show the form for creating a new resource.
    //      *
    //      * @return \Illuminate\Http\Response
    //      */
    //     // public function create()
    //     // {
    //     //     return view('jurusan.create');
    //     // }

    //     /**
    //      * Store a newly created resource in storage.
    //      *
    //      * @param  \Illuminate\Http\Request  $request
    //      * @return \Illuminate\Http\Response
    //      */
    //     public function store(Request $request)
    //     {
    //         $request->validate([
    //             'nama' => 'required|unique:jurusan,nama|max:100',
    //         ]);

    //         TemplateSertifikat::create($request->all());

    //         Session::flash('success', 'Jurusan berhasil ditambahkan.');
    //         return redirect()->route('jurusan.index');
    //     }

    //     /**
    //      * Display the specified resource.
    //      *
    //      * @param  \App\Models\Jurusan  $jurusan
    //      * @return \Illuminate\Http\Response
    //      */
    //     public function show(TemplateSertifikat $jurusan)
    //     {
    //         return view('jurusan.show', compact('jurusan'));
    //     }

    //     /**
    //      * Show the form for editing the specified resource.
    //      *
    //      * @param  \App\Models\Jurusan  $jurusan
    //      * @return \Illuminate\Http\Response
    //      */
    //     public function edit(TemplateSertifikat $jurusan)
    //     {
    //         return view('jurusan.edit', compact('jurusan'));
    //     }

    //     /**
    //      * Update the specified resource in storage.
    //      *
    //      * @param  \Illuminate\Http\Request  $request
    //      * @param  \App\Models\Jurusan  $jurusan
    //      * @return \Illuminate\Http\Response
    //      */
    //     public function update(Request $request, TemplateSertifikat $jurusan)
    //     {
    //         $request->validate([
    //             'nama' => 'required|unique:jurusan,nama,' . $jurusan->id . '|max:255',
    //         ]);

    //         $jurusan->update($request->all());

    //         Session::flash('success', 'Jurusan berhasil diperbarui.');
    //         return redirect()->route('jurusan.index');
    //     }

    //     /**
    //      * Remove the specified resource from storage.
    //      *
    //      * @param  \App\Models\Jurusan  $jurusan
    //      * @return \Illuminate\Http\Response
    //      */
    //     public function destroy(TemplateSertifikat $jurusan)
    //     {
    //         $jurusan->delete();

    //         Session::flash('success', 'Jurusan berhasil dihapus.');
    //         return redirect()->route('jurusan.index');
    //     }
}

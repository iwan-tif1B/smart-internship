<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data mitra dari database.
        // Jika data mitra banyak, pertimbangkan menggunakan pagination: Mitra::paginate(10);
        $mitra = Mitra::all();
        // Menampilkan view 'pages.mitra.index' dan mengirimkan data mitra.
        return view('pages.mitra.index', compact('mitra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Menampilkan view untuk membuat mitra baru.
        return view('mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form.
        $request->validate([
            'nama' => 'required|unique:mitra,nama|max:255',
            'total_kuota' => 'required|integer|min:0',
            'kuota_tersedia' => 'required|integer|min:0|lte:total_kuota',
        ]);

        // Membuat mitra baru berdasarkan data dari form.
        Mitra::create($request->all());

        // Menyimpan pesan sukses ke dalam sesi.
        Session::flash('success', 'Mitra berhasil ditambahkan.');
        // Mengarahkan pengguna kembali ke halaman index mitra.
        return redirect()->route('mitra.index');
    }

    /**
     * Blacklist the specified mitra.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function blacklist(Request $request, Mitra $mitra)
    {
        // Mengupdate status 'is_blacklisted' menjadi true pada model mitra.
        $mitra->update(['is_blacklisted' => true]);
        // Menyimpan pesan sukses ke dalam sesi.
        return redirect()->route('mitra.index')->with('success', 'Mitra berhasil di-blacklist.');
    }

    /**
     * Unblacklist the specified mitra.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function unblacklist(Request $request, Mitra $mitra)
    {
        // Mengupdate status 'is_blacklisted' menjadi false pada model mitra.
        $mitra->update(['is_blacklisted' => false]);
        // Menyimpan pesan sukses ke dalam sesi.
        return redirect()->route('mitra.index')->with('success', 'Mitra berhasil di-unblacklist.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function show(Mitra $mitra)
    {
        // Menampilkan detail informasi mitra.
        return view('mitra.show', compact('mitra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function edit(Mitra $mitra)
    {
        // Menampilkan form untuk mengedit informasi mitra.
        return view('mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mitra $mitra)
    {
        // Validasi data yang masuk dari form untuk proses update.
        // Aturan unique diabaikan untuk nama mitra yang sedang diedit.
        $request->validate([
            'nama' => 'required|unique:mitra,nama,' . $mitra->id . '|max:255',
            'total_kuota' => 'required|integer|min:0',
            'kuota_tersedia' => 'required|integer|min:0|lte:total_kuota',
        ]);

        // Mengupdate informasi mitra berdasarkan data dari form.
        $mitra->update($request->all());

        // Menyimpan pesan sukses ke dalam sesi.
        Session::flash('success', 'Mitra berhasil diperbarui.');
        // Mengarahkan pengguna kembali ke halaman index mitra.
        return redirect()->route('mitra.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mitra $mitra)
    {
        // Menghapus data mitra dari database.
        $mitra->delete();

        // Menyimpan pesan sukses ke dalam sesi.
        Session::flash('success', 'Mitra berhasil dihapus.');
        // Mengarahkan pengguna kembali ke halaman index mitra.
        return redirect()->route('mitra.index');
    }
}
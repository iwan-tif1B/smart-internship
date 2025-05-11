<?php

namespace App\Http\Controllers;

use App\Models\TemplatePenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TemplatePenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templatePenilaian = TemplatePenilaian::latest()->first(); // Atau logika lain untuk mengambil template yang aktif
        return view('pages.template_penilaian.index', compact('templatePenilaian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Anda mungkin tidak memerlukan ini jika upload template langsung dari index
        return view('penilaian.template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Logika penyimpanan template baru jika ada form terpisah
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TemplatePenilaian  $templatePenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(TemplatePenilaian $templatePenilaian)
    {
        // Anda mungkin ingin menampilkan detail template di sini jika ada kebutuhan
        return view('penilaian.template.show', compact('templatePenilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TemplatePenilaian  $templatePenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplatePenilaian $templatePenilaian)
    {
        return view('penilaian.template.edit', compact('templatePenilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TemplatePenilaian  $templatePenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemplatePenilaian $templatePenilaian = null)
    {
        $validator = Validator::make($request->all(), [
            'template_file' => 'required|file|mimes:docx|max:2048', // Contoh validasi
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('template_file')) {
            $file = $request->file('template_file');
            $filename = 'template_penilaian_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('templates/penilaian', $filename); // Simpan di direktori storage/app/templates/penilaian

            TemplatePenilaian::updateOrCreate(
                ['id' => $templatePenilaian ? $templatePenilaian->id : null],
                ['file_path' => $path]
            );

            return back()->with('success', 'Template penilaian berhasil diperbarui.');
        }

        return back()->with('error', 'Gagal memperbarui template penilaian.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TemplatePenilaian  $templatePenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemplatePenilaian $templatePenilaian)
    {
        if (Storage::exists($templatePenilaian->file_path)) {
            Storage::delete($templatePenilaian->file_path);
        }
        $templatePenilaian->delete();

        return redirect()->route('templatePenilaian.index')->with('success', 'Template penilaian berhasil dihapus.');
    }

    /**
     * Download the specified template.
     *
     * @param  \App\Models\TemplatePenilaian  $templatePenilaian
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function downloadTemplate(TemplatePenilaian $templatePenilaian)
    {
        $filePath = $templatePenilaian->file_path;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, 'template_penilaian.' . pathinfo($filePath, PATHINFO_EXTENSION));
        } else {
            return back()->with('error', 'File template penilaian tidak ditemukan.');
        }
    }
}
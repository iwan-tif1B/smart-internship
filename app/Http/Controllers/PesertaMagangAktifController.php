<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan; // Menggunakan model Instansi
use Barryvdh\DomPDF\Facade\Pdf;

class PesertaMagangAktifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magangaktif = Pengajuan::all();
        return view('pages.laporan.pesertamagangaktif.index', compact('magangaktif')); // Sesuaikan nama view jika perlu
    }
    public function exportPdf()
    {
        $magangaktif = Pengajuan::where('status', 'aktif')->get();

        $pdf = Pdf::loadView('pdf.pesertamagangaktif', compact('magangaktif'))->setPaper('A4', 'landscape');
        return $pdf->stream('peserta-magang-aktif.pdf');
    }
}

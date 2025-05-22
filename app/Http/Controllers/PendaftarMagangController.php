<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan; // Menggunakan model Instansi
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftarMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftarmagang = Pengajuan::all();
        return view('pages.laporan.pendaftarmagang.index', compact('pendaftarmagang')); // Sesuaikan nama view jika perlu
    }
    public function exportPdf()
    {
        $pendaftarmagang = Pengajuan::where('status', 'aktif')->get();

        $pdf = Pdf::loadView('pdf.pendaftarmagang', compact('pendaftarmagang'))->setPaper('A4', 'landscape');
        return $pdf->stream('peserta-magang.pdf');
    }
}

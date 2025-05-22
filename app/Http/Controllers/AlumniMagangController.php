<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan; // Menggunakan model Instansi
use Barryvdh\DomPDF\Facade\Pdf;

class AlumniMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnimagang = Pengajuan::all();
        return view('pages.laporan.alumnimagang.index', compact('alumnimagang')); // Sesuaikan nama view jika perlu
    }
    public function exportPdf()
    {
        $alumnimagang = Pengajuan::where('status', 'aktif')->get();

        $pdf = Pdf::loadView('pdf.alumnimagang', compact('alumnimagang'))->setPaper('A4', 'landscape');
        return $pdf->stream('alumni-magang.pdf');
    }
}

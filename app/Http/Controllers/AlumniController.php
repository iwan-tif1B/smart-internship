<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan; // Menggunakan model Instansi
use Barryvdh\DomPDF\Facade\Pdf;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumni = Pengajuan::all();
        return view('pages.mentor.alumni.index', compact('alumni')); // Sesuaikan nama view jika perlu
    }
    public function exportPdf()
    {
        $alumni = Pengajuan::where('status', 'aktif')->get();

        $pdf = Pdf::loadView('pdf.alumni', compact('alumni'))->setPaper('A4', 'landscape');
        return $pdf->stream('alumni.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DetailProject;
// Menggunakan model Instansi
use Barryvdh\DomPDF\Facade\Pdf;

class DetailProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailproject = DetailProject::all();
        return view('pages.mentor.monitoring.detail', compact('detailproject')); // Sesuaikan nama view jika perlu
    }
}

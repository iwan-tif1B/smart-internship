<?php

namespace App\Http\Controllers;

use App\Models\Project;
// Menggunakan model Instansi
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        return view('pages.mentor.monitoring.index', compact('project')); // Sesuaikan nama view jika perlu
    }
}

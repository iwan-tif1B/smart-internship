<?php

namespace App\Http\Controllers;

use App\Models\KriteriaPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KriteriaPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria_penilaian = KriteriaPenilaian::all();
        return view('pages.template.kriteriapenilaian.index', compact('kriteria_penilaian')); // Sesuaikan nama view jika perlu
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\kegiatanku; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KegiatankuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = kegiatanku::all();
        return view('pages.user.have_acc.kegiatanku.index', compact('instansi')); // Sesuaikan nama view jika perlu
    }
}

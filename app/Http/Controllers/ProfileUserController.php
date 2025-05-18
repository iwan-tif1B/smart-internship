<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser; // Menggunakan model Instansi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instansi = ProfileUser::all();
        return view('pages.user.have_acc.profile.index', compact('instansi')); // Sesuaikan nama view jika perlu
    }
}

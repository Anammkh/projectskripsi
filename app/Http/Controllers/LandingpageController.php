<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Lowongan;
use App\Models\Mitra;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index()
    {
        $jobs = Lowongan::all();
        $mitras = Mitra::with('lowongan')->get();
        $kota = Lowongan::pluck('kota')->unique();
        $jurusan = Jurusan::all();
        return view('welcome', compact('jobs', 'mitras','kota','jurusan'));
    }
}

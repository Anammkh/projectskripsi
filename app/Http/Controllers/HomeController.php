<?php

namespace App\Http\Controllers;
use App\Models\Jurusan;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Models\Pelamar;
use App\Models\Skil;
use App\Models\User;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahUser = User::count();
        $jumlahLowongan = Lowongan::count();
        $jumlahMitra = Mitra::count();
        $jumlahJurusan = Jurusan::count();
        $jumlahSkill = Skil::count();
        $jumlahlamaran = Lamaran::count();

        return view('home', compact('jumlahUser', 'jumlahLowongan', 'jumlahMitra', 'jumlahJurusan', 'jumlahSkill','jumlahlamaran'));
    }
}

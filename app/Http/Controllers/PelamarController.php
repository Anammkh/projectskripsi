<?php

namespace App\Http\Controllers;
use App\Models\Pelamar;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function index()
    {
        $pelamars = Pelamar::with('user')->whereHas('user', function ($query) {
            $query->whereNull('deleted_at')->where('roles', '!=', 'admin');;
        })->get();
        return view('Admin.pelamar', compact('pelamars'));
    }

    public function show($id)
    {
        $pelamar = Pelamar::findOrFail($id);
        return view('Admin.profilPelamar', compact('pelamar'));
    }

}

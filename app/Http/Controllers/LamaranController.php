<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;
use Carbon\Carbon;
use App\Models\lowongan;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    public function index()
    {
        $lamarans = Lamaran::with('pelamar', 'lowongan')->get();
        return view('Admin.lamaran', compact('lamarans'));
    }
    public function lamar(Lowongan $lowongan)
    {
        $pelamarId = Auth::id();
        $lowonganId = $lowongan->id;
    
        // Cek apakah pelamar sudah melamar lowongan ini
        $existingApplication = Lamaran::where('pelamar_id', $pelamarId)
            ->where('lowongan_id', $lowonganId)
            ->first();
    
        if ($existingApplication) {
            return redirect()->route('Pelamar.semualowongan')->with('error', 'Anda sudah melamar untuk lowongan ini.');
        }
    
        $status = "Menunggu";
        $tanggal = Carbon::now();
    
        Lamaran::create([
            'pelamar_id' => $pelamarId,
            'lowongan_id' => $lowonganId,
            'tanggal' => $tanggal,
            'status' => $status,
        ]);
    
        return redirect()->route('Pelamar.semualowongan')->with('success', 'Berhasil melamar untuk lowongan ini.');
    }
    
    
    public function accept(Lamaran $lamaran)
    {
        $lamaran->update(['status' => 'Diterima']);
        return redirect()->route('lamaran.index')->with('success', 'Lamaran diterima.');
    }

    public function reject(Lamaran $lamaran)
    {
        $lamaran->update(['status' => 'Ditolak']);
        return redirect()->route('lamaran.index')->with('success', 'Lamaran ditolak.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;
use Carbon\Carbon;
use App\Models\lowongan;
use App\Models\Pelamar;
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
    $userId = Auth::id();
    $pelamar = Pelamar::where('user_id', $userId)->first();

    // Jika data pelamar tidak ditemukan
    if (!$pelamar) {
        return redirect()->route('Pelamar.semualowongan')->with('error', 'Data pelamar tidak ditemukan.');
    }

    // Memeriksa apakah semua data pelamar sudah terisi
    $requiredFields = [
        'jenis_kelamin', 'ttl', 'sekolah', 'alamat', 'tinggi', 
        'no_hp', 'jurusan_id', 'cv', 'ktp', 'transkip_nilai', 
        'ijazah', 'skil_id','kota',
    ];

    foreach ($requiredFields as $field) {
        if (empty($pelamar->$field)) {
            return redirect()->route('Pelamar.semualowongan')->with('error', 'Data pelamar belum lengkap. Harap lengkapi data sebelum melamar.');
        }
    }

    $pelamarId = $pelamar->id;
    $lowonganId = $lowongan->id;

    // Memeriksa apakah pelamar sudah melamar lowongan ini sebelumnya
    $existingApplication = Lamaran::where('pelamar_id', $pelamarId)
        ->where('lowongan_id', $lowonganId)
        ->first();

    if ($existingApplication) {
        return redirect()->route('Pelamar.semualowongan')->with('error', 'Anda sudah melamar untuk lowongan ini.');
    }

    // Menyimpan lamaran baru
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

    public function statusPendaftaran(){
        $lamarans = Lamaran::with('pelamar', 'lowongan')->get();

        return view('Pelamar.statuspendaftaran', compact('lamarans'));   
     }
}

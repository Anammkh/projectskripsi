<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;
use Carbon\Carbon;
use App\Models\Lowongan;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use App\Notifications\LamaranDiterimaNotification;
use App\Notifications\LamaranDitolakNotification;
use Illuminate\Support\Facades\Notification;

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

    if (!$pelamar) {
        return redirect()->route('Pelamar.semualowongan')->with('error', 'Data pelamar tidak ditemukan.');
    }

    $requiredFields = [
        'jenis_kelamin', 'ttl', 'sekolah', 'alamat', 'tinggi', 
        'no_hp', 'jurusan_id', 'cv', 'ktp', 'transkip_nilai', 
        'ijazah','kota',
    ];

    foreach ($requiredFields as $field) {
        if (empty($pelamar->$field)) {
            return redirect()->back()->with('error', 'Data pelamar belum lengkap. Harap lengkapi data sebelum melamar.');
        }
    }

    $pelamarId = $pelamar->id;
    $lowonganId = $lowongan->id;

    $existingApplication = Lamaran::where('pelamar_id', $pelamarId)
        ->where('lowongan_id', $lowonganId)
        ->first();

    if ($existingApplication) {
        return redirect()->back()->with('error', 'Anda sudah melamar untuk lowongan ini.');
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

    return redirect()->back()->with('success', 'Berhasil melamar untuk lowongan ini.');
}
     
public function accept(Request $request, $id)
{
    $request->validate([
        'tanggal_wawancara' => 'required|date_format:Y-m-d',
        'jam_wawancara' => 'required|date_format:H:i',
    ]);

    $lamaran = Lamaran::findOrFail($id);
    $lamaran->status = 'Diterima';
    $lamaran->tanggal_wawancara = $request->tanggal_wawancara;
    $lamaran->jam_wawancara = $request->jam_wawancara;
    $lamaran->save();

    $pelamar = $lamaran->pelamar;
    $user = $pelamar->user;

    Notification::send($user, new LamaranDiterimaNotification($lamaran));

    return redirect()->route('lamaran.index')->with('success', 'Lamaran berhasil diterima.');
}



public function reject($id)
{
    $lamaran = Lamaran::findOrFail($id);
    $lamaran->status = 'Ditolak';
    $lamaran->save();

    $pelamar = $lamaran->pelamar;
    $user = $pelamar->user;

    Notification::send($user, new LamaranDitolakNotification($lamaran));

    return redirect()->route('lamaran.index')->with('success', 'Lamaran ditolak.');
}

    public function statusPendaftaran()
{
    $userId = Auth::id();
    $dataLamaran = Lamaran::with('pelamar', 'lowongan')
                          ->whereHas('pelamar', function ($query) use ($userId) {
                              $query->where('user_id', $userId);
                          })
                          ->get();

    $lamarans = $dataLamaran->sortByDesc(function ($lamaran) {
        return $lamaran->status == 'Diterima' ? 1 : 0;
    });

    return view('Pelamar.statuspendaftaran', compact('lamarans'));
}
    
}

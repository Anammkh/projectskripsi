<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Models\Skil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::all();
        return view('Admin.lowongan', compact('lowongans'));
    }
    public function indexPelamar()
    {
        $lowongans = Lowongan::all();
        $pelamarId = Auth::id();
        $appliedJobIds = Lamaran::where('pelamar_id', $pelamarId)->pluck('lowongan_id')->toArray();
        $lowongans = Lowongan::all();
        return view('Pelamar.semualowongan', compact('lowongans','appliedJobIds'));
    }
    public function lamar(Lowongan $lowongan)
    {
        $pelamarId = Auth::id();
        $lowonganId = $lowongan->id;
    
        // Di sini Anda bisa menambahkan logika untuk membuat lamaran baru
        // Misalnya:
        Lamaran::create([
            'pelamar_id' => $pelamarId,
            'lowongan_id' => $lowonganId,
            'tanggal' => now(), // Gunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
            'status' => 'Menunggu', // Atur status lamaran sesuai kebutuhan Anda
        ]);
    
        // Redirect pengguna ke halaman lamaran di admin dengan pesan sukses
        return redirect()->route('Admin.lamaran')->with('success', 'Lamaran berhasil dikirim.');
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        $mitras = Mitra::all();
        $skils = Skil::all();
        return view('Admin.createlowongan', compact('jurusans', 'mitras', 'skils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'batas_waktu' => 'required|date',
            'posisi' => 'required',
            'persyaratan' => 'required',
            'jurusan_id' => 'required|integer',
            'mitra_id' => 'required|integer',
            'skil_id' => 'required|integer',
        ]);

        Lowongan::create($request->all());

        return redirect()->route('lowongan.index')
                         ->with('success', 'Lowongan berhasil dibuat.');
    }

    public function show(Lowongan $lowongan)
    {
        return view('Admin.detaillowongan', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        {
            $jurusans = Jurusan::all();
            $mitras = Mitra::all();
            $skils = Skil::all();
            return view('Admin.editlowongan', compact('lowongan', 'jurusans', 'mitras', 'skils'));
        }
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'judul' => 'required',
            'batas_waktu' => 'required|date',
            'posisi' => 'required',
            'persyaratan' => 'required',
            'jurusan_id' => 'required|integer',
            'mitra_id' => 'required|integer',
            'skil_id' => 'required|integer',
        ]);

        $lowongan->update($request->all());

        return redirect()->route('lowongan.index')
                         ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();

        return redirect()->route('lowongan.index')
                         ->with('success', 'Lowongan berhasil dihapus.');
    }
}

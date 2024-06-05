<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Mitra;
use App\Models\Pelamar;
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
        $jurusans = Jurusan::all();
        $pelamarId = Auth::id();
        $appliedJobIds = Lamaran::where('pelamar_id', $pelamarId)->pluck('lowongan_id')->toArray();
        $lowongans = Lowongan::all();
        return view('Pelamar.semualowongan', compact('lowongans','appliedJobIds','jurusans'));
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

    public function showDetail($id)
    {
        $lowongan = Lowongan::with('jurusan', 'mitra')->findOrFail($id);
        return response()->json($lowongan);
    }

    public function recommendJobs()
    {
        $user = Auth::user();
        $pelamar = Pelamar::where('user_id', $user->id)->firstOrFail();
        $jobs = Lowongan::all();
        $pelamarVector = $this->createVector($pelamar);
       
        $similarities = [];

        foreach ($jobs as $job) {
            $jobVector = $this->createVectorJob($job);
            
            $similarity = $this->cosineSimilarity($pelamarVector, $jobVector);
            
            $similarities[] = [
                'job' => $job,
                'similarity' => $similarity
            ];
        }

        // dd($similarities);
        
        $filteredSimilarities = array_filter($similarities, function ($item) {
            return $item['similarity'] > 0.5;
        });
        
        // Urutkan berdasarkan similarity
        usort($filteredSimilarities, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        $recommendations = $filteredSimilarities;

        

        return view('recommendations', compact('recommendations'));
    }

    private function createVector($entity)
    {
        return [
            crc32( $entity->skil->nama) % 10,
            crc32( $entity->jurusan->nama) % 10,
            crc32($entity->kota) % 10 
        ];
    }
    private function createVectorJob($entity)
    {
        return [
            crc32( $entity->skil->nama) % 10,
            crc32( $entity->jurusan->nama) % 10,
            crc32($entity->mitra->kota) % 10 
        ];
    }

    private function cosineSimilarity(array $vec1, array $vec2)
    {
        $dotProduct = 0.0;
        $normA = 0.0;
        $normB = 0.0;

        for ($i = 0; $i < count($vec1); $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $normA += pow($vec1[$i], 2);
            $normB += pow($vec2[$i], 2);
        }

        $similarity = $dotProduct / (sqrt($normA) * sqrt($normB));
        return $similarity;
    }
}

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
use Illuminate\Support\Facades\Http;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::with('skils', 'jurusans')->get();
        return view('Admin.lowongan', compact('lowongans'));
    }
    public function indexPelamar()
    {
    $pelamarId = Auth::id();

    $lowongans = Lowongan::where('batas_waktu', '>=', now())->with('skils', 'jurusans')
                    ->get();
    $jurusans = Jurusan::all();
    $appliedJobIds = Lamaran::where('pelamar_id', $pelamarId)->pluck('lowongan_id')->toArray();
    return view('Pelamar.semualowongan', compact('lowongans', 'appliedJobIds', 'jurusans'));
    }
     public function lamar(Lowongan $lowongan)
    {
            $pelamarId = Auth::id();
            $lowonganId = $lowongan->id;

            Lamaran::create([
                'pelamar_id' => $pelamarId,
                'lowongan_id' => $lowonganId,
                'tanggal' => now(), 
                'status' => 'Menunggu', 
            ]);

            return redirect()->route('Admin.lamaran')->with('success', 'Lamaran berhasil dikirim.');
     }

    public function create()
    {
        $jurusans = Jurusan::all();
        $mitras = Mitra::all();
        $skils = Skil::all();
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $provinces = $response->json();
        return view('Admin.createlowongan', compact('jurusans', 'mitras', 'skils', 'provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'batas_waktu' => 'required|date',
            'posisi' => 'required|string|max:255',
            'persyaratan.*' => 'required|string',
            'jurusan_id' => 'required|array',
            'jurusan_id.*' => 'exists:jurusans,id',
            'mitra_id' => 'required|exists:mitras,id',
            'skil_id' => 'required|array',
            'skil_id.*' => 'exists:skils,id',
            'kota' => 'required',
        ]);

        $lowongan = new Lowongan();
        $lowongan->judul = $request->judul;
        $lowongan->batas_waktu = $request->batas_waktu;
        $lowongan->posisi = $request->posisi;
        $lowongan->persyaratan = json_encode($request->persyaratan);
        $lowongan->mitra_id = $request->mitra_id;
        $lowongan->kota = $request->kota; 
        $lowongan->save();

        $lowongan->jurusans()->sync($request->jurusan_id);
        $lowongan->skils()->sync($request->skil_id);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function show(Lowongan $lowongan)
    {
        return view('Admin.detaillowongan', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    { {
            $jurusans = Jurusan::all();
            $mitras = Mitra::all();
            $skils = Skil::all();
            $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            $provinces = $response->json();
            return view('Admin.editlowongan', compact('lowongan', 'jurusans', 'mitras', 'skils','provinces'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'batas_waktu' => 'required|date',
            'posisi' => 'required|string|max:255',
            'persyaratan.*' => 'required|string|max:255', // Validasi untuk array persyaratan
            'jurusan_id' => 'required|exists:jurusans,id', // Validasi untuk jurusan_id yang harus ada di tabel jurusans
            'mitra_id' => 'required|exists:mitras,id', // Validasi untuk mitra_id yang harus ada di tabel mitras
            'skil_id.*' => 'required|exists:skils,id', // Validasi untuk array skil_id
            'kota' => 'required|string|max:255', // Validasi untuk kota
        ]);

        $lowongan = Lowongan::findOrFail($id);

        $lowongan->judul = $request->judul;
        $lowongan->batas_waktu = $request->batas_waktu;
        $lowongan->posisi = $request->posisi;
        $lowongan->persyaratan = json_encode($request->persyaratan); // Konversi persyaratan menjadi JSON

        $lowongan->save();

        $lowongan->jurusans()->sync($request->jurusan_id);
        $lowongan->skils()->sync($request->skil_id);

        $lowongan->mitra_id = $request->mitra_id;
        $lowongan->kota = $request->kota;

        $lowongan->save();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    public function destroy(Lowongan $lowongan)
    {
        if ($lowongan->lamarans()->count() > 0) {
            return redirect()->route('lowongan.index')
                ->with('error', 'Lowongan tidak bisa dihapus karena masih ada pelamar.');
        }
    
        $lowongan->delete();
    
        return redirect()->route('lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }

    public function showDetail($id)
    {
        $lowongan = Lowongan::with('jurusans', 'mitra','skils')->findOrFail($id);
        return response()->json($lowongan);
    }

   public function recommendJobs()
{
    $user = Auth::user();
    $pelamar = Pelamar::with('jurusan', 'skils')->where('user_id', $user->id)->firstOrFail();
    
    if (!$this->isProfileComplete($pelamar)) {
        $recommendations = -2;
        return view('recommendations', compact('recommendations'));
    }

    $jobs = Lowongan::with('jurusans', 'skils','mitra')->get();

    if ($jobs->isEmpty()) {
        $recommendations = -1;
        return view('recommendations', compact('recommendations'));
    }

    $jurusans = Jurusan::pluck('nama')->toArray();
    $skills = Skil::pluck('nama')->toArray();
    $pelamarKota = $pelamar->kota ? [$pelamar->kota] : [];
    $lowonganKotas = Lowongan::pluck('kota')->toArray();
    $kotas = array_unique(array_merge($pelamarKota, $lowonganKotas));
    $pelamarVector = $this->createVector($pelamar, 'pelamar', $jurusans, $skills, $kotas);
    $similarities = [];
    foreach ($jobs as $job) {
        $jobVector = $this->createVector($job, 'job', $jurusans, $skills, $kotas);
        $allJobVectors[] = $jobVector;
        $similarity = $this->cosineSimilarity($pelamarVector, $jobVector);
        $similarities[] = [
            'job' => $job,
            'similarity' => $similarity
        ];
    }
   
    $filteredSimilarities = array_filter($similarities, function ($item) {
        return $item['similarity'] > 0.5;
    });
    usort($filteredSimilarities, function ($a, $b) {
        return $b['similarity'] <=> $a['similarity'];
    });
    $recommendations = $filteredSimilarities;
    return view('recommendations', compact('recommendations'));
}

private function isProfileComplete($pelamar)
{
    return !empty($pelamar->kota) && $pelamar->skils->isNotEmpty() && $pelamar->jurusan_id;
}


private function createVector($entity, $type, $jurusans, $skills, $kotas)
{
    
    $vector = array_fill(0, count($jurusans) + count($skills) + count($kotas), 0);

    if ($type == 'pelamar') {
        $jurusanIndex = array_search($entity->jurusan->nama, $jurusans);
        if ($jurusanIndex !== false) {
            $vector[$jurusanIndex] = 1;
        }
    } else {
        foreach ($entity->jurusans as $jurusan) {
            $jurusanIndex = array_search($jurusan->nama, $jurusans);
            if ($jurusanIndex !== false) {
                $vector[$jurusanIndex] = 1;
            }
        }
    }

    foreach ($entity->skils as $skill) {
        $skillIndex = array_search($skill->nama, $skills);
        if ($skillIndex !== false) {
            $vector[count($jurusans) + $skillIndex] = 1;
        }
    }

    $kotaIndex = array_search($entity->kota, $kotas);
    if ($kotaIndex !== false) {
        $vector[count($jurusans) + count($skills) + $kotaIndex] = 1;
    }

    return $vector;
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

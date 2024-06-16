@extends('pelamar.halamanpelamar')

@section('content')
    <div class="content-page">
        <div class="container">
            <h1 class="mb-4 mt-3 text-center fw-semibold">Rekomendasi Lowongan Pekerjaan</h1>
            @if ($recommendations > 0)
                <div class="row">
                    @foreach ($recommendations as $recommendation)
                        <div class="col-md-4 mb-4">
                            <div class="card mb-4 shadow-lg"
                                style="border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="background-color: #f8f9fa; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <img src="{{ asset('images/' . $recommendation['job']->mitra->gambar) }}"
                                        alt="Logo Perusahaan"
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                    <span class="badge bg-primary"
                                        style="font-size: 0.8em; padding: 5px 10px; color: #fff; background-color: #007bff; border-radius: 3px;">{{ strtolower($recommendation['job']->kota) }}</span>
                                </div>
                                <div class="card-body" style="padding: 20px;">
                                    <h5 class="card-title fw-semibold" style="font-size: 1.5em; margin-bottom: 10px;">
                                        {{ $recommendation['job']->judul }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted" style="font-size: 1em; margin-bottom: 10px;">
                                        {{ $recommendation['job']->mitra->nama }}</h6>
                                    <p class="card-text m-0"><i class="bi bi-briefcase"
                                            style="margin-right: 5px;"></i>Posisi:
                                        <span class="fw-semibold">{{ $recommendation['job']->posisi }}</span>
                                    </p>
                                    <p class="card-text m-0"><i class="bi bi-clipboard-check"></i> Skill:
                                        <span class="fw-semibold">{{ $recommendation['job']->skil->nama }}</span>
                                    </p>
                                    <p class="card-text m-0"><i class="bi bi-calendar-check"></i> Batas waktu:
                                        <span
                                            class="fw-semibold">{{ \Carbon\Carbon::parse($recommendation['job']->batas_waktu)->format('d F Y') }}</span>
                                    </p>
                                    <p class="card-text"><strong>Kesamaan:</strong>
                                        {{ round($recommendation['similarity'] * 100, 2) }}%</p>
                                    <p class="card-text mt-2">{{ $recommendation['job']->persyaratan }}</p>
                                    <p class="card-text"><small class="text-muted">Tanggal Posting:
                                            {{ \Carbon\Carbon::parse($recommendation['job']->created_at)->format('d F Y') }}</small>
                                    </p>
                                   
                                    
                                    <div class="d-flex gap-2 mt-2">
                                        <div class="w-100">
                                            <form method="POST"
                                                action="{{ route('lowongan.lamar', $recommendation['job']->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary p-2 w-100">Lamar
                                                    Sekarang</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                @if ($recommendations == -1)
                    <p class="text-center">Tidak ada rekomendasi lowongan pekerjaan yang cocok.</p>
                @else
                    <p class="text-center">Silahkan isi profil anda terlebih dahulu!</p>
                @endif
            @endif
        </div>
    </div>
@endsection

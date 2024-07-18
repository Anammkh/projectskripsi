@extends('Pelamar.halamanpelamar')

@section('content')
    <div class="content-page">
        <div class="container mt-3">
            <div class="d-flex gap-3">
                <img src="{{ $mitra->gambar ? asset('images/' . $mitra->gambar) : 'https://png.pngtree.com/png-vector/20220730/ourmid/pngtree-m-company-logo-png-image_6092974.png' }}"
                    alt="Logo Perusahaan" style="width: 200px;">

                <div>
                    <h1>{{ $mitra->nama }}</h1>
                    <p>{{ $mitra->deskripsi }}</p>
                    <p>{{ $mitra->alamat }}</p>
                    
                <a href="{{ url()->previous() }}" class="btn btn-orimary">Kembali</a>
                </div>
            </div>
            @if (count($mitra->lowongan) > 0)
            <h2 class="fw-bold text-center mb-4">Lowongan Tersedia</h2>
            <div class="row mt-2">
                @foreach ($mitra->lowongan as $item)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-lg"
                            style="border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background-color: #f8f9fa; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                <img src="https://marketplace.canva.com/EAFm8Hzhhvs/1/0/1600w/canva-black-rectangle-business-logo-t8g-IobEQZI.jpg"
                                    alt="Logo Perusahaan"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                <span class="badge bg-primary"
                                    style="font-size: 0.8em; padding: 5px 10px; color: #fff; background-color: #007bff; border-radius: 3px;">{{ strtolower($item->kota) }}</span>
                            </div>
                            <div class="card-body" style="padding: 20px;">
                                <h5 class="card-title fw-semibold" style="font-size: 1.5em; margin-bottom: 10px;">
                                    {{ $item->posisi }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 1em; margin-bottom: 10px;">
                                    {{ $item->mitra->nama }}</h6>
                                <p class="card-text m-0"><i class="bi bi-calendar-check"></i> Batas waktu: <span
                                        class="fw-semibold">{{ \Carbon\Carbon::parse($item->batas_waktu)->format('d F Y') }}
                                    </span></p>
                                <p class="card-text mt-2">Deskripsi singkat mengenai pekerjaan yang tersedia. Kualifikasi
                                    yang dibutuhkan, tanggung jawab, </p>
                                <p class="card-text"><small class="text-muted">Tanggal Posting:
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</small></p>

                                <div class="d-flex gap-2 mt-2">
                                    <button class="btn btn-outline-primary w-100 p-2">Lihat Detail</button>
                                    <div class="w-100">
                                        <form method="POST" action="{{ route('lowongan.lamar', $item->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary w-100 ">Lamar Sekarang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <p class="text-center">Tidak ada lowongan</p>
            @endif
        </div>
    @endsection
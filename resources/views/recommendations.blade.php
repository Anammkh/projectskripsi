@extends('pelamar.halamanpelamar')

@section('content')
<div class="container">
    <h1 class="mb-4 mt-3 text-center fw-semibold">Rekomendasi Lowongan Pekerjaan</h1>
    @if(count($recommendations) > 0)
        <div class="row">
            @foreach($recommendations as $recommendation)
                <div class="col-md-4 mb-4">
                    <div class="card p-1 shadow" style="border-radius:16px;">
                        <div class="d-flex align-items-center justify-content-evenly">
                            <img src="{{ asset('images/' . $recommendation['job']->mitra->gambar) }}"
     style="border-radius: 8px; height: 100px; width: 100%; object-fit: cover;" alt="Mitra Image">
                
                        </div>
                        <div class="card-body">
                            <h4 class="fw-semibold m-0">{{ $recommendation['job']->mitra->nama }}</h4>
                            <h5 class="card-title">{{ $recommendation['job']->judul }}</h5>
                            <p class="m-0"><strong><i class="bi bi-suitcase-lg mr-2"></i> Posisi:</strong> {{ $recommendation['job']->posisi }}</p>
                            <p class="m-0"><strong><i class="bi bi-hourglass-bottom"></i> Batas Waktu:</strong> {{ $recommendation['job']->batas_waktu }}</p>
                            
                            <p class="card-text"><strong>Kesamaan:</strong> {{ round($recommendation['similarity'] * 100, 2) }}%</p>
                            <div class="d-flex justify-content-between gap-2 mt-3">
                                <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#detailModal{{ $recommendation['job']->id }}">
                                    Lihat Detail
                                </button>
                                <div class="w-100">
                                    <form method="POST" action="{{ route('lowongan.lamar', $recommendation['job']->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">Lamar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="detailModal{{ $recommendation['job']->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">{{ $recommendation['job']->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Mitra:</strong> {{ $recommendation['job']->mitra->nama }}</p>
                                <p><strong>Posisi:</strong> {{ $recommendation['job']->posisi }}</p>
                                <p><strong>Batas Waktu:</strong> {{ $recommendation['job']->batas_waktu }}</p>
                                {{-- Tambahkan informasi lainnya di sini --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                {{-- Tambahkan tombol aksi lainnya di sini --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Tidak ada rekomendasi lowongan pekerjaan yang cocok.</p>
    @endif
</div>
@endsection

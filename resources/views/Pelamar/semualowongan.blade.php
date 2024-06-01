@extends('Pelamar.halamanpelamar')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row mb-3">
        @foreach($lowongans as $lowongan)
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $lowongan->judul }}</h5>
                        <p class="card-text">Posisi: {{ $lowongan->posisi }}</p>
                        <p class="card-text">Batas Waktu: {{ $lowongan->batas_waktu }}</p>
                        <p class="card-text">Persyaratan: {{ $lowongan->persyaratan }}</p>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('lowongan.show', $lowongan->id) }}" class="btn btn-primary mr-3">Detail</a>
                            @if (!in_array($lowongan->id, $appliedJobIds))
                                <form method="POST" action="{{ route('lowongan.lamar', $lowongan->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success ml-3">Lamar</button>
                                </form>
                            @else
                                <button type="button" class="btn btn-secondary ml-3" disabled>Sudah Dilamar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

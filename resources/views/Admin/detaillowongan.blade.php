@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">Detail Lowongan</h4>
                    <p class="sub-header">
                        Detail informasi lowongan kerja.
                    </p>

                    <div class="form-group">
                        <label for="judul">Judul : </label>
                        <span>{{ $lowongan->judul }}</span>
                    </div>
                    <div class="form-group">
                        <label for="batas_waktu">Batas Waktu : </label>
                        <span>{{ $lowongan->batas_waktu }}</span>
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi : </label>
                        <span>{{ $lowongan->posisi }}</span>
                    </div>
                    <div class="form-group">
                        <label for="persyaratan">Persyaratan</label>
                        <ul>
                            @foreach ($lowongan->persyaratan as $persyaratan)
                                <li>{{ $persyaratan }}</li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        @foreach ($lowongan->jurusans as $jurusan)
                            <span>{{ $jurusan->nama }},</span>
                        @endforeach

                    </div>
                    <div class="form-group">
                        <label for="skil">Skil</label>
                        @foreach ($lowongan->skils as $skil)
                            <span>{{ $skil->nama }},</span>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="mitra">Mitra</label>
                        <span>{{ $lowongan->mitra->nama }}</span>
                        <div>
                            <img src="{{ asset('images/' . $lowongan->mitra->gambar) }}" width="100" alt="">
                        </div>
                    </div>
                    
                    <a href="{{ route('lowongan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection

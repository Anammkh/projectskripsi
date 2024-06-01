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
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" value="{{ $lowongan->judul }}" readonly>
                </div>
                <div class="form-group">
                    <label for="batas_waktu">Batas Waktu</label>
                    <input type="date" class="form-control" id="batas_waktu" value="{{ $lowongan->batas_waktu }}" readonly>
                </div>
                <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" class="form-control" id="posisi" value="{{ $lowongan->posisi }}" readonly>
                </div>
                <div class="form-group">
                    <label for="persyaratan">Persyaratan</label>
                    <textarea class="form-control" id="persyaratan" readonly>{{ $lowongan->persyaratan }}</textarea>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" value="{{ $lowongan->jurusan->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label for="mitra">Mitra</label>
                    <input type="text" class="form-control" id="mitra" value="{{ $lowongan->mitra->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label for="skil">Skil</label>
                    <input type="text" class="form-control" id="skil" value="{{ $lowongan->skil->nama }}" readonly>
                </div>
                <a href="{{ route('lowongan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

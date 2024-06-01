@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">Edit Lowongan</h4>
                <p class="sub-header">
                    Form untuk mengedit lowongan.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" value="{{ $lowongan->judul }}" required>
                    </div>
                    <div class="form-group">
                        <label for="batas_waktu">Batas Waktu</label>
                        <input type="date" name="batas_waktu" class="form-control" id="batas_waktu" value="{{ $lowongan->batas_waktu }}" required>
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" name="posisi" class="form-control" id="posisi" value="{{ $lowongan->posisi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="persyaratan">Persyaratan</label>
                        <textarea name="persyaratan" class="form-control" id="persyaratan" required>{{ $lowongan->persyaratan }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="jurusan_id">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control" required>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ $lowongan->jurusan_id == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mitra_id">Mitra</label>
                        <select name="mitra_id" id="mitra_id" class="form-control" required>
                            @foreach($mitras as $mitra)
                                <option value="{{ $mitra->id }}" {{ $lowongan->mitra_id == $mitra->id ? 'selected' : '' }}>{{ $mitra->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="skil_id">Skil</label>
                        <select name="skil_id" id="skil_id" class="form-control" required>
                            @foreach($skils as $skil)
                                <option value="{{ $skil->id }}" {{ $lowongan->skil_id == $skil->id ? 'selected' : '' }}>{{ $skil->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('lowongan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

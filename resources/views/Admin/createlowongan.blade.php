@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">Tambah Lowongan</h4>
                <p class="sub-header">
                    Form untuk menambah lowongan baru.
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

                <form action="{{ route('lowongan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="batas_waktu">Batas Waktu</label>
                        <input type="date" name="batas_waktu" class="form-control" id="batas_waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" name="posisi" class="form-control" id="posisi" required>
                    </div>
                    <div class="form-group">
                        <label for="persyaratan">Persyaratan</label>
                        <textarea name="persyaratan" class="form-control" id="persyaratan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jurusan_id">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control" required>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mitra_id">Mitra</label>
                        <select name="mitra_id" id="mitra_id" class="form-control" required>
                            @foreach($mitras as $mitra)
                                <option value="{{ $mitra->id }}">{{ $mitra->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="skil_id">Skil</label>
                        <select name="skil_id" id="skil_id" class="form-control" required>
                            @foreach($skils as $skil)
                                <option value="{{ $skil->id }}">{{ $skil->nama }}</option>
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

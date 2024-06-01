@extends('Pelamar.halamanpelamar')

@section('content')
<div class="container mt-5">
    <h2>Complete Your Profile</h2>
    <form method="POST" action="{{ route('complete-profile') }}">
        @csrf
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ttl">Tanggal Lahir</label>
            <input type="date" class="form-control" id="ttl" name="ttl" required>
        </div>
        <div class="form-group">
            <label for="sekolah">Sekolah</label>
            <input type="text" class="form-control" id="sekolah" name="sekolah" required placeholder="Sekolah">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required placeholder="Alamat"></textarea>
        </div>
        <div class="form-group">
            <label for="tinggi">Tinggi (cm)</label>
            <input type="number" class="form-control" id="tinggi" name="tinggi" required placeholder="Tinggi">
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="No HP">
        </div>
        <div class="form-group">
            <label for="jurusan_id">Jurusan</label>
            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                <option value="" disabled selected>Pilih Jurusan</option>
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dokumen_id">Dokumen ID</label>
            <input type="number" class="form-control" id="dokumen_id" name="dokumen_id" required placeholder="Dokumen ID">
        </div>
        <div class="form-group">
            <label for="skil_id">Skil</label>
            <select class="form-control" id="skil_id" name="skil_id" required>
                <option value="" disabled selected>Pilih Skil</option>
                @foreach($skils as $skil)
                    <option value="{{ $skil->id }}">{{ $skil->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Complete Profile</button>
    </form>
</div>
@endsection

@extends('layouts.template')

@section('content')
<div class="card shadow rounded-lg">
    <div class="card-body">
        <h4 class="header-title mb-4">Profil Pelamar</h4>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><strong>Foto</strong></td>
                            <td>:<img src="{{ asset('/storage/'. $pelamar->user->gambar) }}" alt="" width="100"></td>
                        </tr>
                        <tr>
                            <td><strong>Sekolah</strong></td>
                            <td>:{{ $pelamar->sekolah }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>:{{ $pelamar->alamat }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tinggi</strong></td>
                            <td>:{{ $pelamar->tinggi }}</td>
                        </tr>
                        <tr>
                            <td><strong>No HP</strong></td>
                            <td>:{{ $pelamar->no_hp }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jurusan</strong></td>
                            <td>:{{ $pelamar->jurusan->nama }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kota</strong></td>
                            <td>:{{ $pelamar->kota }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>:{{ $pelamar->user->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>:{{ $pelamar->user->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td>:{{ $pelamar->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td><strong>TTL</strong></td>
                            <td>:{{ $pelamar->ttl }}</td>
                        </tr>
                        <tr>
                            <td><strong>Sekolah</strong></td>
                            <td>:{{ $pelamar->sekolah }}</td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="text-center">
                    <h5 class="mb-3">Ijazah</h5>
                    <a href="{{ asset($pelamar->ijazah) }}" target="_blank">
                        <img src="{{ asset($pelamar->ijazah) }}" alt="Ijazah" style="max-width: 200px;">
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h5 class="mb-3">CV</h5>
                    <a href="{{ asset($pelamar->cv) }}" target="_blank">
                        <img src="{{ asset($pelamar->cv) }}" alt="cv" style="max-width: 200px;">
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h5 class="mb-3">Transkrip Nilai</h5>
                    <a href="{{ asset($pelamar->transkip_nilai) }}" target="_blank">
                        <img src="{{ asset($pelamar->transkip_nilai) }}" alt="Transkrip Nilai" style="max-width: 200px;">
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h5 class="mb-3">KTP</h5>
                    <a href="{{ asset($pelamar->ktp) }}" target="_blank">
                        <img src="{{ asset($pelamar->ktp) }}" alt="KTP" style="max-width: 200px;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

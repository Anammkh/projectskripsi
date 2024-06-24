@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow rounded-lg">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <h4 class="header-title mt-0 mb-1">Daftar Pelamar</h4>
                <div class="table-responsive">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>TTL</th>
                                <th>Sekolah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelamars as $pelamar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pelamar->user->name }}</td>
                                <td>{{ $pelamar->jenis_kelamin }}</td>
                                <td>{{ $pelamar->ttl }}</td>
                                <td>{{ $pelamar->sekolah }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $pelamar->id }}">
                                        Detail
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="detailModal{{ $pelamar->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $pelamar->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailModalLabel{{ $pelamar->id }}">Detail Pelamar</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->user->name }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jenis Kelamin</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->jenis_kelamin }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>TTL</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->ttl }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sekolah</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->sekolah }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Alamat</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->alamat }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tinggi</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->tinggi }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>No HP</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->no_hp }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jurusan</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->jurusan->nama }}" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Skill</th>
                                                            <td><input type="text" class="form-control" value="@foreach ($pelamar->skils as $skil){{ $skil->nama }}, @endforeach" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th>CV</th>
                                                            <td>
                                                                @if ($pelamar->cv)
                                                                    <a href="{{ asset($pelamar->cv) }}" target="_blank" class="btn btn-link">Lihat CV</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>KTP</th>
                                                            <td>
                                                                @if ($pelamar->ktp)
                                                                    <a href="{{ asset($pelamar->ktp) }}" target="_blank" class="btn btn-link">Lihat KTP</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Transkip Nilai</th>
                                                            <td>
                                                                @if ($pelamar->transkip_nilai)
                                                                    <a href="{{ asset($pelamar->transkip_nilai) }}" target="_blank" class="btn btn-link">Lihat Transkip Nilai</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ijazah</th>
                                                            <td>
                                                                @if ($pelamar->ijazah)
                                                                    <a href="{{ asset($pelamar->ijazah) }}" target="_blank" class="btn btn-link">Lihat Ijazah</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kota</th>
                                                            <td><input type="text" class="form-control" value="{{ $pelamar->kota }}" readonly></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

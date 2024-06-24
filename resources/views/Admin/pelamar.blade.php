@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <h4 class="header-title mt-0 mb-1">Daftar pelamar</h4>
                <div class="table-responsive">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>TTL</th>
                                <th>Sekolah</th>
                                <th>Alamat</th>
                                <th>Tinggi</th>
                                <th>No HP</th>
                                <th>Jurusan</th>
                                <th>Skill</th>
                                <th>CV</th>
                                <th>KTP</th>
                                <th>Transkip Nilai</th>
                                <th>Ijazah</th>
                                <th>Kota</th>
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
                                <td>{{ $pelamar->alamat }}</td>
                                <td>{{ $pelamar->tinggi }}</td>
                                <td>{{ $pelamar->no_hp }}</td>
                                <td>{{ $pelamar->jurusan->nama }}</td>
                                <td>
                                    @foreach ($pelamar->skils as $skil)
                                        <span>{{ $skil->nama }},</span>
                                    @endforeach
                                </td>
                                <td>@if ($pelamar->cv)
                                    <a href="{{ asset($pelamar->cv) }}" target="_blank">Lihat CV</a>
                                @endif</td>
                                <td>@if ($pelamar->ktp)
                                    <a href="{{ asset($pelamar->ktp) }}" target="_blank">Lihat KTP</a>
                                @endif</td>
                                <td>@if ($pelamar->transkip_nilai)
                                    <a href="{{ asset($pelamar->transkip_nilai) }}" target="_blank">Lihat Transkip Nilai</a>
                                @endif</td>
                                <td>@if ($pelamar->ijazah)
                                    <a href="{{ asset($pelamar->ijazah) }}" target="_blank">Lihat Ijazah</a>
                                @endif</td>
                                <td>{{ $pelamar->kota }}</td>
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

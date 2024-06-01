@extends('Pelamar.halamanpelamar')

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
                <h4 class="header-title mt-0 mb-1">Daftar Lamaran</h4>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelamar</th>
                            <th>Lowongan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamarans as $lamaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lamaran->pelamar->user->name}}</td>
                            <td>{{ $lamaran->lowongan->judul }}</td>
                            <td>{{ $lamaran->tanggal }}</td>
                            <td>{{ $lamaran->status }}</td>
                            <td>
                                @if ($lamaran->status == 'Diterima')
                                <a href="" class="btn btn-primary">Lihat Jadwal Wawancara</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

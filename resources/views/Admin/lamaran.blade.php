@extends('layouts.template')
@section('title','Lamaran')
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
                            <td> <span class="badge {{ $lamaran->status == 'Diterima' ? 'badge-success' : 'badge-danger' }}">{{ $lamaran->status }}</span></td>
                            <td>
                                @if ($lamaran->status == 'Menunggu')
                                <div class="d-flex">
                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#wawancaraModal{{ $lamaran->id }}">Terima</button>
                                    <div class="modal fade" id="wawancaraModal{{ $lamaran->id }}" tabindex="-1" role="dialog" aria-labelledby="wawancaraModalLabel{{ $lamaran->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="wawancaraModalLabel{{ $lamaran->id }}">Konfirmasi Lamaran</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('lamarans.accept', $lamaran->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label for="tanggal_wawancara">Tanggal Wawancara:</label>
                                                        <input type="date" class="form-control" id="tanggal_wawancara" name="tanggal_wawancara" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Terima</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('lamarans.reject', $lamaran->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                    </form>
                                    <!-- Tombol untuk melihat profil pelamar -->
                                    <a href="{{ route('pelamar.show', $lamaran->pelamar->id) }}" class="btn btn-info ml-2">Lihat Profil</a>
                                </div>
                                @else
                                   -
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

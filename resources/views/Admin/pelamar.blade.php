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
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>alamat</th>
                            <th>TTL</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelamars as $pelamar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pelamar->user->name}}</td>
                            <td>{{ $pelamar->alamat }}</td>
                            <td>{{ $pelamar->ttl }}</td>
                            <td>{{ $pelamar->status }}</td>
                            <td>
                                @if ($pelamar->status == 'Menunggu')
                                <div class="d-flex">
                                    <form action="{{ route('pelamars.accept', $pelamar->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success mr-2">Terima</button>
                                    </form>
                                    <form action="{{ route('pelamars.reject', $pelamar->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                    </form>
                                </div>
                                @else
                                    <span class="badge {{ $pelamar->status == 'Diterima' ? 'badge-success' : 'badge-danger' }}">{{ $pelamar->status }}</span>
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

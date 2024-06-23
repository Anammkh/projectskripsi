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
                <h4 class="header-title mt-0 mb-1">Tabel Lowongan</h4>
                <a href="{{ route('lowongan.create') }}" class="btn btn-primary mb-3">Tambah Lowongan</a>
                <div class="table-responsive">
                    <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Batas Waktu</th>
                                <th>Posisi</th>
                                <th>Persyaratan</th>
                                <th>Jurusan</th>
                                <th>Skil</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lowongans as $lowongan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lowongan->judul }}</td>
                                <td>{{ $lowongan->batas_waktu }}</td>
                                <td>{{ $lowongan->posisi }}</td>
                                <td>
                                    <ul>
                                        @foreach ($lowongan->persyaratan as $persyaratan)
                                        <li>{{ $persyaratan }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @foreach ($lowongan->jurusans as $jurusan)
                                        <span class="badge badge-primary">{{ $jurusan->nama }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($lowongan->skils as $skil)
                                        <span class="badge badge-info">{{ $skil->nama }}</span>
                                    @endforeach
                                </td>
                                
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('lowongan.show', $lowongan->id) }}" class="btn btn-info btn-sm mr-2">Lihat Detail</a>
                                        <a href="{{ route('lowongan.edit', $lowongan->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                                        <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div>

@endsection

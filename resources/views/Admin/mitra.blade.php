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
                <h4 class="header-title mt-0 mb-1">Daftar Mitra </h4>
                </p>
                <a href="{{ route('mitra.create') }}" class="btn btn-primary mb-3">Tambah Mitra</a>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mitras as $mitra)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mitra->nama }}</td>
                            <td>{{ $mitra->gambar }}</td>
                            <td>{{ $mitra->alamat}}</td>
                            <td>{{ $mitra->deskripsi }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('mitra.edit', $mitra->id) }}" class="btn btn-primary mr-2">Edit</a>
                                    <form action="{{ route('mitra.destroy', $mitra->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@section('scripts')
    @parent
    <script>
        // Hapus alert setelah 5 detik
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000);
    </script>
@endsection
@endsection

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
                <h4 class="header-title mt-0 mb-1">Daftar User</h4>
                </p>
                <a href="{{ route('usermanajemen.create') }}" class="btn btn-primary mb-3">Tambah User</a>
                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <img src="{{ asset( $user->gambar) }}" alt="Profile Picture" width="50" height="50">
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('usermanajemen.edit', $user->id) }}" class="btn btn-primary mr-2">Edit</a>
                                    <form action="{{ route('usermanajemen.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" style="display: inline;">
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

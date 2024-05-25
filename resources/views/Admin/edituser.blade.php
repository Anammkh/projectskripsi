@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">Edit User</h4>
                <p class="sub-header">
                    Form untuk mengedit pengguna.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('usermanajemen.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="roles" class="form-control" id="role" required>
                            <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pelamar" {{ $user->roles == 'pelamar' ? 'selected' : '' }}>Pelamar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah kata sandi.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="confirm_password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('usermanajemen.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

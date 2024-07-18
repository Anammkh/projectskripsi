@extends('layouts.template')  <!-- Sesuaikan dengan layout yang Anda gunakan -->

@section('title', 'Edit-profile')

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
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="fw-semibold text-center my-4">Edit Profil {{ $user->name }}</h2>
                <div class="card p-3">
                    <form action="{{ route('updateprofile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="mb-1" for="gambar">Gambar Profil</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                            <img id="preview" src="{{ $user->gambar ? asset('/storage/'.$user->gambar) : asset('assets/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-md mt-2">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary float-end mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection

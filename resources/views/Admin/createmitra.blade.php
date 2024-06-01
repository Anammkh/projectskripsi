@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">Tambah Mitra</h4>
                <p class="sub-header">
                    Form untuk menambah mitra baru.
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

                <form action="{{ route('mitra.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-1" for="Provinsi">Provinsi</label>
                        <select class="form-control select2" id="province"  onchange="getRegencies(this.value)">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-2" id="regencyFormGroup" style="display: none;">
                        <label class="mb-1" for="regency">Kabupaten</label>
                        <select class="form-control select2" id="regency" name="kota">
                            <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" id="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="gambar" required>
                    </div>

                    
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('mitra.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script>
    function getRegencies(provinceId) {
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
            .then(response => response.json())
            .then(regencies => {
                const regencySelect = document.getElementById('regency');
                regencySelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name;
                    option.text = regency.name;
                    regencySelect.appendChild(option);
                });
            });

        // Tampilkan grup form kabupaten
        const regencyFormGroup = document.getElementById('regencyFormGroup');
        regencyFormGroup.style.display = 'block';
    }
</script>
@endsection

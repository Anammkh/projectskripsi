@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-1">Tambah Lowongan</h4>
                <p class="sub-header">
                    Form untuk menambah lowongan baru.
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

                <form action="{{ route('lowongan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="batas_waktu">Batas Waktu</label>
                        <input type="date" name="batas_waktu" class="form-control" id="batas_waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" name="posisi" class="form-control" id="posisi" required>
                    </div>
                    <div class="form-group" id="dynamic-inputs">
                        <label for="persyaratan">Persyaratan</label>
                        <div class="input-group mb-3">
                            <input type="text" name="persyaratan[]" class="form-control" id="persyaratan" required>
                            <button type="button" class="btn btn-primary ml-2 add-input">+</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="jurusan_id">Jurusan</label>
                        <select name="jurusan_id[]" id="jurusan_id" class="form-control select2" multiple="multiple" required>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mitra_id">Mitra</label>
                        <select name="mitra_id" id="mitra_id" class="form-control" required>
                            @foreach($mitras as $mitra)
                                <option value="{{ $mitra->id }}">{{ $mitra->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="skil_id">Skil</label>
                        <select name="skil_id[]" id="skil_id" class="form-control select2" multiple="multiple" required>
                            @foreach($skils as $skil)
                                <option value="{{ $skil->id }}">{{ $skil->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-1" for="Provinsi">Provinsi</label>
                        <select class="form-control " id="province"  onchange="getRegencies(this.value)">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2" id="regencyFormGroup" style="display: none;">
                        <label class="mb-1" for="regency">Kabupaten</label>
                        <select class="form-control " id="regency" name="kota">
                            <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('lowongan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event handling untuk tombol tambah
        $(document).on('click', '.add-input', function() {
            // Template literals untuk membangun elemen HTML baru
            var html = `
                <div class="form-group">
                    <label for="persyaratan">Persyaratan</label>
                    <div class="input-group mb-3">
                        <input type="text" name="persyaratan[]" class="form-control" required>
                        <button class="btn btn-danger ml-2 remove-input">-</button>
                    </div>
                </div>
            `;

            // Menambahkan elemen HTML baru ke dalam div dengan id dynamic-inputs
            $('#dynamic-inputs').append(html);
        });

        // Event handling untuk tombol hapus
        $(document).on('click', '.remove-input', function() {
            // Menghapus div form-group yang berisi input dan tombol
            $(this).closest('.form-group').remove();
        });
    });
</script>

@endsection

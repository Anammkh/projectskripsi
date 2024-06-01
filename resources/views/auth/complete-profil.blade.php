@extends('Pelamar.halamanpelamar')

@section('content')
    <div class="container">
        <h2 class="fw-semibold text-center my-3">Edit Profil {{ $pelamar->user->name }}</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-3">
            <form action="{{ route('complete-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1" for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ $pelamar->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ $pelamar->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="sekolah">Sekolah</label>
                            <input type="text" class="form-control" id="sekolah" name="sekolah"
                                value="{{ $pelamar->sekolah }}">
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-1" for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $pelamar->alamat }}">
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-1" for="tinggi">Tinggi Badan</label>
                            <input type="number" class="form-control" id="tinggi" name="tinggi"
                                value="{{ $pelamar->tinggi }}">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="ttl">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="ttl" name="ttl"
                                value="{{ $pelamar->ttl }}">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="no_hp">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="{{ $pelamar->no_hp }}">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="skil_id">Skill</label>
                            <select class="form-control" id="skil_id" name="skil_id" required>
                                <option value="" disabled>Pilih Skil</option>
                                @foreach ($skils as $skil)
                                    <option value="{{ $skil->id }}"
                                        {{ $pelamar->skil_id == $skil->id ? 'selected' : '' }}>
                                        {{ $skil->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1" for="jurusan_id">Jurusan</label>
                            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                                <option value="" disabled>Pilih Jurusan</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}"
                                        {{ $pelamar->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-1" for="cv">CV</label>
                            <input type="file" class="form-control" id="cv" name="cv">
                            @if ($pelamar->cv)
                                <a href="{{ asset($pelamar->cv) }}" target="_blank">Lihat CV</a>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-1" for="ktp">KTP</label>
                            <input type="file" class="form-control" id="ktp" name="ktp">
                            @if ($pelamar->ktp)
                                <a href="{{ asset($pelamar->ktp) }}" target="_blank">Lihat KTP</a>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-1" for="transkip_nilai">Transkrip Nilai</label>
                            <input type="file" class="form-control" id="transkip_nilai" name="transkip_nilai">
                            @if ($pelamar->transkip_nilai)
                                <a href="{{ asset($pelamar->transkip_nilai) }}" target="_blank">Lihat Transkrip Nilai</a>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-1" for="ijazah">Ijazah</label>
                            <input type="file" class="form-control" id="ijazah" name="ijazah">
                            @if ($pelamar->ijazah)
                                <a href="{{ asset($pelamar->ijazah) }}" target="_blank">Lihat Ijazah</a>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1" for="Provinsi">Provinsi</label>
                            <select class="form-control select2" id="province" onchange="getRegencies(this.value)">
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


                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
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

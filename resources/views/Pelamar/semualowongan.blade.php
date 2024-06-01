@extends('Pelamar.halamanpelamar')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row mt-2 ">
        <div class="col-md-4 mb-4 overflow-scroll">
            @foreach ($lowongans as $lowongan)
                <div class="card border-0 shadow p-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/' . $lowongan->mitra->gambar) }}"
                            style="border-radius: 50%;height:100px;width:100px" alt="Mitra Image">
                        <div class="d-flex row text-center">
                            <h3 class="fw-semibold">{{ $lowongan->mitra->nama }}</h3>
                            <span>{{ $lowongan->mitra->alamat }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title fw-semibold">{{ $lowongan->judul }}</h4>
                        <p class="card-text m-0">Posisi: {{ $lowongan->posisi }}</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary d-block w-100 mb-1 detail-btn"
                            onclick="showDetail({{ $lowongan->id }})">Detail</a>
                        @if (!in_array($lowongan->id, $appliedJobIds))
                            <form method="POST" action="{{ route('lowongan.lamar', $lowongan->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success d-block w-100">Lamar</button>
                            </form>
                        @else
                            <button type="button" class="btn btn-secondary d-block w-100" disabled>Sudah Dilamar</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8 mb-4" style="position: fixed; right: 0; top:10">
            <!-- Detail lowongan akan ditampilkan di sini -->
            <div id="detailLowongan">
                <div class="card " style="height: 70vh">
                    <div class="text-center my-auto">
                        klik
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetail(lowonganId) {
            $.ajax({
                url: "{{ route('lowongan.detail', '') }}/" + lowonganId,
                method: 'GET',
                success: function(response) {
                    var detailHtml = `
                        <div class="card border-0 shadow p-3 " style="height:70vh">
                            
    <h2 class="text-center fw-semibold mt-3 ">
        SEMUA LOWONGAN
    </h2>
                            <div class="card-body">
                                <h4 class="card-title fw-semibold">${response.judul}</h4>
                                <p class="card-text m-0">Posisi: ${response.posisi}</p>
                                <p class="card-text m-0">Batas Waktu: ${response.batas_waktu}</p>
                                <p class="card-text m-0">Persyaratan: ${response.persyaratan}</p>
                                <p class="card-text m-0">Jurusan: ${response.jurusan.nama}</p>
                                <p class="card-text m-0">Kota: ${response.mitra.kota}</p>
                            </div>
                        </div>
                    `;
                    $('#detailLowongan').html(detailHtml);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection

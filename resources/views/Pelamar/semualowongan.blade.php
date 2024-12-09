@extends('Pelamar.halamanpelamar')

@section('content')
    <style>
        .card-lowongan {
            cursor: pointer;
            transition: border 0.3s ease;
            border-radius: 16px;
            border: 1px solid transparent;
        }

        .card-lowongan:hover {
            border: 1px solid rgb(65, 65, 240);
        }

        .card-lowongan.active {
            border: 2px solid rgb(65, 65, 240);
        }

        .detail-card {
            border-radius: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
        }

        .detail-card .card-body {
            padding: 20px;
        }

        .detail-card .info {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .detail-card .info-icon {
            margin-right: 10px;
            color: #007bff;
        }

        .detail-card .info-text {
            flex-grow: 1;
        }

        .loader-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .loader {
            width: 3rem;
            height: 3rem;
            margin-top: 50px;
            aspect-ratio: 1;
            background:
                radial-gradient(farthest-side at top, #0000 calc(100% - 21px), lightblue calc(100% - 20px) 99%, #0000) bottom/100% 50%,
                radial-gradient(farthest-side, lightblue 94%, #0000) left /20px 20px,
                radial-gradient(farthest-side, lightblue 94%, #0000) right/20px 20px;
            background-repeat: no-repeat;
            position: relative;
        }

        .loader::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            inset: auto 0 0;
            margin: auto;
            border-radius: 50%;
            background: orange;
            transform-origin: 50% -20px;
            animation: l14 1s infinite cubic-bezier(0.5, 623, 0.5, -623);
        }

        @keyframes l14 {
            100% {
                transform: rotate(0.5deg)
            }
        }
    </style>

    <div class="content-page">

        <div class="container">
            <div class="row mt-3 mb-2">
                <div class="col-md-12">
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-2 text-start">
                            <span class="fw-semibold">Lowongan Tersedia: <span
                                    id="totalLowongan">{{ count($lowongans) }}</span></span>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" style="border-radius: 16px" id="filterJurusan"
                                onchange="filterLowongan()">
                                <option value="">Semua Jurusan</option>
                                @foreach ($jurusans as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <input type="text" class="form-control" placeholder="Cari lowongan..." id="searchLowongan"
                                oninput="searchLowongan()" style="border-radius: 16px">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4 overflow-scroll" style="height: 90vh;" id="lowonganList">
                    @if (count($lowongans) > 0)
                        @foreach ($lowongans as $lowongan)
                            <div class="card shadow p-3 mb-3 card-lowongan"
                                data-jurusan="{{ $lowongan->jurusans->pluck('id')->join(',') }}"
                                onclick="showDetail({{ $lowongan->id }}, this)">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/' . $lowongan->mitra->gambar) }}"
                                        style="width: 50px; height: 50px; object-fit: contain;" alt="Mitra Image">
                                    <div class="ms-3">
                                        <h5 class="card-title fw-semibold">{{ $lowongan->judul }}</h5>
                                        <h6 class="fw-semibold mb-1">{{ $lowongan->mitra->nama }}</h6>
                                        <span>{{ $lowongan->mitra->alamat }}</span>
                                    </div>
                                </div>
                                <div class="card-body p-0 mt-2">
                                    <p class="card-text mb-1">Posisi: {{ $lowongan->posisi }}</p>
                                    <small class="text-muted">Posted {{ $lowongan->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                        <div id="noDataMessage" class="text-center" style="display: none;">Belum ada data</div>
                    @else
                        <div class="text-center">Belum ada data</div>
                    @endif
                </div>

                @if (count($lowongans) > 0)
                    <div class="col-md-8 mb-4" style="height: 90vh; overflow-y: auto;">
                        <div id="detailLowongan">
                            <div class="card detail-card">
                                <div class="text-center">
                                    Klik salah satu lowongan untuk melihat detail.
                                </div>
                            </div>
                        </div>
                        <div id="loading" style="display: none;">
                            <div class="card"
                                style="height: 80vh;border-radius: 16px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <div class="card-body loader-container">
                                    <div class="loader"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if (count($lowongans) > 0)
        <script>
            function showDetail(lowonganId, element) {
                console.log(lowonganId);
                document.querySelectorAll('.card-lowongan').forEach(card => {
                    card.classList.remove('active');
                });

                element.classList.add('active');
                $('#loading').show();
                $('#detailLowongan .card.detail-card').hide();
                $.ajax({
                    url: "{{ route('lowongan.detail', '') }}/" + lowonganId,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        var mitraImageUrl = `{{ asset('images/${response.mitra.gambar}') }}`;
                        var detailHtml = `
                    <div class="card detail-card">
                        <div class="card-body">
                            <div class="info">
                                <img src="${mitraImageUrl}" style="width: 80px; height: 50px; " alt="Mitra Image">
                                <div class="ms-3">
                                    <h3 class="fw-semibold mb-1">${response.mitra.nama}</h3>
                                    <span>${response.mitra.alamat}</span>
                                </div>
                            </div>
                            <div class="info">
                                <i class="bi bi-person-fill info-icon"></i>
                                <div class="info-text"><strong>Posisi:</strong> ${response.posisi}</div>
                            </div>
                            <div class="info">
                                <i class="bi bi-calendar-fill info-icon"></i>
                                <div class="info-text"><strong>Batas Waktu:</strong>  ${formatTanggal(response.batas_waktu)}</div>
                            </div>
                            <div class="info">
                                <i class="bi bi-mortarboard-fill info-icon"></i>
                                <div class="info-text"><strong>Jurusan:</strong> ${response.jurusans.map(i => i.nama).join(', ')}</div>
                            </div>
                            <div class="info">
                                <i class="bi bi-mortarboard-fill info-icon"></i>
                                <div class="info-text"><strong>Skills:</strong> ${response.skils.map(i => i.nama).join(', ')}</div>
                            </div>
                            <div class="info">
                                <i class="bi bi-geo-alt-fill info-icon"></i>
                                <div class="info-text"><strong>Kota:</strong> ${response.kota}</div>
                            </div>
                           
                            <div class="">
                                <h5> <i class="bi bi-file-earmark-text-fill info-icon"></i> Persyaratan Pekerjaan</h5> 
                                <ul>
                                    ${response.persyaratan.map(p => `<li>${p}</li>`).join('')}
                                </ul>  
                            </div>
                             <div class=" my-3">
                                <form method="POST" action="{{ url('lowongan/lamar') }}/${response.id}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary px-3">Lamar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                        $('#loading').hide();
                        $('#detailLowongan').html(detailHtml);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        $('#loading').hide();
                        $('#detailLowongan').html(
                            '<div class="text-center text-danger">Terjadi kesalahan, silakan coba lagi.</div>');
                    }
                });
            }

            function formatTanggal(tanggal) {
                var namaBulan = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                var tanggalObj = new Date(tanggal);
                var bulan = namaBulan[tanggalObj.getMonth()];
                var tahun = tanggalObj.getFullYear();
                var tanggalFormatted = tanggalObj.getDate() + " " + bulan + " " + tahun;

                return tanggalFormatted;
            }

            function filterLowongan() {
                var selectedJurusan = document.getElementById('filterJurusan').value;
                var totalLowongan = 0;

                document.querySelectorAll('.card-lowongan').forEach(card => {
                    var jurusanIds = card.getAttribute('data-jurusan').split(',');
                    if (selectedJurusan === "" || jurusanIds.includes(selectedJurusan)) {
                        card.style.display = 'block';
                        totalLowongan++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                document.getElementById('totalLowongan').innerText = totalLowongan;

                var noDataMessage = document.getElementById('noDataMessage');
                if (totalLowongan === 0) {
                    noDataMessage.style.display = 'block';
                } else {
                    noDataMessage.style.display = 'none';
                }
            }

            function searchLowongan() {
                var searchQuery = document.getElementById('searchLowongan').value.toLowerCase().trim();

                document.querySelectorAll('.card-lowongan').forEach(card => {
                    var cardText = card.innerText.toLowerCase();

                    if (cardText.includes(searchQuery)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                var visibleCards = document.querySelectorAll('.card-lowongan:not([style="display: none;"])');
                document.getElementById('totalLowongan').innerText = visibleCards.length;

                var noDataMessage = document.getElementById('noDataMessage');
                if (visibleCards.length === 0) {
                    noDataMessage.style.display = 'block';
                } else {
                    noDataMessage.style.display = 'none';
                }
            }
        </script>
    @endif
@endsection

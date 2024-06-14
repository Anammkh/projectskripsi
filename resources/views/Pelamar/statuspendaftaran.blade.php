@extends('Pelamar.halamanpelamar')

@section('content')
<style>
    .lamaran-card {
        border-radius: 16px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        cursor: pointer;
    }

    .lamaran-card:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        border:1px solid rgb(65, 65, 240);
    }

    .lamaran-card.active {
        border: 2px solid rgb(65, 65, 240); /* Added border style for active card */
    }

    .lamaran-status {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .badge-diterima {
        background-color: #28a745;
    }

    .badge-menunggu {
        background-color: #ffc107;
    }

    .badge-ditolak {
        background-color: #dc3545;
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
</style>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row ">
                <div class="col-md-4 text-center">
                    <ul class="nav nav-tabs mt-3 mb-2" style="cursor: pointer">
                        <li class="nav-item">
                            <a class="nav-link active" data-status="all" onclick="filterLamaran('all')">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-status="pending" onclick="filterLamaran('pending')">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-status="diterima" onclick="filterLamaran('diterima')">Diterima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-status="ditolak" onclick="filterLamaran('ditolak')">Ditolak</a>
                        </li>
                    </ul>
                    {{-- <div class="w-full">
            
                        <button class="btn btn-primary  w-100 py-2" style="border-radius: 16px">Filter</button>
                    </div> --}}
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 overflow-scroll" style="height: 90vh;">
                    
                    @if (count($lamarans) > 0)
                        @foreach ($lamarans as $lamaran)
                        <div class="card mb-3 lamaran-card"data-status="{{ strtolower($lamaran->status) }}" onclick="showDetail({{ $lamaran->lowongan->id }}, this)">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="lamaran-status badge badge-{{ strtolower($lamaran->status) }}">{{ $lamaran->status }}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/' . $lamaran->lowongan->mitra->gambar) }}" alt="Perusahaan" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                    <div class="ms-3">
                                        <h6 class="fw-semibold mb-1">{{ $lamaran->lowongan->mitra->nama }}</h6>
                                        <span>{{ $lamaran->lowongan->mitra->alamat }}</span>
                                    </div>
                                </div>
                                <p class="mt-1 mb-0">Posisi: {{ $lamaran->lowongan->posisi }}</p>
                                <small class="text-muted">Posted {{ $lamaran->lowongan->created_at->diffForHumans() }}</small>
                                @if ($lamaran->status == 'Diterima')
                                <div class="mt-3">
                                    <strong>Tanggal Wawancara:</strong> {{ $lamaran->tanggal_wawancara }}
                                </div>
                                <div class="m-0">
                                    <small class="text-danger">*Silakan datang ke SMK  untuk sesi wawancara.</small>
                                </div>
                            @endif
                            </div>
                        </div>
                        @endforeach
                        </div>
                        <div class="col-md-8 mb-4  " style="height: 90vh; overflow-y: auto;">
                            <div id="detailLowongan">
                                <div class="card detail-card">
                                    <div class="text-center">
                                        Klik salah satu lowongan untuk melihat detail.
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-muted text-center">Anda belum melamar apapun</p>
                    @endif
                   
                
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(lowonganId, element) {
        document.querySelectorAll('.lamaran-card').forEach(card => {
            card.classList.remove('active');
        });

        element.classList.add('active');
        $.ajax({
            url: "{{ route('lowongan.detail', '') }}/" + lowonganId,
            method: 'GET',
            success: function(response) {
                var mitraImageUrl = `{{ asset('images/${response.mitra.gambar}') }}`;
                var detailHtml = `
                    <div class="card detail-card">
                        <div class="card-body">
                            <div class="info">
                                <img src="${mitraImageUrl}" style="width: 50px; height: 50px; object-fit: cover;" alt="Mitra Image">
                                <div class="ms-3">
                                    <h5 class="fw-semibold mb-1">${response.mitra.nama}</h5>
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
                                <i class="bi bi-file-earmark-text-fill info-icon"></i>
                                <div class="info-text"><strong>Persyaratan:</strong> ${response.persyaratan}</div>
                            </div>
                            <div class="info">
                                <i class="bi bi-mortarboard-fill info-icon"></i>
                                <div class="info-text"><strong>Jurusan:</strong> ${response.jurusan.nama}</div>
                            </div>
                            <div class="info">
                                <i class="bi bi-geo-alt-fill info-icon"></i>
                                <div class="info-text"><strong>Kota:</strong> ${response.mitra.kota}</div>
                            </div>
                            <div class=" my-3">
                               
                            </div>
                            <div>
                                <h5>Persyaratan Pekerjaan</h5> 
                                <ul>
                                    <li>Persyaratan 1</li>
                                    <li>Persyaratan 2</li>
                                    <!-- Tambahkan persyaratan pekerjaan di sini -->
                                </ul>  
                            </div>
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
</script>

<script>
    function filterLamaran(status) {
        document.querySelectorAll('.nav-link').forEach(tab => {
            tab.classList.remove('active');
        });

        document.querySelector(`a[data-status="${status}"]`).classList.add('active');

        document.querySelectorAll('.lamaran-card').forEach(card => {
            card.style.display = 'none';
        });

        if (status === 'all') {
            document.querySelectorAll('.lamaran-card').forEach(card => {
                card.style.display = 'block';
            });
        } else {
            document.querySelectorAll(`.lamaran-card[data-status="${status}"]`).forEach(card => {
                card.style.display = 'block';
            });
        }
    }
</script>
@endsection

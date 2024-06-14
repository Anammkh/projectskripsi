@extends('Pelamar.halamanpelamar')

@section('content')
    {{-- HERO SECTION --}}
    <div class="hero-section mt-5">
        <div class="judul col-md-8 mb-4">
            <h1 class="">Temukan Pekerjaan Impianmu Bersama BKK</h1>
            <p class="m-0 ">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non vel sunt quidem ratione, nobis
                earum consequatur explicabo reiciendis accusantium error.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="search-bar d-flex justify-content-center gap-2">
                    <input type="text" class="form-control col-md-3" placeholder="Kata kunci, jabatan, perusahaan">
                    <select class="form-control col-md-3">
                        <option>Pilih Spesialisasi</option>
                    </select>
                    <select class="form-control col-md-3">
                        <option>Pilih Lokasi</option>
                    </select>
                    <button class="btn btn-primary" style="border-radius: 24px">Search</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END HERO SECTION --}}

    {{-- LOWONGAN TERBARU --}}
    <section class="py-5">
        <div class="container">
            <div class="col-md-6">
                <h1 class="text-start mb-2" style="font-weight: 900;">Lowongan Pekerjaan Terbaru</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
            </div>
            <div class="text-end">
                <a href="{{ route('lowongan.index') }}" class="mt-5 fw-bold">Lihat semua lowongan <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row mt-2">
                @foreach ($jobs as $item)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-lg" style="border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;">
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                <img src="https://marketplace.canva.com/EAFm8Hzhhvs/1/0/1600w/canva-black-rectangle-business-logo-t8g-IobEQZI.jpg" alt="Logo Perusahaan" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                <span class="badge bg-primary" style="font-size: 0.8em; padding: 5px 10px; color: #fff; background-color: #007bff; border-radius: 3px;">Full-time</span>
                            </div>
                            <div class="card-body" style="padding: 20px;">
                                <h5 class="card-title fw-semibold" style="font-size: 1.5em; margin-bottom: 10px;">Posisi Pekerjaan</h5>
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 1em; margin-bottom: 10px;">Nama Perusahaan</h6>
                                <p class="card-text" style="margin-bottom: 10px;">Lokasi</p>
                                <p class="card-text" style="margin-bottom: 10px;"><i class="bi bi-briefcase" style="margin-right: 5px;"></i> Pengalaman: 2-3 Tahun</p>
                                <p class="card-text" style="margin-bottom: 10px;"><i class="bi bi-cash" style="margin-right: 5px;"></i> Gaji: Rp10.000.000 - Rp15.000.000</p>
                                <p class="card-text" style="margin-bottom: 10px;">Deskripsi singkat mengenai pekerjaan yang tersedia. Kualifikasi yang dibutuhkan, tanggung jawab, </p>
                                <p class="card-text" style="margin-bottom: 10px;"><small class="text-muted">Tanggal Posting: 1 Januari 2024</small></p>
                                <div class="d-flex gap-2 mt-4">
                                    <a href="#" class="btn btn-outline-primary w-100 p-2">Lihat Detail</a>
                                    <a href="#" class="btn btn-primary w-100 p-2">Lamar Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- END LOWONGAN TERBARU --}}

    {{-- PERUSAHAAN --}}
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-start mb-2" style="font-weight: 900;">Daftar Perusahaan</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="text-end">
            <a href="{{ route('lowongan.index') }}" class="mt-5 fw-bold">Lihat semua perusahaan <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="swiper-container mt-3">
            <div class="swiper-wrapper mb-3">
                @for ($i = 1; $i <= 9; $i++)
                    <div class="swiper-slide">
                        <div class="card shadow" style="border-bottom:6px solid rgb(54, 54, 252);border-radius:16px">
                            <img src="https://marketplace.canva.com/EAFm8Hzhhvs/1/0/1600w/canva-black-rectangle-business-logo-t8g-IobEQZI.jpg" class="card-img-top" style="object-fit: cover;" alt="Logo Perusahaan">
                            <div class="card-body text-center">
                                <h5 class="card-title">Nama Perusahaan {{ $i }}</h5>
                                <p>Lowongan tersedia: {{ rand(5, 20) }}</p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    {{-- END PERUSAHAAN --}}
@endsection


@section('scripts')
    <script>
        var swiper = new Swiper('.swiper-container', {
            autoplay: {
                delay: 1000,
            },
            breakpoints: {
                992: {
                    slidesPerView: 4,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                576: {
                    slidesPerView: 1,
                }
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
@endsection

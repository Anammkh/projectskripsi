@extends('Pelamar.halamanpelamar')

@section('content')
    {{-- HERO SECTION --}}
    <div class="hero-section mt-5">
        <div class="judul col-md-8 mb-4">
            <h1 class="">Temukan Pekerjaan Impianmu Bersama BKK</h1>
            <p class="m-0">Jelajahi berbagai kesempatan karier yang sesuai dengan keahlian dan minatmu. Dapatkan pekerjaan
                terbaik yang kamu inginkan dengan mudah dan cepat melalui BKK.</p>
        </div>
        <div class="row">
            <div class="col-md-">
                <a href="{{ route('Pelamar.semualowongan') }}" style="border-radius: 6px"
                    class="btn btn-primary p-2 fw-semibold px-3">Lihat semua lowongan <i class="bi bi-search"></i></a>
            </div>
        </div>
    </div>
    {{-- END HERO SECTION --}}

    {{-- LOWONGAN TERBARU --}}
    <section class="py-5">
        <div class="container">
            <div class="col-md-6">
                <h1 class="text-start mb-2" style="font-weight: 900;">Lowongan Pekerjaan Terbaru</h1>
                <p>Temukan berbagai lowongan pekerjaan terkini yang sesuai dengan keahlian dan minat Anda.</p>
            </div>
            <div class="text-end">
                <a href="{{ route('Pelamar.semualowongan') }}" class="mt-5 fw-bold">Lihat semua lowongan <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row mt-2">
                @foreach ($jobs->take(6) as $item)  {{-- Mengambil hanya 6 lowongan --}}
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-lg" style="border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;">
                        <div class="card-header d-flex justify-content-between align-items-center" 
                            style="background-color: #f8f9fa; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                            <img src="{{ asset('images/' . $item->mitra->gambar) }}" 
                            alt="Logo Perusahaan" 
                            style="width: 50px; height: 50px; object-fit: contain; border-radius: 50%; border: 1px solid #ddd; padding: 2px; background-color: #fff;">
                            <span class="badge bg-primary" 
                                style="font-size: 0.8em; padding: 5px 10px; color: #fff; background-color: #007bff; border-radius: 3px;">
                                {{ strtolower($item->kota) }}
                             </span>
                        </div>

                            <div class="card-body" style="padding: 20px;">
                                <h5 class="card-title fw-semibold" style="font-size: 1.5em; margin-bottom: 10px;">
                                    {{ $item->posisi }}
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 1em; margin-bottom: 10px;">
                                    {{ $item->mitra->nama }}
                                </h6>
                                <p class="card-text m-0"><i class="bi bi-book" style="margin-right: 5px;"></i>Jurusan:
                                    <span class="fw-semibold">
                                        @foreach($item->jurusans as $jurusan)
                                            {{ $jurusan->nama }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-0"><i class="bi bi-clipboard-check"></i> Skill:
                                    <span class="fw-semibold">
                                        @foreach($item->skils as $skill)
                                            {{ $skill->nama }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </span>
                                </p>
                                <p class="card-text m-0"><i class="bi bi-calendar-check"></i> Batas waktu:
                                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($item->batas_waktu)->format('d F Y') }}</span>
                                </p>
                                <p class="card-text mt-2">Persyaratan:
                                    <ul>
                                        @foreach($item->persyaratan as $persyaratan)
                                            <li>{{ $persyaratan }}</li>
                                        @endforeach
                                    </ul>
                                </p>
                                <p class="card-text"><small class="text-muted">Tanggal Posting: {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</small></p>
                                <div class="d-flex gap-2 mt-2">
                                    <div class="w-100">
                                        <form method="POST" action="{{ route('lowongan.lamar', $item->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary p-2 w-100">Lamar Sekarang</button>
                                        </form>
                                    </div>
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
                <p>Kenali berbagai perusahaan terkemuka yang menawarkan kesempatan karier menarik.</p>
            </div>
        </div>
        <div class="text-end">
            <a href="{{ route('Pelamar.semualowongan') }}" class="mt-5 fw-bold">Lihat semua perusahaan <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="swiper mySwiper mt-3">
            <div class="swiper-wrapper mb-3">
                @foreach ($mitras as $mitra)
                    <div class="swiper-slide">
                        <a href="{{ route('mitra.detail', $mitra->id) }}" class="text-decoration-none">
                            <div class="card shadow" style="border-bottom:6px solid rgb(54, 54, 252);border-radius:16px">
                                <img src="{{ $mitra->gambar ? asset('images/' . $mitra->gambar) : 'https://png.pngtree.com/png-vector/20220730/ourmid/pngtree-m-company-logo-png-image_6092974.png' }}"
                                    class="p-3" style="object-fit: contain; height: 200px;" alt="Logo Perusahaan">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $mitra->nama }}</h5>
                                    <h5 class="card-title">Lowongan tersedia: {{ $mitra->lowongan->count() }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    {{-- END PERUSAHAAN --}}
@endsection

@section('footer')
    <footer class="bg-primary text-white text-center text-lg-start mt-5"
        style="background: linear-gradient(to right, #4d79f3, #1e47ff);">
        <div class="container p-4">
            <div class="row justify-content-center text-center">
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h1 class="text-uppercase fw-bold text-white fw-bold">BKK</h1>
                    <p>
                        Menara Cakrawala 12th Floor Unit 5A <br>
                        Jl. MH. Thamrin, Jakarta Pusat 10340
                    </p>
                    <div class="social-icons mt-4">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-white fw-bold">Tautan Cepat</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#" class="text-white">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#" class="text-white">Kontak</a>
                        </li>
                        <li>
                            <a href="#" class="text-white">Pusat Bantuan</a>
                        </li>
                        <li>
                            <a href="#" class="text-white">Kebijakan Privasi</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-white fw-bold">Hubungi Kami</h5>
                    <p>Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut, silakan hubungi kami:</p>
                    <p>
                        Email: info@bkk.co.id <br>
                        Telepon: (021) 1234-5678
                    </p>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
    <script>
        var swiper = new Swiper('.mySwiper', {
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

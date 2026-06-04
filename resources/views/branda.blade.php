@extends('layouts.appi')

@section('content')

<!-- Hero Section dengan Carousel (Tanpa Tombol Panah) -->
<section id="hero" class="hero section dark-background">
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indicators/Dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h1 class="display-4 fw-bold">Sistem Informasi Dinas Pemberdayaan Perempuan dan Perlindungan Anak</h1>
                            <p class="lead mt-3">Media informasi, edukasi, dan layanan untuk mendukung pemberdayaan perempuan serta perlindungan anak di Kabupaten Tolikara.</p>
                            <div class="mt-4">
                                <a href="#layanan" class="btn btn-primary btn-lg me-2">Lihat Layanan</a>
                                <a href="#pengaduan" class="btn btn-outline-light btn-lg">Laporkan Kasus</a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center" data-aos="fade-left">
                            <img src="{{ asset('assets/img/DPAD3.jpeg') }}" class="img-fluid" alt="Logo DP3A Tolikara" style="max-width: 80%">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h1 class="display-4 fw-bold">Bersama Lindungi Perempuan dan Anak</h1>
                            <p class="lead mt-3">Wujudkan Kabupaten Tolikara yang ramah perempuan dan peduli anak melalui pelayanan terpadu dan responsif.</p>
                            <div class="mt-4">
                                <a href="#profile" class="btn btn-primary btn-lg me-2">Tentang Kami</a>
                                <a href="#pengaduan" class="btn btn-outline-light btn-lg">Laporkan Kasus</a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center" data-aos="fade-left">
                            <img src="{{ asset('assets/img/anak.jpeg') }}" class="img-fluid" alt="Perlindungan Perempuan dan Anak" style="max-width: 80%">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h1 class="display-4 fw-bold">Layanan Pengaduan 24 Jam</h1>
                            <p class="lead mt-3">Butuh bantuan? Laporkan kasus kekerasan terhadap perempuan dan anak. Kami siap membantu dan mendampingi Anda.</p>
                            <div class="mt-4">
                                <a href="#pengaduan" class="btn btn-primary btn-lg me-2">Lapor Sekarang</a>
                                <a href="#kontak" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center" data-aos="fade-left">
                            <img src="{{ asset('assets/img/2-20.jpg') }}" class="img-fluid" alt="Layanan Pengaduan" style="max-width: 80%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Singkat -->
<section id="profile" class="section py-5">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <img src="{{ asset('assets/img/DPAD3.jpeg') }}" class="img-fluid rounded shadow" alt="Profil DP3A Tolikara">
            </div>
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <h2 class="fw-bold mb-4">Tentang Dinas</h2>
                <p class="lead text-muted">Dinas Pemberdayaan Perempuan dan Perlindungan Anak (DP3A) Kabupaten Tolikara</p>
                <p class="mt-3">Bertugas melaksanakan urusan pemerintahan di bidang pemberdayaan perempuan, perlindungan anak, dan pemenuhan hak anak. Kami berkomitmen untuk mewujudkan kesetaraan gender dan perlindungan optimal bagi seluruh perempuan dan anak di Kabupaten Tolikara.</p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Perlindungan Perempuan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Perlindungan Anak</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Pencegahan Kekerasan</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Pemberdayaan Perempuan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Pemenuhan Hak Anak</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Kesetaraan Gender</li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('public.visimisi') }}" class="btn btn-outline-primary mt-3">Baca Visi & Misi</a>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section id="visi-misi" class="section light-background py-5">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Visi & Misi</h2>
            <p class="text-muted">Komitmen DP3A Tolikara untuk masa depan yang lebih baik</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right">
                <a href="{{ route('public.visimisi') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm" style="cursor: pointer;">
                        <div class="card-body p-4">
                            <i class="bi bi-eye fs-1 text-primary"></i>
                            <h3 class="mt-3">Visi</h3>
                            <p class="lead">Terwujudnya Perempuan dan Anak Kabupaten Tolikara yang Berkualitas, Berdaya Saing, dan Terlindungi</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <a href="{{ route('public.visimisi') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm" style="cursor: pointer;">
                        <div class="card-body p-4">
                            <i class="bi bi-bullseye fs-1 text-primary"></i>
                            <h3 class="mt-3">Misi</h3>
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="bi bi-arrow-right-circle text-primary me-2"></i> Meningkatkan kualitas hidup perempuan melalui pemberdayaan ekonomi dan sosial</li>
                                <li class="mb-3"><i class="bi bi-arrow-right-circle text-primary me-2"></i> Melindungi hak-hak anak melalui pencegahan kekerasan dan eksploitasi</li>
                                <li class="mb-3"><i class="bi bi-arrow-right-circle text-primary me-2"></i> Mewujudkan sistem perlindungan yang terintegrasi dan responsif gender</li>
                                <li class="mb-3"><i class="bi bi-arrow-right-circle text-primary me-2"></i> Meningkatkan kapasitas kelembagaan dalam pelayanan publik</li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Kami - Versi Dinamis dari Database -->
<section id="layanan" class="py-5 bg-light">
    <div class="container">
        {{-- Header --}}
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                <i class="bi bi-grid"></i> Layanan Resmi
            </span>
            <h2 class="display-5 fw-bold text-dark">
                Layanan Kami
            </h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Berbagai layanan resmi untuk mendukung pemberdayaan perempuan,
                perlindungan anak, edukasi masyarakat, dan pelayanan sosial
                di Kabupaten Tolikara.
            </p>
        </div>

        {{-- List Layanan Dinamis --}}
        <div class="row g-4">
            @forelse($layanan as $item)
            <div class="col-md-6 col-lg-4"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card layanan-card border-0 shadow-sm h-100 rounded-4 text-center p-4">
                    {{-- Icon Klik --}}
                    <a href="{{ route('public.layanan.show', $item->id_layanan) }}"
                       class="icon-link mx-auto mb-4 text-decoration-none">
                        <div class="icon-circle">
                            @if($item->icon)
                                <i class="{{ $item->icon }}"></i>
                            @else
                                <i class="bi bi-grid"></i>
                            @endif
                        </div>
                    </a>
                    {{-- Nama --}}
                    <h4 class="fw-bold mb-3">
                        {{ $item->nama_layanan }}
                    </h4>
                    {{-- Deskripsi --}}
                    <p class="text-muted mb-0" style="text-align: center;">
                        {{ Str::limit($item->deskripsi, 140) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h4 class="fw-bold mt-3">Belum Ada Layanan</h4>
                    <p class="text-muted">Data layanan belum tersedia saat ini.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Berita Terbaru - FULL CLICKABLE -->
<section id="berita" class="berita section py-5 light-background">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold mb-2">Berita Terbaru</h2>
        <p class="text-muted mb-5">Informasi dan kegiatan terkini DP3A Kabupaten Tolikara</p>
    </div>
    <div class="container">
        <div class="row gy-4">
            @forelse($beritaTerbaru as $berita)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                <a href="{{ route('public.berita.show', $berita->id) }}" class="text-decoration-none">
                    <div class="berita-card h-100" style="cursor: pointer;">
                        <div class="berita-image">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid" alt="{{ $berita->judul }}">
                            @else
                                <img src="{{ asset('assets/img/berita/default.jpg') }}" class="img-fluid" alt="Default Image">
                            @endif
                            <div class="berita-date">
                                <span class="day">{{ $berita->created_at->format('d') }}</span>
                                <span class="month">{{ $berita->created_at->translatedFormat('M') }}</span>
                            </div>
                        </div>
                        <div class="berita-content p-4">
                            <div class="berita-meta mb-2">
                                <span><i class="bi bi-person"></i> {{ $berita->penulis }}</span>
                                <span class="ms-3"><i class="bi bi-eye"></i> {{ number_format($berita->dibaca) }} views</span>
                            </div>
                            <h3 class="berita-title text-dark">{{ $berita->judul }}</h3>
                            <p class="berita-excerpt">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                            <div class="mt-2">
                                <span class="text-primary small fw-semibold">Baca Selengkapnya <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">Belum ada berita terbaru</h5>
                <p class="text-muted">Informasi akan segera diperbarui</p>
            </div>
            @endforelse
        </div>

        <!-- Tombol Lihat Semua Berita -->
        <div class="text-center mt-5">
            <a href="{{ route('public.berita.index') }}" class="btn btn-primary btn-lg px-4">
                Lihat Semua Berita <i class="bi bi-arrow-right-circle ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Tim Ahli DP3A - FULL CLICKABLE -->
<section id="tim" class="tim section py-5">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold mb-2">Tim Ahli DP3A</h2>
        <p class="text-muted mb-5">Kenalan dengan Dinas Pemberdayaan Perempuan dan Perlindungan Anak Tolikara</p>
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-center">
            @forelse($struktur as $item)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                <a href="{{ route('public.struktur.show', $item->id) }}" class="text-decoration-none">
                    <div class="tim-card text-center p-4 rounded shadow-sm" style="cursor: pointer;">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="rounded-circle mb-3" width="150" height="150" alt="{{ $item->nama }}" style="object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/team/default.jpg') }}" class="rounded-circle mb-3" width="150" height="150" alt="Default" style="object-fit: cover;">
                        @endif
                        <h4 class="mb-1 text-dark">{{ $item->nama }}</h4>
                        <p class="text-primary fw-bold">{{ $item->jabatan }}</p>
                        <p class="text-muted small">{{ $item->descripsi ?? 'Berdedikasi untuk pelayanan terbaik' }}</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Data tim akan segera diperbarui</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Statistik
<section class="stats section dark-background py-5">
    <div class="container">
        <div class="row gy-4 text-center">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <span data-purecounter-start="0" data-purecounter-end="120" class="purecounter display-3 fw-bold text-white"></span>
                <p class="text-white-50 mt-2">Kasus Ditangani</p>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <span data-purecounter-start="0" data-purecounter-end="45" class="purecounter display-3 fw-bold text-white"></span>
                <p class="text-white-50 mt-2">Kegiatan Sosialisasi</p>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <span data-purecounter-start="0" data-purecounter-end="30" class="purecounter display-3 fw-bold text-white"></span>
                <p class="text-white-50 mt-2">Desa Binaan</p>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <span data-purecounter-start="0" data-purecounter-end="15" class="purecounter display-3 fw-bold text-white"></span>
                <p class="text-white-50 mt-2">Tenaga Pendamping</p>
            </div>
        </div>
    </div>
</section> -->

<!-- Mitra & Kerjasama -->
<!--<section id="mitra" class="mitra section light-background py-5">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="fw-bold mb-2">Mitra Kerjasama</h2>
        <p class="text-muted mb-5">Bersama wujudkan perlindungan optimal bagi perempuan dan anak</p>
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-center align-items-center">
            <div class="col-lg-2 col-md-4 col-6">
                <img src="{{ asset('assets/img/mitra/polres.png') }}" class="img-fluid grayscale" alt="Polres Tolikara">
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <img src="{{ asset('assets/img/mitra/rsud.png') }}" class="img-fluid grayscale" alt="RSUD Tolikara">
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <img src="{{ asset('assets/img/mitra/kejaksaan.png') }}" class="img-fluid grayscale" alt="Kejaksaan Negeri">
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <img src="{{ asset('assets/img/mitra/pengadilan.png') }}" class="img-fluid grayscale" alt="Pengadilan Negeri">
            </div>
            <div class="col-lg-2 col-md-4 col-6">
                <img src="{{ asset('assets/img/mitra/lbh.png') }}" class="img-fluid grayscale" alt="LBH">
            </div>
        </div>
    </div>
</section> -->

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/layanan.css') }}">
@endpush
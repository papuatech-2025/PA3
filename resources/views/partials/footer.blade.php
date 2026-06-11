<footer id="footer" class="footer light-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <!-- Profil & Kontak -->
            <div class="col-lg-4 footer-about">
                <h4>DP3A Tolikara</h4>
                <p>Sistem Informasi Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara</p>
                
                <div class="footer-contact mt-3">
                    <p><i class="bi bi-geo-alt-fill me-2"></i> Jl.Kota Baru</p>
                    <p><i class="bi bi-telephone-fill me-2"></i> Call Center: 112</p>
                    <p><i class="bi bi-whatsapp me-2"></i> WhatsApp: 081334746721</p>
                    <p><i class="bi bi-envelope-fill me-2"></i> Email: dp3a@tolikarakab.go.id</p>
                </div>
            </div>

            <!-- Menu Links -->
            <div class="col-lg-4 footer-links">
                <h4>Menu</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('branda') }}" class="text-decoration-none">Home</li>
                       <li><a href="{{ route('program.index') }}">Program & Kegiatan</a></li>
                        <li><a href="{{ route('public.pengumuman') }}">Pengumuman</a></li>
                        <li><a href="{{ route('public.layanan.index') }}">Layanan</a></li>
                    <li><a href="{{ route('public.kontak') }}">Contact</a></li>
                                    </ul>
                                </div>

            <!-- Social Media & Jam Layanan -->
            <div class="col-lg-4">
                <h4>Social Media</h4>
                <div class="social-links d-flex gap-3 mb-4">
                    <a href="#" class="text-decoration-none"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-twitter-x fs-4"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-youtube fs-4"></i></a>
                </div>
                
                <h4 class="mt-4">Jam Layanan</h4>
                <p class="mb-1"><i class="bi bi-clock me-2"></i> Senin - Jumat: 08.00 - 16.00 WIT</p>
                <p class="mb-0"><i class="bi bi-headset me-2"></i> Layanan Pengaduan: 24 Jam</p>
                
                <div class="mt-4">
                    <a href="{{ route('laporan.create') }}" class="btn btn-primary btn-sm w-100">Lapor Sekarang →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-5 pt-3 border-top">
        <p class="mb-0">© {{ date('Y') }} Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara</p>
        <p class="small text-muted mt-2">Mewujudkan Kabupaten Tolikara yang ramah perempuan dan peduli anak</p>
    </div>
</footer>
<link rel="stylesheet" href="{{ asset('assets/css/Footer.css') }}">
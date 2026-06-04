<footer id="footer" class="footer light-background">
    <div class="container footer-top">
        <div class="row gy-4">
            <!-- Profil & Kontak -->
            <div class="col-lg-4 footer-about">
                <h4>DP3A Tolikara</h4>
                <p>Sistem Informasi Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tolikara</p>
                
                <div class="footer-contact mt-3">
                    <p><i class="bi bi-geo-alt-fill me-2"></i> Jl. Raya Tolikara, Kabupaten Tolikara, Papua Pegunungan</p>
                    <p><i class="bi bi-telephone-fill me-2"></i> Call Center: 112</p>
                    <p><i class="bi bi-whatsapp me-2"></i> WhatsApp: 0812-XXXX-XXXX</p>
                    <p><i class="bi bi-envelope-fill me-2"></i> Email: dp3a@tolikarakab.go.id</p>
                </div>
            </div>

            <!-- Menu Links -->
            <div class="col-lg-4 footer-links">
                <h4>Menu</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/" class="text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Beranda</a></li>
                    <li class="mb-2"><a href="#profile" class="text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Profil</a></li>
                    <li class="mb-2"><a href="#layanan" class="text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Program  & Kegiatan</a></li>
                    <li class="mb-2"><a href="#tim" class="text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Pengumuman</a></li>
                    <li class="mb-2"><a href="#pengaduan" class="text-decoration-none"><i class="bi bi-chevron-right me-1"></i> Contact</a></li>
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

<style>
    /* Footer Styling */
    .footer {
        background-color: #0a2a44;
        color: #ffffff;
        padding-top: 60px;
        padding-bottom: 30px;
    }
    
    .footer h4 {
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 10px;
    }
    
    .footer h4:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background-color: #0d6efd;
        border-radius: 3px;
    }
    
    .footer p {
        color: #cbd5e1;
        line-height: 1.6;
    }
    
    .footer-contact p {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .footer-contact i {
        color: #0d6efd;
        font-size: 1.1rem;
        min-width: 25px;
    }
    
    .footer-links ul li a {
        color: #cbd5e1;
        transition: all 0.3s ease;
        display: inline-block;
    }
    
    .footer-links ul li a:hover {
        color: #0d6efd;
        transform: translateX(5px);
    }
    
    .footer-links i {
        color: #0d6efd;
        font-size: 0.9rem;
    }
    
    .social-links a {
        color: #cbd5e1;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .social-links a:hover {
        background-color: #0d6efd;
        color: #ffffff;
        transform: translateY(-3px);
    }
    
    .footer .btn-primary {
        background-color: #0d6efd;
        border: none;
        padding: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .footer .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }
    
    .footer .border-top {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .footer {
            padding-top: 40px;
        }
        
        .footer h4:after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .footer h4 {
            text-align: center;
        }
        
        .footer-contact p {
            justify-content: center;
        }
        
        .social-links {
            justify-content: center;
        }
        
        .footer-links ul {
            text-align: center;
        }
        
        .footer-links ul li a:hover {
            transform: translateX(0);
        }
    }
</style>
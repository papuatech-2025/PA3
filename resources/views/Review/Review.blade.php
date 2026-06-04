@extends('layouts.appi')

@section('content')

<!-- Review dan Rating Wisata Wamena Section -->
<section id="review-wisata" class="section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Review & Rating Wisata</h2>
        <p>Pengalaman nyata para wisatawan menjelajahi keindahan Lembah Baliem, Papua Pegunungan</p>
    </div>

    <div class="container">

        <!-- Header Statistik Review -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card bg-primary text-white text-center h-100 shadow">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h1 class="display-1 fw-bold">4.8</h1>
                        <div class="fs-3 mb-2">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                        </div>
                        <p class="lead mb-0">Total 2.847 Ulasan</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Distribusi Rating per Destinasi</h5>
                        
                        <!-- Rating Bar - Festival Lembah Baliem -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span><i class="bi bi-flag-fill text-danger me-2"></i>Festival Lembah Baliem</span>
                                <span class="fw-bold">4.9 <small class="text-muted">(1.245 ulasan)</small></span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 98%"></div>
                            </div>
                        </div>
                        
                        <!-- Rating Bar - Danau Habema -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span><i class="bi bi-water text-primary me-2"></i>Danau Habema</span>
                                <span class="fw-bold">4.8 <small class="text-muted">(876 ulasan)</small></span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 96%"></div>
                            </div>
                        </div>
                        
                        <!-- Rating Bar - Pasir Putih Aikima -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span><i class="bi bi-brightness-alt-high text-warning me-2"></i>Pasir Putih Aikima</span>
                                <span class="fw-bold">4.8 <small class="text-muted">(523 ulasan)</small></span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 96%"></div>
                            </div>
                        </div>
                        
                        <!-- Rating Bar - Mumi Jiwika -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span><i class="bi bi-mortarboard text-secondary me-2"></i>Mumi Jiwika</span>
                                <span class="fw-bold">4.7 <small class="text-muted">(412 ulasan)</small></span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 94%"></div>
                            </div>
                        </div>
                        
                        <!-- Rating Bar - Kampung Wesaput -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span><i class="bi bi-house-door text-info me-2"></i>Kampung Wesaput</span>
                                <span class="fw-bold">4.6 <small class="text-muted">(387 ulasan)</small></span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 92%"></div>
                            </div>
                        </div>
                        
                        <!-- Rating Bar - Pasar Jibama -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span><i class="bi bi-basket text-success me-2"></i>Pasar Jibama</span>
                                <span class="fw-bold">4.4 <small class="text-muted">(298 ulasan)</small></span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 88%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Sortir Ulasan -->
        <div class="row mb-4" data-aos="fade-up" data-aos-delay="150">
            <div class="col-md-8">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active">Semua</button>
                    <button type="button" class="btn btn-outline-primary">Festival</button>
                    <button type="button" class="btn btn-outline-primary">Danau</button>
                    <button type="button" class="btn btn-outline-primary">Budaya</button>
                    <button type="button" class="btn btn-outline-primary">Alam</button>
                    <button type="button" class="btn btn-outline-primary">Kuliner</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                    <select class="form-select w-auto">
                        <option>Terbaru</option>
                        <option>Tertinggi</option>
                        <option>Terendah</option>
                        <option>Terlama</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Daftar Ulasan -->
        <div class="row gy-4 mb-5">

            <!-- Review 1: Festival Lembah Baliem -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card shadow-sm h-100 border-0 hover-effect">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex">
                                <img src="assets/img/avatars/avatar-1.webp" class="rounded-circle me-3" width="60" height="60" alt="User" onerror="this.src='https://via.placeholder.com/60x60'">
                                <div>
                                    <h5 class="mb-1">Budi Santoso</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-geo-alt"></i> Jakarta • 
                                        <i class="bi bi-calendar3"></i> 8 Agustus 2026
                                    </p>
                                    <div class="mb-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <span class="ms-2 badge bg-success">5.0</span>
                                    </div>
                                </div>
                            </div>
                            <span class="badge bg-danger">Festival Lembah Baliem</span>
                        </div>
                        
                        <p class="card-text">"Pengalaman luar biasa menyaksikan Festival Lembah Baliem! Perang-perangan antar suku sangat epik, atraksi bakar batu, dan keramahan masyarakat lokal membuat saya ingin kembali lagi. Festival ini benar-benar memperkenalkan kekayaan budaya Papua ke dunia."</p>
                        
                        <div class="row mt-3 g-2">
                            <div class="col-3">
                                <img src="assets/img/reviews/festival-1.webp" class="img-fluid rounded" alt="Festival 1" onerror="this.src='https://via.placeholder.com/100x100?text=Foto'">
                            </div>
                            <div class="col-3">
                                <img src="assets/img/reviews/festival-2.webp" class="img-fluid rounded" alt="Festival 2" onerror="this.src='https://via.placeholder.com/100x100?text=Foto'">
                            </div>
                            <div class="col-3">
                                <img src="assets/img/reviews/festival-3.webp" class="img-fluid rounded" alt="Festival 3" onerror="this.src='https://via.placeholder.com/100x100?text=Foto'">
                            </div>
                            <div class="col-3">
                                <img src="assets/img/reviews/festival-4.webp" class="img-fluid rounded" alt="Festival 4" onerror="this.src='https://via.placeholder.com/100x100?text=Foto'">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="text-muted small"><i class="bi bi-suit-heart"></i> 124 suka</span>
                                <span class="text-muted small ms-3"><i class="bi bi-chat"></i> 18 balasan</span>
                            </div>
                            <div>
                                <a href="#" class="text-decoration-none me-2"><i class="bi bi-hand-thumbs-up"></i> Bermanfaat</a>
                                <a href="#" class="text-decoration-none"><i class="bi bi-flag"></i> Laporkan</a>
                            </div>
                        </div>
                        
                        <!-- Balasan Admin -->
                        <div class="bg-light p-3 rounded mt-3">
                            <div class="d-flex">
                                <i class="bi bi-shield-check text-primary fs-4 me-2"></i>
                                <div>
                                    <strong>Admin Dinas Pariwisata</strong>
                                    <p class="mb-0 small mt-1">Terima kasih atas kunjungan dan review positifnya, Pak Budi! Senang mendengar Bapak menikmati Festival Lembah Baliem. Sampai jumpa di festival tahun depan! 🏹🔥</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 2: Danau Habema -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <div class="card shadow-sm h-100 border-0 hover-effect">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex">
                                <img src="assets/img/avatars/avatar-2.webp" class="rounded-circle me-3" width="60" height="60" alt="User" onerror="this.src='https://via.placeholder.com/60x60'">
                                <div>
                                    <h5 class="mb-1">Sarah Wijaya</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-geo-alt"></i> Surabaya • 
                                        <i class="bi bi-calendar3"></i> 15 Juli 2026
                                    </p>
                                    <div class="mb-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-half text-warning"></i>
                                        <span class="ms-2 badge bg-success">4.5</span>
                                    </div>
                                </div>
                            </div>
                            <span class="badge bg-info">Danau Habema</span>
                        </div>
                        
                        <p class="card-text">"Danau di atas awan! Benar-benar luar biasa bisa melihat danau tertinggi di Indonesia (3.300 mdpl). Udaranya sangat dingin, pastikan bawa jaket tebal. Pemandangan matahari terbitnya tidak terlupakan. Sayang akses jalannya perlu perbaikan."</p>
                        
                        <div class="mt-3">
                            <span class="badge bg-light text-dark me-2">⏱️ Trekking 30 menit</span>
                            <span class="badge bg-light text-dark">🌡️ Suhu 5°C</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="text-muted small"><i class="bi bi-suit-heart"></i> 87 suka</span>
                                <span class="text-muted small ms-3"><i class="bi bi-chat"></i> 9 balasan</span>
                            </div>
                            <div>
                                <a href="#" class="text-decoration-none me-2"><i class="bi bi-hand-thumbs-up"></i> Bermanfaat</a>
                                <a href="#" class="text-decoration-none"><i class="bi bi-flag"></i> Laporkan</a>
                            </div>
                        </div>
                        
                        <!-- Balasan Admin -->
                        <div class="bg-light p-3 rounded mt-3">
                            <div class="d-flex">
                                <i class="bi bi-shield-check text-primary fs-4 me-2"></i>
                                <div>
                                    <strong>Admin Dinas Pariwisata</strong>
                                    <p class="mb-0 small mt-1">Terima kasih Mbak Sarah. Saat ini Dinas PU sedang melakukan peningkatan akses jalan menuju Danau Habema. Diharapkan tahun depan sudah lebih baik! 🏞️</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 3: Pasir Putih Aikima -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card shadow-sm h-100 border-0 hover-effect">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex">
                                <img src="assets/img/avatars/avatar-3.webp" class="rounded-circle me-3" width="60" height="60" alt="User" onerror="this.src='https://via.placeholder.com/60x60'">
                                <div>
                                    <h5 class="mb-1">Michael Chen</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-geo-alt"></i> Malaysia • 
                                        <i class="bi bi-calendar3"></i> 3 Juni 2026
                                    </p>
                                    <div class="mb-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <span class="ms-2 badge bg-success">5.0</span>
                                    </div>
                                </div>
                            </div>
                            <span class="badge bg-warning text-dark">Pasir Putih Aikima</span>
                        </div>
                        
                        <p class="card-text">"Amazing! Hamparan pasir putih di tengah pegunungan, sungguh keajaiban alam. Bekas danau purba yang mengering, pemandangannya seperti di negeri dongeng. Sangat direkomendasikan untuk fotografer. Tiket masuk sangat terjangkau."</p>
                        
                        <div class="mt-3">
                            <span class="badge bg-light text-dark me-2">🎫 Tiket Rp25K</span>
                            <span class="badge bg-light text-dark">📸 Spot foto instagramable</span>
                        </div>
                        
                        <div class="row mt-3 g-2">
                            <div class="col-4">
                                <img src="assets/img/reviews/aikima-1.webp" class="img-fluid rounded" alt="Aikima 1" onerror="this.src='https://via.placeholder.com/150x100?text=Foto'">
                            </div>
                            <div class="col-4">
                                <img src="assets/img/reviews/aikima-2.webp" class="img-fluid rounded" alt="Aikima 2" onerror="this.src='https://via.placeholder.com/150x100?text=Foto'">
                            </div>
                            <div class="col-4">
                                <img src="assets/img/reviews/aikima-3.webp" class="img-fluid rounded" alt="Aikima 3" onerror="this.src='https://via.placeholder.com/150x100?text=Foto'">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="text-muted small"><i class="bi bi-suit-heart"></i> 156 suka</span>
                                <span class="text-muted small ms-3"><i class="bi bi-chat"></i> 21 balasan</span>
                            </div>
                            <div>
                                <a href="#" class="text-decoration-none me-2"><i class="bi bi-hand-thumbs-up"></i> Bermanfaat</a>
                                <a href="#" class="text-decoration-none"><i class="bi bi-flag"></i> Laporkan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 4: Mumi Jiwika -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="350">
                <div class="card shadow-sm h-100 border-0 hover-effect">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex">
                                <img src="assets/img/avatars/avatar-4.webp" class="rounded-circle me-3" width="60" height="60" alt="User" onerror="this.src='https://via.placeholder.com/60x60'">
                                <div>
                                    <h5 class="mb-1">Dr. Ahmad Fauzi</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-geo-alt"></i> Yogyakarta • 
                                        <i class="bi bi-calendar3"></i> 20 Mei 2026
                                    </p>
                                    <div class="mb-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star text-warning"></i>
                                        <span class="ms-2 badge bg-success">4.0</span>
                                    </div>
                                </div>
                            </div>
                            <span class="badge bg-secondary">Mumi Jiwika</span>
                        </div>
                        
                        <p class="card-text">"Mumi berusia 350 tahun yang diawetkan dengan proses pengasapan, berbeda dengan mumi Mesir. Sangat unik dan bernilai sejarah tinggi. Sayangnya penjelasan dari guide kurang detail dan fasilitas museum perlu ditingkatkan."</p>
                        
                        <div class="mt-3">
                            <span class="badge bg-light text-dark me-2">🎫 Tiket Rp100K + donasi</span>
                            <span class="badge bg-light text-dark">🏛️ Situs budaya</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="text-muted small"><i class="bi bi-suit-heart"></i> 67 suka</span>
                                <span class="text-muted small ms-3"><i class="bi bi-chat"></i> 14 balasan</span>
                            </div>
                            <div>
                                <a href="#" class="text-decoration-none me-2"><i class="bi bi-hand-thumbs-up"></i> Bermanfaat</a>
                                <a href="#" class="text-decoration-none"><i class="bi bi-flag"></i> Laporkan</a>
                            </div>
                        </div>
                        
                        <!-- Balasan Admin -->
                        <div class="bg-light p-3 rounded mt-3">
                            <div class="d-flex">
                                <i class="bi bi-shield-check text-primary fs-4 me-2"></i>
                                <div>
                                    <strong>Admin Dinas Pariwisata</strong>
                                    <p class="mb-0 small mt-1">Terima kasih masukannya, Pak Ahmad. Kami sedang berkoordinasi dengan pengelola untuk meningkatkan kualitas penjelasan dan fasilitas museum. 🙏</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Tulis Review -->
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Tulis Review Anda</h5>
                    </div>
                    <div class="card-body p-4">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Masukkan email Anda">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Destinasi</label>
                                    <select class="form-select">
                                        <option selected>Pilih destinasi</option>
                                        <option>Festival Lembah Baliem</option>
                                        <option>Danau Habema</option>
                                        <option>Pasir Putih Aikima</option>
                                        <option>Mumi Jiwika</option>
                                        <option>Kampung Wesaput</option>
                                        <option>Pasar Jibama</option>
                                        <option>Air Terjun Napua</option>
                                        <option>Pondok Apung Wio Silimo</option>
                                        <option>Batas Batu</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Kunjungan</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Rating</label>
                                    <div class="rating-input">
                                        <i class="bi bi-star fs-3 text-warning" data-rating="1"></i>
                                        <i class="bi bi-star fs-3 text-warning" data-rating="2"></i>
                                        <i class="bi bi-star fs-3 text-warning" data-rating="3"></i>
                                        <i class="bi bi-star fs-3 text-warning" data-rating="4"></i>
                                        <i class="bi bi-star fs-3 text-warning" data-rating="5"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Review Anda</label>
                                <textarea class="form-control" rows="5" placeholder="Ceritakan pengalaman Anda..."></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Upload Foto (opsional)</label>
                                <input type="file" class="form-control" multiple>
                                <div class="form-text">Anda dapat mengunggah hingga 5 foto. Format: JPG, PNG (max 5MB)</div>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms">
                                <label class="form-check-label" for="terms">Saya menyatakan bahwa review ini berdasarkan pengalaman asli dan sesuai dengan <a href="#">syarat & ketentuan</a></label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-send me-2"></i> Kirim Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Menulis Review -->
        <div class="row" data-aos="fade-up">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary mb-3"><i class="bi bi-lightbulb"></i> Tips Menulis Review</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Ceritakan pengalaman secara jujur dan detail</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertakan foto-foto terbaik Anda</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Beri informasi bermanfaat seperti akses, harga, waktu terbaik</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Hormati privasi dan budaya masyarakat lokal</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary mb-3"><i class="bi bi-shield-check"></i> Moderasi Review</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-clock-history me-2"></i> Review akan dimoderasi sebelum ditampilkan [citation:8]</li>
                            <li class="mb-2"><i class="bi bi-star me-2"></i> Rating dan ulasan membantu wisatawan lain memilih destinasi [citation:6]</li>
                            <li class="mb-2"><i class="bi bi-translate me-2"></i> Review dapat ditulis dalam Bahasa Indonesia atau Inggris</li>
                            <li class="mb-2"><i class="bi bi-shield me-2"></i> Review tidak mengandung SARA, ujaran kebencian, atau konten tidak pantas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                </ul>
            </nav>
        </div>

    </div>
</section>

<!-- Custom CSS -->
<style>
.hover-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-effect:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 2rem rgba(0,0,0,.15)!important;
}
.rating-input i {
    cursor: pointer;
    transition: color 0.2s ease;
}
.rating-input i:hover,
.rating-input i.hover {
    color: #ffc107;
}
.progress {
    border-radius: 10px;
}
.badge {
    padding: 6px 12px;
}
</style>

<!-- JavaScript untuk Rating Input -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-input i');
    stars.forEach(star => {
        star.addEventListener('mouseenter', function() {
            const rating = this.dataset.rating;
            stars.forEach(s => {
                if(s.dataset.rating <= rating) {
                    s.classList.remove('bi-star');
                    s.classList.add('bi-star-fill');
                } else {
                    s.classList.remove('bi-star-fill');
                    s.classList.add('bi-star');
                }
            });
        });
    });
    
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        stars.forEach(s => {
            s.classList.remove('bi-star-fill');
            s.classList.add('bi-star');
        });
    });
});
</script>
@endsection
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 class="mt-4 mb-1 fw-bold" style="color:#0d1f35;font-family:'Plus Jakarta Sans',sans-serif;font-size:1.6rem;letter-spacing:-0.5px;">
                <i class="bi bi-speedometer2 me-2" style="color:#F5A623;"></i>
                Dashboard Dinas P3A Tolikara
            </h1>
            <ol class="breadcrumb mb-0 bg-transparent p-0">
                <li class="breadcrumb-item">
                    <a href="#" style="color:#F5A623;text-decoration:none;font-size:0.85rem;">Home</a>
                </li>
                <li class="breadcrumb-item active" style="color:#8a9ab0;font-size:0.85rem;">Dashboard</li>
            </ol>
        </div>
        <div class="d-flex align-items-center gap-2 bg-white px-4 py-2 rounded-3 shadow-sm mt-3 mt-md-0" style="border:1px solid #e4eaf2;">
            <i class="bi bi-calendar3" style="color:#F5A623;"></i>
            <span class="fw-semibold small" style="color:#1a2e4a;">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <!-- Card Total Masyarakat -->
        <div class="col-xl-4 col-md-6">
            <div class="stat-card" style="background:linear-gradient(135deg,#1a2e4a 0%,#0d1f35 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-uppercase fw-bold" style="font-size:0.72rem;letter-spacing:0.8px;color:rgba(255,255,255,0.55);">Total Masyarakat</p>
                        <h2 class="mb-1 fw-bold" style="font-size:2.2rem;color:#FFD080;font-family:'Plus Jakarta Sans',sans-serif;line-height:1;">{{ $totalMasyarakat ?? 0 }}</h2>
                        <span class="badge" style="background:rgba(255,255,255,0.12);font-size:0.7rem;border-radius:6px;color:rgba(255,255,255,0.75);">
                            <i class="bi bi-arrow-up me-1"></i>+{{ $masyarakatBaru ?? 0 }} bulan ini
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width:56px;height:56px;background:rgba(245,166,35,0.2);flex-shrink:0;">
                        <i class="bi bi-people-fill fs-2" style="color:#F5A623;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card Kasus Kekerasan -->
        <div class="col-xl-4 col-md-6">
            <div class="stat-card" style="background:linear-gradient(135deg,#7B2D00 0%,#5C1A00 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-uppercase fw-bold" style="font-size:0.72rem;letter-spacing:0.8px;color:rgba(255,255,255,0.55);">Kasus Kekerasan</p>
                        <h2 class="mb-1 fw-bold" style="font-size:2.2rem;color:#FFD080;font-family:'Plus Jakarta Sans',sans-serif;line-height:1;">{{ $totalKasus ?? 0 }}</h2>
                        <span class="badge" style="background:rgba(255,255,255,0.12);font-size:0.7rem;border-radius:6px;color:rgba(255,255,255,0.75);">
                            Perempuan: {{ $kasusPerempuan ?? 0 }}
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width:56px;height:56px;background:rgba(255,255,255,0.12);flex-shrink:0;">
                        <i class="bi bi-exclamation-triangle-fill fs-2" style="color:#FFB74D;"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card Kegiatan Sosialisasi -->
        <div class="col-xl-4 col-md-6">
            <div class="stat-card" style="background:linear-gradient(135deg,#3E2723 0%,#1A0F0D 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-uppercase fw-bold" style="font-size:0.72rem;letter-spacing:0.8px;color:rgba(255,255,255,0.55);">Kegiatan Sosialisasi</p>
                        <h2 class="mb-1 fw-bold" style="font-size:2.2rem;color:#FFD080;font-family:'Plus Jakarta Sans',sans-serif;line-height:1;">{{ $totalProgram ?? 0 }}</h2>
                        <span class="badge" style="background:rgba(255,255,255,0.12);font-size:0.7rem;border-radius:6px;color:rgba(255,255,255,0.75);">
                            <i class="bi bi-arrow-up me-1"></i>+{{ $programAktif ?? 0 }} aktif
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width:56px;height:56px;background:rgba(255,255,255,0.12);flex-shrink:0;">
                        <i class="bi bi-megaphone-fill fs-2" style="color:#FFCC80;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0" style="border-radius:16px;box-shadow:0 4px 24px rgba(13,31,53,0.08);">
                <div class="card-header d-flex align-items-center justify-content-between" style="background:white;border-bottom:2px solid #EEF2F7;border-radius:16px 16px 0 0;padding:1rem 1.5rem;">
                    <h6 class="mb-0 fw-bold" style="color:#0d1f35;font-family:'Plus Jakarta Sans',sans-serif;font-size:0.95rem;">
                        <i class="bi bi-lightning-charge-fill me-2" style="color:#F5A623;"></i>
                        Aksi Cepat
                    </h6>
                    <span class="badge" style="background:#EEF2F7;color:#8a9ab0;font-size:0.7rem;border-radius:6px;font-weight:600;">5 menu</span>
                </div>
                <div class="card-body" style="padding:1.25rem 1.5rem;">
                    <div class="row g-3">
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="" class="quick-action-link">
                                <div class="quick-action-card">
                                    <div class="quick-action-icon bg-soft-pink">
                                        <i class="bi bi-plus-circle"></i>
                                    </div>
                                    <span>Input Kasus</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.masyarakat.create') }}" class="quick-action-link">
                                <div class="quick-action-card">
                                    <div class="quick-action-icon bg-soft-blue">
                                        <i class="bi bi-person-plus"></i>
                                    </div>
                                    <span>Tambah Masyarakat</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.program.create') }}" class="quick-action-link">
                                <div class="quick-action-card">
                                    <div class="quick-action-icon bg-soft-purple">
                                        <i class="bi bi-calendar-plus"></i>
                                    </div>
                                    <span>Buat Program</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <a href="{{ route('admin.pengumuman.index') }}" class="quick-action-link">
                                <div class="quick-action-card">
                                       <div class="quick-action-icon bg-soft-pink-blue">
                                        <i class="bi bi-megaphone"></i>
                                    </div>
                                    <span>Pengumuman</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.stat-card {
    border-radius: 16px;
    padding: 1.4rem;
    color: white;
    box-shadow: 0 8px 28px rgba(13,31,53,0.22);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}
.stat-card::after {
    content:'';
    position:absolute;
    bottom:-20px;right:-20px;
    width:90px;height:90px;
    background:rgba(255,255,255,0.04);
    border-radius:50%;
    pointer-events:none;
}
.stat-card:hover { transform:translateY(-5px); box-shadow:0 16px 40px rgba(13,31,53,0.3); }

.quick-action-link { text-decoration:none; display:block; }
.quick-action-card {
    background:white;
    border-radius:14px;
    padding:1.1rem 0.5rem;
    text-align:center;
    transition:all 0.25s ease;
    border:2px solid #EEF2F7;
    box-shadow:0 2px 12px rgba(13,31,53,0.06);
}
.quick-action-card:hover { transform:translateY(-4px); box-shadow:0 10px 28px rgba(13,31,53,0.12); border-color:#F5A623; }
.quick-action-icon { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px; }
.quick-action-icon i { font-size:1.3rem;color:white; }
.quick-action-card span { color:#1a2e4a;font-size:0.82rem;font-weight:600; }

.bg-soft-green { background:linear-gradient(135deg,#1a6b35,#2ea04f); }
.bg-soft-blue { background:linear-gradient(135deg,#1565C0,#2196F3); }
.bg-soft-purple { background:linear-gradient(135deg,#6A1B9A,#AB47BC); }
.bg-soft-brown { background:linear-gradient(135deg,#5D4037,#8D6E63); }
.bg-soft-pink { background:linear-gradient(135deg,#AD1457,#EC407A); }
.bg-soft-pink-blue { background:linear-gradient(135deg,#0277BD,#29B6F6); }

@media(max-width:768px){
    .stat-card{padding:1.1rem;}
    .quick-action-card{padding:0.9rem 0.3rem;}
    .quick-action-icon{width:40px;height:40px;}
    .quick-action-icon i{font-size:1.1rem;}
}
</style>
@endsection
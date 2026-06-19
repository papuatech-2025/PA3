<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard') - Dashboard DP3A</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Simple DataTables -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
    <!-- Summernote (untuk rich text editor) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.css" rel="stylesheet">
    <!-- Custom Admin CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.css') }}">

    
    <style>
        :root {
            --primary: #1a2e4a;
            --primary-dark: #0d1f35;
            --accent: #F5A623;
        }

        body { font-family: 'DM Sans', 'Segoe UI', sans-serif; background: #EEF2F7; }

        .navbar {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #0d1f35 0%, #1a2e4a 100%) !important;
            border-bottom: 3px solid #F5A623;
            box-shadow: 0 4px 20px rgba(13,31,53,0.25);
        }

        .navbar-brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            color: white !important;
            display: flex;
            align-items: center;
            letter-spacing: -0.3px;
        }

        .navbar-brand i { color: #F5A623; font-size: 1.6rem; margin-right: 10px; }

        .sidebar {
            background: linear-gradient(180deg, #0d1f35 0%, #1a2e4a 100%) !important;
            border-right: none !important;
            box-shadow: 4px 0 24px rgba(13,31,53,0.2);
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.6) !important;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            margin: 2px 0;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white !important;
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background: #F5A623 !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(245,166,35,0.35);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            color: rgba(255,255,255,0.45);
        }

        .sidebar .nav-link.active i { color: white; }

        .sidebar .collapse .nav-link {
            padding-left: 2.6rem;
            font-size: 0.84rem;
            border-radius: 8px;
        }

        .sidebar hr { border-color: rgba(255,255,255,0.08); margin: 1.2rem 0; }

        .main-content { background: #EEF2F7; min-height: 100vh; }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: #F5A623; border-radius: 4px; }

        .dropdown-menu {
            border: none;
            border-radius: 14px;
            box-shadow: 0 10px 36px rgba(13,31,53,0.18);
            padding: 0.6rem 0;
        }

        .dropdown-item {
            padding: 0.65rem 1.5rem;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .dropdown-item:hover {
            background: #EEF2F7;
            color: #0d1f35;
            padding-left: 2rem;
        }

        .dropdown-item i { margin-right: 10px; width: 20px; color: #1a2e4a; }
        .dropdown-item.text-danger i { color: #E53935; }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }
        .navbar .badge { animation: pulse 2.5s infinite; }

        /* Custom style untuk table */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background: #F8F9FC;
            border-bottom: 2px solid #E9ECEF;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Card style */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        
        /* Button styles */
        .btn-primary {
            background: linear-gradient(135deg, #1a2e4a, #0d1f35);
            border: none;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #F5A623, #e09612);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245,166,35,0.3);
        }
        
        /* Alert styles */
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        @media (max-width: 768px) {
            .sidebar { position: sticky; top: 0; z-index: 1000; max-height: 100vh; overflow-y: auto; }
        }
        
        /* Summernote custom */
        .note-editor.note-frame {
            border-radius: 12px;
            border-color: #E9ECEF;
        }
        
        .note-editor.note-frame .note-editing-area {
            border-radius: 12px;
        }
        
        /* Image preview */
        .image-preview {
            position: relative;
            display: inline-block;
        }
        
        .image-preview img {
            border-radius: 12px;
            border: 2px solid #E9ECEF;
        }
        
        .image-preview .remove-image {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #E53935;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .image-preview .remove-image:hover {
            transform: scale(1.1);
        }
        
        /* Dropzone style */
        .dropzone {
            transition: all 0.3s;
        }
        
        .dropzone.dragover {
            background: #F8F9FC;
            border-color: #F5A623;
        }
        
        /* Badge styles */
        .badge-publish {
            background: #E8F5E9;
            color: #2E7D32;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-draft {
            background: #FFF3E0;
            color: #E65100;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-active {
            background: #E8F5E9;
            color: #2E7D32;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-inactive {
            background: #FFEBEE;
            color: #C62828;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        /* Pagination custom */
        .pagination {
            margin-top: 1.5rem;
        }
        
        .page-link {
            border: none;
            border-radius: 8px;
            margin: 0 3px;
            color: #1a2e4a;
            transition: all 0.2s;
        }
        
        .page-link:hover {
            background: #F5A623;
            color: white;
        }
        
        .page-item.active .page-link {
            background: #F5A623;
            color: white;
        }
    </style>
    
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
</head>

<body class="sb-nav-fixed">

<!-- NAVBAR -->
<nav class="navbar navbar-expand navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shield-fill-check"></i>
            <span class="d-none d-sm-inline">Dashboard Dinas P3A Tolikara</span>
            <span class="d-inline d-sm-none">Admin</span>
        </a>
        
        <div class="d-flex align-items-center gap-2">
            
            <!-- Profile Admin -->
            <div class="dropdown">
                <button class="btn btn-link text-white dropdown-toggle d-flex align-items-center gap-2 p-2" type="button" data-bs-toggle="dropdown" style="text-decoration:none;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:34px;height:34px;background:rgba(245,166,35,0.2);border:2px solid rgba(245,166,35,0.45);">
                        <i class="bi bi-person-fill" style="color:#FFD080;font-size:1rem;"></i>
                    </div>
                    <span class="d-none d-md-inline fw-semibold small">Admin</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="min-width:240px;">
                    <li>
                        <div class="px-4 py-3" style="border-bottom:1px solid #EEF2F7;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:42px;height:42px;background:linear-gradient(135deg,#1a2e4a,#0d1f35);">
                                    <i class="bi bi-person-fill text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="color:#0d1f35;font-size:0.88rem;">Administrator</div>
                                    <div class="text-muted" style="font-size:0.76rem;">admin@dp3a.go.id</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-shield-check me-2"></i>Keamanan</a></li>
                    <li><hr class="dropdown-divider"></li>
                   <li>
                        <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 sidebar min-vh-100 p-3">
            <div class="mb-4 mt-2">
                <p class="text-uppercase fw-bold mb-0" style="color:rgba(255,255,255,0.35);font-size:0.68rem;letter-spacing:1.5px;">Menu Utama</p>
            </div>
            
            <ul class="nav flex-column">
                <!-- Dashboard -->
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i><span>Dashboard</span>
                    </a>
                </li>

                <!-- Data Masyarakat -->
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.masyarakat.*') ? 'active' : '' }}" 
                       data-bs-toggle="collapse" href="#menuMasyarakat" role="button"
                       aria-expanded="{{ request()->routeIs('admin.masyarakat.*') ? 'true' : 'false' }}">
                        <i class="bi bi-people"></i>
                        <span>Data Masyarakat</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.masyarakat.*') ? 'show' : '' }}" id="menuMasyarakat">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li><a href="{{ route('admin.masyarakat.index') }}" class="nav-link small py-1 {{ request()->routeIs('admin.masyarakat.index') ? 'active' : '' }}"><i class="bi bi-database"></i> Semua Data</a></li>
                            <li><a href="{{ route('admin.masyarakat.create') }}" class="nav-link small py-1 {{ request()->routeIs('admin.masyarakat.create') ? 'active' : '' }}"><i class="bi bi-person-plus"></i> Tambah Data</a></li>
                            <li><a href="{{ route('admin.masyarakat.search') }}" class="nav-link small py-1 {{ request()->routeIs('admin.masyarakat.search') ? 'active' : '' }}"><i class="bi bi-search"></i> Cari & Filter</a></li>
                            <li><a href="{{ route('admin.masyarakat.archive') }}" class="nav-link small py-1 {{ request()->routeIs('admin.masyarakat.archive') ? 'active' : '' }}"><i class="bi bi-archive"></i> Arsip Data</a></li>
                            <li><a href="{{ route('admin.masyarakat.reports') }}" class="nav-link small py-1 {{ request()->routeIs('admin.masyarakat.reports') ? 'active' : '' }}"><i class="bi bi-bar-chart"></i> Laporan & Statistik</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Layanan -->
                <li class="nav-item mb-1">
                    <a class="nav-link" data-bs-toggle="collapse" href="#menuKB" role="button">
                        <i class="bi bi-person-fill"></i><span>Layanan</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    <div class="collapse" id="menuKB">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li><a href="{{ route('admin.layanan.create') }}" class="nav-link small py-1"><i class="bi bi-plus-circle"></i>Tambah layanan</a></li>
                            <li><a href="{{ route('admin.layanan.index') }}" class="nav-link small py-1"><i class="bi bi-list-ul"></i> Semua layanan</a></li>
                            <li><a href="{{ route('admin.layanan.index') }}" class="nav-link small py-1"><i class="bi bi-gear"></i> Kelola layanan</a></li>
                        </ul>
                    </div>
                </li>
               <!-- Laporan Masyarakat -->
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" 
                    data-bs-toggle="collapse" href="#menuLaporanMasyarakat" role="button"
                    aria-expanded="{{ request()->routeIs('admin.laporan.*') ? 'true' : 'false' }}">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Laporan Masyarakat</span>
                        @php
                            $laporanBaru = App\Models\Laporan::where('status', 'baru')->count();
                        @endphp
                        @if($laporanBaru > 0)
                            <span class="badge bg-danger float-end" style="font-size:0.62rem;">{{ $laporanBaru }}</span>
                        @endif
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.laporan.*') ? 'show' : '' }}" id="menuLaporanMasyarakat">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li><a href="{{ route('admin.laporan.index') }}" class="nav-link small py-1 {{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
                                <i class="bi bi-inbox"></i> Semua Laporan
                            </a></li>
                            <li><a href="{{ route('admin.laporan.index', ['status' => 'baru']) }}" class="nav-link small py-1">
                                <i class="bi bi-envelope"></i> Laporan Baru
                                @if($laporanBaru > 0)
                                    <span class="badge bg-danger float-end" style="font-size:0.62rem;">{{ $laporanBaru }}</span>
                                @endif
                            </a></li>
                            <li><a href="{{ route('admin.laporan.index', ['status' => 'diproses']) }}" class="nav-link small py-1">
                                <i class="bi bi-arrow-repeat"></i> Diproses
                            </a></li>
                            <li><a href="{{ route('admin.laporan.index', ['status' => 'selesai']) }}" class="nav-link small py-1">
                                <i class="bi bi-check-circle"></i> Selesai
                            </a></li>
                            <li><a href="{{ route('admin.laporan.index', ['status' => 'ditolak']) }}" class="nav-link small py-1">
                                <i class="bi bi-x-circle"></i> Ditolak
                            </a></li>
                        </ul>
                    </div>
                </li>

                <!-- Peserta KB 
                <li class="nav-item mb-1">
                    <a class="nav-link" data-bs-toggle="collapse" href="#menuKB" role="button">
                        <i class="bi bi-person-fill"></i><span>Peserta KB</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    <div class="collapse" id="menuKB">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-plus-circle"></i> Daftar Baru</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-list-ul"></i> Data Peserta</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-calendar-check"></i> Jadwal KB</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-file-pdf"></i> Laporan KB</a></li>
                        </ul>
                    </div>
                </li> -->

                  <!-- Program & Kegiatan -->
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('admin.program.*') ? 'active' : '' }}" 
                    data-bs-toggle="collapse" href="#menuProgram" role="button"
                    aria-expanded="{{ request()->routeIs('admin.program.*') ? 'true' : 'false' }}">
                        <i class="bi bi-calendar-event"></i>
                        <span>Program & Kegiatan</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.program.*') ? 'show' : '' }}" id="menuProgram">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li><a href="{{ route('admin.program.index') }}" class="nav-link small py-1 {{ request()->routeIs('admin.program.index') ? 'active' : '' }}"><i class="bi bi-database"></i> Semua Program</a></li>
                            <li><a href="{{ route('admin.program.create') }}" class="nav-link small py-1 {{ request()->routeIs('admin.program.create') ? 'active' : '' }}"><i class="bi bi-plus-circle"></i> Tambah Program</a></li>
                            <li><a href="{{ route('admin.program.index', ['status' => 'active']) }}" class="nav-link small py-1"><i class="bi bi-check-circle"></i> Program Aktif</a></li>
                            <li><a href="{{ route('admin.program.index', ['status' => 'inactive']) }}" class="nav-link small py-1"><i class="bi bi-x-circle"></i> Program Nonaktif</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Jadwal
                <li class="nav-item mb-1">
                    <a class="nav-link" data-bs-toggle="collapse" href="#menuJadwal" role="button">
                        <i class="bi bi-calendar-week"></i><span>Jadwal</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    <div class="collapse" id="menuJadwal">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-plus-circle"></i> Tambah Jadwal</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-calendar-check"></i> Konseling</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-people"></i> Penyuluhan</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-briefcase"></i> Pelatihan</a></li>
                        </ul>
                    </div>
                </li> 
                -->

                <!-- Pengumuman dengan active state -->
                <li class="nav-item mb-1">
                    <a class="nav-link {{ Request::is('admin/pengumuman*') ? 'active' : '' }}" 
                    data-bs-toggle="collapse" 
                    href="#menuPengumuman" 
                    role="button">
                        <i class="bi bi-megaphone-fill"></i><span>Pengumuman</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    <div class="collapse {{ Request::is('admin/pengumuman*') ? 'show' : '' }}" id="menuPengumuman">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li>
                                <a href="{{ route('admin.pengumuman.create') }}" 
                                class="nav-link small py-1 {{ Request::is('admin/pengumuman/create') ? 'active' : '' }}">
                                    <i class="bi bi-plus-circle"></i> Buat Pengumuman
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.pengumuman.index') }}" 
                                class="nav-link small py-1 {{ Request::is('admin/pengumuman') ? 'active' : '' }}">
                                    <i class="bi bi-list-ul"></i> Semua Pengumuman
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item my-2"><hr style="border-color:rgba(255,255,255,0.08);margin:0;"></li>

                <!-- Master Data
                <li class="nav-item mb-1">
                    <a class="nav-link" data-bs-toggle="collapse" href="#menuMaster" role="button">
                        <i class="bi bi-database"></i><span>Master Data</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    <div class="collapse" id="menuMaster">
                        <ul class="nav flex-column ms-2 mt-1">
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-geo-alt"></i> Distrik</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-tag"></i> Kategori Kasus</a></li>
                            <li><a href="#" class="nav-link small py-1"><i class="bi bi-person-badge"></i> Tenaga Pendamping</a></li>
                        </ul>
                    </div>
                </li>-->

                <!-- BERITA, STRUKTUR ORGANISASI & ABOUT (KELOLA KONTEN) -->
               <!-- BERITA, STRUKTUR ORGANISASI, ABOUT & VISI MISI (KELOLA KONTEN) -->
                <li class="nav-item mb-1">
                    <!-- Tambahkan request()->routeIs('admin.visimisi.*') di sini -->
                    <a class="nav-link {{ request()->routeIs('admin.berita.*') || request()->routeIs('admin.struktur.*') || request()->routeIs('admin.about.*') || request()->routeIs('admin.visimisi.*') ? 'active' : '' }}" 
                    data-bs-toggle="collapse" href="#menuKelolaKonten" role="button"
                    aria-expanded="{{ request()->routeIs('admin.berita.*') || request()->routeIs('admin.struktur.*') || request()->routeIs('admin.about.*') || request()->routeIs('admin.visimisi.*') ? 'true' : 'false' }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Kelola Konten</span>
                        <i class="bi bi-chevron-down float-end" style="font-size:0.72rem;margin-top:4px;"></i>
                    </a>
                    
                    <div class="collapse {{ request()->routeIs('admin.berita.*') || request()->routeIs('admin.struktur.*') || request()->routeIs('admin.about.*') || request()->routeIs('admin.visimisi.*') ? 'show' : '' }}" id="menuKelolaKonten">
                        <ul class="nav flex-column ms-2 mt-1">
                            
                            <!-- Menu Berita -->
                            <li class="mt-1">
                                <div class="text-white-50 small fw-semibold mb-1" style="font-size:0.7rem;letter-spacing:1px;padding-left:1.5rem;">
                                    <i class="bi bi-newspaper me-1"></i> MANAJEMEN BERITA
                                </div>
                            </li>
                            <li><a href="{{ route('admin.berita.index') }}" class="nav-link small py-1 {{ request()->routeIs('admin.berita.index') ? 'active' : '' }}"><i class="bi bi-database"></i> Semua Berita</a></li>
                            <li><a href="{{ route('admin.berita.create') }}" class="nav-link small py-1 {{ request()->routeIs('admin.berita.create') ? 'active' : '' }}"><i class="bi bi-plus-circle"></i> Tambah Berita</a></li>
                            
                            <li><hr class="my-2" style="border-color:rgba(255,255,255,0.08);"></li>
                            
                            <!-- Menu Struktur Organisasi -->
                            <li>
                                <div class="text-white-50 small fw-semibold mb-1" style="font-size:0.7rem;letter-spacing:1px;padding-left:1.5rem;">
                                    <i class="bi bi-diagram-3 me-1"></i> STRUKTUR ORGANISASI
                                </div>
                            </li>
                            <li><a href="{{ route('admin.struktur.index') }}" class="nav-link small py-1 {{ request()->routeIs('admin.struktur.index') ? 'active' : '' }}"><i class="bi bi-people"></i> Data Pegawai</a></li>
                            <li><a href="{{ route('admin.struktur.create') }}" class="nav-link small py-1 {{ request()->routeIs('admin.struktur.create') ? 'active' : '' }}"><i class="bi bi-person-plus"></i> Tambah Pegawai</a></li>
                            
                            <li><hr class="my-2" style="border-color:rgba(255,255,255,0.08);"></li>

                            <!-- Menu Visi Misi (FITUR BARU) -->
                            <li>
                                <div class="text-white-50 small fw-semibold mb-1" style="font-size:0.7rem;letter-spacing:1px;padding-left:1.5rem;">
                                    <i class="bi bi-bullseye me-1"></i> VISI & MISI
                                </div>
                            </li>
                            <li><a href="{{ route('admin.visimisi.index') }}" class="nav-link small py-1 {{ request()->routeIs('admin.visimisi.index') ? 'active' : '' }}"><i class="bi bi-card-text"></i> Data Visi Misi</a></li>
                            <li><a href="{{ route('admin.visimisi.create') }}" class="nav-link small py-1 {{ request()->routeIs('admin.visimisi.create') ? 'active' : '' }}"><i class="bi bi-plus-circle"></i> Tambah Visi Misi</a></li>
                            
                            <li><hr class="my-2" style="border-color:rgba(255,255,255,0.08);"></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-md-9 col-lg-10 p-4 main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-diamond-fill me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.js"></script>

<script>
    // Auto close alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) { 
            return new bootstrap.Tooltip(tooltipTriggerEl) 
        });
        
        // Auto close alerts
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Initialize Summernote for textareas with class 'summernote'
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    // Handle image upload here if needed
                }
            }
        });
    });
    
    // Function to confirm delete
    function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
        return confirm(message);
    }
    
    // Function to preview image before upload
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(previewId).attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Drag and drop for file upload
    function setupDragAndDrop(dropzoneId, inputId, previewId) {
        const dropzone = document.getElementById(dropzoneId);
        if (!dropzone) return;
        
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });
        
        dropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
        });
        
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            const input = document.getElementById(inputId);
            input.files = e.dataTransfer.files;
            previewImage(input, previewId);
        });
        // Auto refresh notifikasi setiap 30 detik
                function loadNotifications() {
                    fetch('{{ route("admin.laporan.notifikasi") }}')
                        .then(response => response.json())
                        .then(data => {
                            // Update badge
                            const badge = document.getElementById('notifBadge');
                            if (data.total_belum_dibaca > 0) {
                                badge.textContent = data.total_belum_dibaca > 99 ? '99+' : data.total_belum_dibaca;
                                badge.style.display = 'block';
                            } else {
                                badge.style.display = 'none';
                            }
                            
                            // Update dropdown content
                            const dropdown = document.getElementById('notifDropdown');
                            const loading = document.getElementById('notifLoading');
                            const empty = document.getElementById('notifEmpty');
                            
                            if (data.laporan_baru.length > 0) {
                                // Remove existing items (keep header, loading, empty, footer)
                                const items = dropdown.querySelectorAll('.notif-item');
                                items.forEach(item => item.remove());
                                
                                // Add new items
                                data.laporan_baru.forEach(laporan => {
                                    const item = document.createElement('li');
                                    item.className = 'notif-item';
                                    item.innerHTML = `
                                        <a class="dropdown-item" href="{{ url('admin/laporan') }}/${laporan.id}">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;background:#FFF3CD;">
                                                    <i class="bi bi-file-text" style="color:#F5A623;"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold small">${laporan.judul_laporan}</div>
                                                    <div class="small text-muted">Dari: ${laporan.nama_pelapor}</div>
                                                    <small class="text-muted">${new Date(laporan.created_at).toLocaleString('id-ID')}</small>
                                                </div>
                                            </div>
                                        </a>
                                    `;
                                    dropdown.insertBefore(item, document.getElementById('notifEmpty'));
                                });
                                loading.style.display = 'none';
                                empty.style.display = 'none';
                            } else {
                                loading.style.display = 'none';
                                empty.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Error loading notifications:', error);
                        });
                }

// Load notifications on page load
document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();
    // Refresh every 30 seconds
    setInterval(loadNotifications, 30000);
});
    }
</script>

@stack('scripts')
</body>
</html>
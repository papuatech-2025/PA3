@extends('layouts.app')

@section('title', 'Statistik Masyarakat')

@section('content')
@php
    // Melakukan perhitungan di atas agar atribut style di bawah tetap rapi
    $percLaki = $total > 0 ? ($totalLaki / $total) * 100 : 0;
    $percPerempuan = $total > 0 ? ($totalPerempuan / $total) * 100 : 0;
    
    $totalSemua = $total + $totalArsip;
    $percenAktifTotal = $totalSemua > 0 ? ($total / $totalSemua) * 100 : 0;
@endphp

<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold" style="color: #1a237e;">Insight & Analitik</h2>
        <p class="text-muted small">Ringkasan data demografi masyarakat secara real-time.</p>
    </div>

    <!-- Main Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-people-fill text-primary fs-4"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1">{{ number_format($total) }}</h3>
                    <p class="text-muted small fw-bold text-uppercase mb-0">Total Masyarakat Aktif</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-primary border-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-1 text-primary">{{ number_format($totalLaki) }}</h3>
                    <p class="text-muted small fw-bold text-uppercase mb-2">Laki-laki</p>
                    <div class="progress" style="height: 6px;">
                        <!-- Fix: Menggunakan variable PHP yang sudah dihitung -->
                        <div class="progress-bar" role="progressbar" style="width: {{ $percLaki }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-start border-danger border-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-1 text-danger">{{ number_format($totalPerempuan) }}</h3>
                    <p class="text-muted small fw-bold text-uppercase mb-2">Perempuan</p>
                    <div class="progress" style="height: 6px;">
                        <!-- Fix: Menggunakan variable PHP yang sudah dihitung -->
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percPerempuan }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-dark text-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <i class="bi bi-archive fs-4 text-warning"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ number_format($totalArsip) }}</h3>
                    <p class="text-white-50 small fw-bold text-uppercase mb-0">Data Diarsipkan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Statistik Desa -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="fw-bold mb-0">Distribusi per Wilayah</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Desa/Kelurahan</th>
                                    <th class="text-center">Jiwa</th>
                                    <th>Rasio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perDesa as $desa)
                                @php
                                    $percDesa = ($total > 0) ? ($desa->total / $total) * 100 : 0;
                                @endphp
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $desa->desa_kelurahan }}</td>
                                    <td class="text-center">{{ $desa->total }}</td>
                                    <td style="width: 200px;">
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100 me-2" style="height: 8px;">
                                                <!-- Fix: Menggunakan variable PHP agar validator CSS tidak error -->
                                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percDesa }}%"></div>
                                            </div>
                                            <span class="small text-muted">{{ number_format($percDesa, 1) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Card -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-2">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Informasi Sistem</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent text-white border-white border-opacity-10 px-0 d-flex justify-content-between">
                            <span>Total Desa Terdata</span>
                            <span class="fw-bold">{{ $totalDesa }} Desa</span>
                        </li>
                        <li class="list-group-item bg-transparent text-white border-white border-opacity-10 px-0 d-flex justify-content-between">
                            <span>Rasio Data Aktif</span>
                            <span class="fw-bold text-warning">{{ number_format($percenAktifTotal, 1) }}%</span>
                        </li>
                    </ul>
                    <div class="mt-4 p-3 bg-white bg-opacity-10 rounded-3 small">
                        <i class="bi bi-info-circle me-2"></i> Statistik ini diperbarui secara otomatis berdasarkan input data terbaru.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
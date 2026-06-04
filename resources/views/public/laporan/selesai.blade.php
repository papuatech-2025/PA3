@extends('layouts.appi')

@section('title', 'Laporan Berhasil Dikirim')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3">
                            <i class="bi bi-check-circle-fill text-success fs-1"></i>
                        </div>
                    </div>
                    
                    <h3 class="mb-2">Laporan Berhasil Dikirim!</h3>
                    <p class="text-muted mb-4">Terima kasih atas laporan yang Anda sampaikan</p>
                    
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <p class="text-muted mb-1">Kode Laporan Anda:</p>
                        <code class="fs-4 fw-bold" style="color: #1a2e4a;">{{ $laporan->kode_laporan }}</code>
                        <p class="text-muted mt-2 small mb-0">Simpan kode ini untuk melacak status laporan</p>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-clock-history me-2"></i>
                        Tim kami akan segera memproses laporan Anda. Status laporan dapat dilihat melalui kode di atas.
                    </div>
                    
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ url('/') }}" class="btn btn-primary px-4">
                            <i class="bi bi-house me-2"></i>Kembali ke Beranda
                        </a>
                        <a href="{{ route('laporan.create') }}" class="btn btn-outline-primary px-4">
                            <i class="bi bi-plus-circle me-2"></i>Buat Laporan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/selesai.css') }}">
@endpush
@endsection
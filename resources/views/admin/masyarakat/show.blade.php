@extends('layouts.app')

@section('title', 'Detail Data Masyarakat')

@section('content')

<style>
    .detail-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 16px rgba(0,0,0,.05);
        overflow: hidden;
    }
    .card-header-custom {
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, var(--info) 0%, #0c5460 100%);
        border-bottom: none;
    }
    .card-header-custom h3 {
        color: var(--white);
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-row {
        display: flex;
        padding: 0.85rem 0;
        border-bottom: 1px solid var(--border);
    }
    .info-label {
        width: 160px;
        font-weight: 600;
        color: var(--navy);
        font-size: 0.85rem;
    }
    .info-value {
        flex: 1;
        color: var(--ink);
        font-size: 0.85rem;
    }
    .info-section {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
    }
    .info-section:last-child {
        border-bottom: none;
    }
    .section-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--info);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="detail-card">
                <div class="card-header-custom">
                    <h3>
                        <i class="bi bi-person-circle"></i>
                        Detail Data Masyarakat
                    </h3>
                </div>

                <!-- Data Pribadi -->
                <div class="info-section">
                    <div class="section-title">
                        <i class="bi bi-person-badge"></i>
                        Data Pribadi
                    </div>
                    <div class="info-row">
                        <div class="info-label">NIK</div>
                        <div class="info-value"><code>{{ $data->nik }}</code></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value">{{ $data->nama_lengkap }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tempat, Tanggal Lahir</div>
                        <div class="info-value">{{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d F Y') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Jenis Kelamin</div>
                        <div class="info-value">
                            @if($data->jenis_kelamin == 'Laki-laki')
                                <i class="bi bi-gender-male text-primary"></i> Laki-laki
                            @else
                                <i class="bi bi-gender-female text-danger"></i> Perempuan
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Alamat & Kontak -->
                <div class="info-section">
                    <div class="section-title">
                        <i class="bi bi-geo-alt"></i>
                        Alamat & Kontak
                    </div>
                    <div class="info-row">
                        <div class="info-label">Alamat Lengkap</div>
                        <div class="info-value">{{ $data->alamat ?: '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Desa/Kelurahan</div>
                        <div class="info-value">{{ $data->desa_kelurahan ?: '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">No. Telepon</div>
                        <div class="info-value">{{ $data->no_telepon ?: '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Keterangan</div>
                        <div class="info-value">{{ $data->keterangan ?: '-' }}</div>
                    </div>
                </div>

                <!-- Informasi Sistem -->
                <div class="info-section">
                    <div class="section-title">
                        <i class="bi bi-info-circle"></i>
                        Informasi Sistem
                    </div>
                    <div class="info-row">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            @if($data->is_archived)
                                <span class="badge bg-warning"><i class="bi bi-archive"></i> Diarsipkan</span>
                            @else
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Aktif</span>
                            @endif
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tanggal Dibuat</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y H:i:s') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Terakhir Diupdate</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y H:i:s') }}</div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-white py-3 px-4 d-flex justify-content-between">
                    <div>
                        @if(!$data->is_archived)
                            <form action="{{ route('admin.masyarakat.moveToArchive', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Pindahkan ke arsip?')">
                                    <i class="bi bi-archive"></i> Arsipkan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.masyarakat.restoreFromArchive', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Pulihkan dari arsip?')">
                                    <i class="bi bi-arrow-repeat"></i> Pulihkan
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.masyarakat.edit', $data->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('admin.masyarakat.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
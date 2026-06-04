@extends('layouts.app')

@section('title', 'Detail Laporan - ' . $laporan->kode_laporan)

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.laporan.index') }}">Laporan</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
            <h2 class="fw-bold" style="color: #1a237e;">Laporan {{ $laporan->kode_laporan }}</h2>
        </div>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary rounded-3 px-4 shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row g-4">
        <!-- Kolom Konten Utama -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0">Isi Pengaduan</h6>
                    <span class="badge bg-primary px-3 py-2 rounded-pill">{{ $laporan->jenis_laporan }}</span>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="text-muted small fw-bold text-uppercase d-block mb-1">Judul Laporan</label>
                        <h4 class="fw-bold text-dark">{{ $laporan->judul_laporan }}</h4>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted small fw-bold text-uppercase d-block mb-1">Kronologi / Isi Laporan</label>
                        <div class="p-3 bg-light rounded-3" style="line-height: 1.6; white-space: pre-line;">
                            {{ $laporan->isi_laporan }}
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Lokasi Kejadian</label>
                            <p class="fw-medium"><i class="bi bi-geo-alt me-2 text-danger"></i>{{ $laporan->lokasi_kejadian ?: '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Tanggal Kejadian</label>
                            <p class="fw-medium"><i class="bi bi-calendar-event me-2 text-primary"></i>{{ $laporan->tanggal_kejadian ? \Carbon\Carbon::parse($laporan->tanggal_kejadian)->translatedFormat('d F Y') : '-' }}</p>
                        </div>
                    </div>

                    @if($laporan->foto_pendukung)
                    <div class="mt-4">
                        <label class="text-muted small fw-bold text-uppercase d-block mb-2">Bukti Foto</label>
                        <a href="{{ Storage::url($laporan->foto_pendukung) }}" target="_blank">
                            <img src="{{ Storage::url($laporan->foto_pendukung) }}" alt="Bukti" class="img-fluid rounded-4 shadow-sm border" style="max-height: 400px; object-fit: contain;">
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Card Info Pelapor -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 px-4 border-bottom">
                    <h6 class="fw-bold mb-0">Identitas Pelapor</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-4 mb-3 mb-sm-0 text-center border-end d-flex flex-column align-items-center justify-content-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-person-fill text-primary display-6"></i>
                            </div>
                            <h5 class="fw-bold mb-0">{{ $laporan->nama_pelapor }}</h5>
                            <span class="text-muted small">Pelapor</span>
                        </div>
                        <div class="col-sm-8 ps-sm-4">
                            <table class="table table-borderless align-middle mb-0">
                                <tr>
                                    <td class="text-muted small fw-bold" width="150">EMAIL</td>
                                    <td class="fw-medium">: {{ $laporan->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">NO. TELEPON</td>
                                    <td class="fw-medium">: {{ $laporan->no_telepon ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-bold">TGL KIRIM</td>
                                    <td class="fw-medium">: {{ $laporan->created_at->translatedFormat('d F Y, H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Aksi Status -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 20px; z-index: 10;">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-dark text-white py-3 px-4">
                        <h6 class="fw-bold mb-0">Manajemen Status</h6>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST">
                            @csrf @method('PUT')
                            
                            <div class="mb-4">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-2">Status Saat Ini</label>
                                @php
                                    $statusClass = match($laporan->status) {
                                        'baru' => 'bg-danger text-white',
                                        'diproses' => 'bg-warning text-dark',
                                        'selesai' => 'bg-success text-white',
                                        'ditolak' => 'bg-dark text-white',
                                        default => 'bg-secondary text-white',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} px-4 py-2 rounded-pill text-uppercase w-100 fs-6 shadow-sm">
                                    {{ $laporan->status }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Ubah Ke Status</label>
                                <select name="status" class="form-select border-0 bg-light py-2" required>
                                    <option value="baru" {{ $laporan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ $laporan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Catatan Admin / Tanggapan</label>
                                <textarea name="catatan_admin" class="form-control border-0 bg-light" rows="5" placeholder="Tulis tanggapan atau alasan status di sini...">{{ $laporan->catatan_admin }}</textarea>
                                <small class="text-muted mt-2 d-block">Catatan ini dapat membantu pelacakan internal laporan.</small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 shadow fw-bold">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tombol Hapus (Secondary Action) -->
                <button type="button" class="btn btn-link text-danger w-100 text-decoration-none small" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $laporan->id }}">
                    <i class="bi bi-trash me-1"></i>Hapus Laporan Ini
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal{{ $laporan->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-body p-4 text-center">
                <i class="bi bi-exclamation-triangle text-danger display-4 mb-3"></i>
                <h5 class="fw-bold">Konfirmasi Hapus</h5>
                <p class="text-muted small">Tindakan ini tidak dapat dibatalkan. Hapus laporan {{ $laporan->kode_laporan }}?</p>
                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
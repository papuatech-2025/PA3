<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'kode_laporan',
        'nama_pelapor',
        'email',
        'no_telepon',
        'jenis_laporan',
        'judul_laporan',
        'isi_laporan',
        'lokasi_kejadian',
        'tanggal_kejadian',
        'foto_pendukung',
        'status',
        'catatan_admin',
        'dibaca_pada'
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'dibaca_pada' => 'datetime'
    ];

    // Auto generate kode laporan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($laporan) {
            $year = date('Y');
            $month = date('m');
            $last = static::whereYear('created_at', $year)
                         ->whereMonth('created_at', $month)
                         ->count();
            $laporan->kode_laporan = "LAP-{$year}{$month}-" . str_pad($last + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    // Scope untuk laporan belum dibaca
    public function scopeBelumDibaca($query)
    {
        return $query->whereNull('dibaca_pada');
    }

    // Scope berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessor untuk badge status
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'baru' => 'badge bg-danger',
            'diproses' => 'badge bg-warning text-dark',
            'selesai' => 'badge bg-success',
            'ditolak' => 'badge bg-secondary'
        ];

        $labels = [
            'baru' => 'Baru',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        return '<span class="' . $badges[$this->status] . '">' . $labels[$this->status] . '</span>';
    }

    // Mark as read
    public function markAsRead()
    {
        if (is_null($this->dibaca_pada)) {
            $this->update(['dibaca_pada' => now()]);
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';
    
    protected $fillable = [
        'nama_program',
        'slug',
        'kategori',
        'deskripsi',
        'gambar',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'status' => 'boolean',
    ];

    // Scope for active programs
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for ongoing programs
    public function scopeOngoing($query)
    {
        return $query->where('status', true)
                     ->where('tanggal_mulai', '<=', now())
                     ->where('tanggal_selesai', '>=', now());
    }

    // Accessor for status badge
    public function getStatusBadgeAttribute()
    {
        if ($this->status) {
            return '<span class="badge-publish">Aktif</span>';
        }
        return '<span class="badge-draft">Nonaktif</span>';
    }
}
<?php
// app/Models/Wisata.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';
    
    protected $fillable = [
        'nama',
        'slug',
        'kategori',
        'lokasi',
        'deskripsi',
        'jam_operasional',
        'harga',
        'gambar',
        'galeri',
        'rating',
        'total_review',
        'fasilitas',
        'informasi_tambahan',
        'status'
    ];

    protected $casts = [
        'galeri' => 'array',
        'fasilitas' => 'array',
        'informasi_tambahan' => 'array',
        'status' => 'boolean'
    ];

    // Accessor untuk format harga
    public function getHargaFormattedAttribute()
    {
        return $this->harga ? 'Rp ' . number_format($this->harga, 0, ',', '.') : 'Gratis';
    }

    // Accessor untuk rating display
    public function getRatingDisplayAttribute()
    {
        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;
        
        return [
            'full' => $fullStars,
            'half' => $halfStar,
            'empty' => $emptyStars
        ];
    }

    // Scope untuk wisata aktif
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    // Scope berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
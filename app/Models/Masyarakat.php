<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table = 'masyarakat';
    
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'desa_kelurahan',
        'no_telepon',
        'keterangan',
        'is_archived'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'is_archived' => 'boolean',
    ];

    /**
     * Scope untuk data aktif (belum diarsipkan)
     */
    public function scopeActive($query)
    {
        return $query->where('is_archived', false);
    }

    /**
     * Scope untuk data yang diarsipkan
     */
    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nik', 'LIKE', "%{$search}%")
                     ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
                     ->orWhere('desa_kelurahan', 'LIKE', "%{$search}%");
    }
}
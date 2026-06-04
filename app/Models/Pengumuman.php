<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'pengumuman';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'id_admin',
        'judul',
        'isi',
        'tanggal',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'tanggal'   => 'datetime',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    /**
     * Relasi ke tabel users (admin)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    /**
     * Scope pengumuman terbaru
     */
    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}
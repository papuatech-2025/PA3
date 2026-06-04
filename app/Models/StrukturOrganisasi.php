<?php
// app/Models/StrukturOrganisasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasis';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'urutan' => 'integer',
        'aktif' => 'boolean'
    ];

    // Scope untuk yang aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    // Scope untuk urutan
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
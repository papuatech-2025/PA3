<?php
// app/Models/Berita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'penulis',
        'dibaca',
        'status'
    ];

    protected $casts = [
        'dibaca' => 'integer',
        'status' => 'string'
    ];

    // Scope untuk berita yang dipublish
    public function scopePublish($query)
    {
        return $query->where('status', 'publish');
    }

    // Increment pembaca
    public function incrementDibaca()
    {
        $this->increment('dibaca');
    }
}
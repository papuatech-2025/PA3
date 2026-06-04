<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    
    protected $fillable = [
        'id_admin',
        'nama_layanan',
        'deskripsi',
        'icon',
        'gambar',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function layanan()
        {
            return $this->hasMany(Layanan::class, 'id_admin');
        }
}
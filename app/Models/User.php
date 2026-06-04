<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Kolom yang boleh diisi (Mass Assignment)
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'verify_key',
        'active',
        'email_verified_at', // 💡 Tambahkan ini agar bisa diupdate saat verifikasi email
    ];

    /**
     * Kolom yang disembunyikan saat tampil dalam array/JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'active' => 'boolean', 
    ];

    /**
     * 💡 Helper: Cek apakah user adalah Admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * 💡 Helper: Cek apakah user adalah User Biasa
     */
    public function isUser()
    {
        return $this->role === 'user';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misis';
    protected $primaryKey = 'id_visimisi'; // Wajib karena bukan 'id'

    protected $fillable = ['id_admin', 'isi'];

    // Relasi ke User/Admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
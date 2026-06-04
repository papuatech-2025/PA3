<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiPublicController extends Controller
{
    public function index()
    {
        // Ambil data visi misi yang paling terbaru (menggunakan primary key kustom anda)
        $data = VisiMisi::latest('id_visimisi')->first();

        return view('public.visimisi', compact('data'));
    }
}
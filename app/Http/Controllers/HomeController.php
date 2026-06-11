<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\StrukturOrganisasi;
use App\Models\Program;
use App\Models\Layanan;
use App\Models\VisiMisi; // 1. Pastikan Model VisiMisi di-import
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 2. Ambil data Visi Misi (biasanya hanya satu record pertama)
        $visimisi = VisiMisi::first(); 

        // Ambil semua data layanan
        $layanan = Layanan::all();
        
        // Ambil 3 berita terbaru yang dipublish
        $beritaTerbaru = Berita::where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // Ambil struktur organisasi untuk tim (4 orang)
        $struktur = StrukturOrganisasi::where('aktif', 1)
            ->orderBy('urutan', 'asc')
            ->limit(4)
            ->get();
        
        // Ambil program terbaru (opsional)
        $programTerbaru = Program::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // 3. Tambahkan 'visimisi' ke dalam compact
        return view('branda', compact('beritaTerbaru', 'struktur', 'programTerbaru', 'layanan', 'visimisi'));
    }
}
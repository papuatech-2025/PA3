<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan halaman kontak
     */
    public function index()
    {
        // Pastikan path view sesuai dengan lokasi file: resources/views/public/Kontak/Kontakkami.blade.php
        return view('public.Kontak.Kontakkami');
    }

    /**
     * Menangani pengiriman form kontak
     */
    public function send(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Logika pengiriman email atau simpan ke database bisa ditambahkan di sini
        // Untuk sementara kita return kembali dengan pesan sukses
        
        return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
    }
}
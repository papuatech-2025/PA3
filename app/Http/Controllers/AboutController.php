<?php
// app/Http/Controllers/AboutController.php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        
        if (!$about) {
            // Data about belum ada
            return view('public.about.index', compact('about'));
        }
        
        // Parse misi jika perlu (misal: dipisah dengan newline atau bullet points)
        $misiList = explode("\n", $about->misi);
        
        return view('public.about.index', compact('about', 'misiList'));
    }

    /**
     * Display the specified resource (optional, bisa untuk detail jika diperlukan)
     */
    public function show($id)
    {
        $about = About::findOrFail($id);
        return view('public.about.show', compact('about'));
    }
}
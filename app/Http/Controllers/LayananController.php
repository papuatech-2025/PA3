<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    // Constructor dengan middleware auth (perbaikan)
    public function __construct()
    {
        // Gunakan $this->middleware langsung di konstruktor atau di route
    }
    
    // Public methods
    public function publicIndex()
    {
        $layanan = Layanan::active()->orderBy('created_at', 'desc')->get();
        return view('public.layanan.index', compact('layanan'));
    }
    
    public function publicShow(int $id)
    {
        $layanan = Layanan::active()->findOrFail($id);
        return view('public.layanan.show', compact('layanan'));
    }
    
    // Admin methods
    public function index()
    {
        $layanan = Layanan::with('admin')->orderBy('created_at', 'desc')->get();
        return view('admin.layanan.index', compact('layanan'));
    }
    
    public function create()
    {
        return view('admin.layanan.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->all();
        $data['id_admin'] = Auth::id();
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/layanan'), $filename);
            $data['gambar'] = 'uploads/layanan/' . $filename;
        }
        
        Layanan::create($data);
        
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }
    
    public function edit(int $id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }
    
    public function update(Request $request, int $id)
    {
        $layanan = Layanan::findOrFail($id);
        
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        // Handle hapus gambar dari checkbox
        if ($request->has('hapus_gambar') && $request->hapus_gambar == '1') {
            if ($layanan->gambar && file_exists(public_path($layanan->gambar))) {
                unlink(public_path($layanan->gambar));
            }
            $data['gambar'] = null;
        }
        
        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($layanan->gambar && file_exists(public_path($layanan->gambar))) {
                unlink(public_path($layanan->gambar));
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/layanan'), $filename);
            $data['gambar'] = 'uploads/layanan/' . $filename;
        }
        
        $layanan->update($data);
        
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diupdate');
    }
    
    public function destroy(int $id)
    {
        $layanan = Layanan::findOrFail($id);
        
        // Hapus gambar
        if ($layanan->gambar && file_exists(public_path($layanan->gambar))) {
            unlink(public_path($layanan->gambar));
        }
        
        $layanan->delete();
        
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
    
    public function toggleStatus(int $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->is_active = !$layanan->is_active;
        $layanan->save();
        
        return response()->json(['success' => true, 'is_active' => $layanan->is_active]);
    }
    
    // Method tambahan: Menghapus gambar saja tanpa menghapus layanan
    public function deleteImage(int $id)
    {
        $layanan = Layanan::findOrFail($id);
        
        if ($layanan->gambar && file_exists(public_path($layanan->gambar))) {
            unlink(public_path($layanan->gambar));
            $layanan->gambar = null;
            $layanan->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil dihapus'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Gambar tidak ditemukan'
        ], 404);
    }
    
    // Method tambahan: Duplikat layanan
    public function duplicate(int $id)
    {
        $layanan = Layanan::findOrFail($id);
        
        $newLayanan = $layanan->replicate();
        $newLayanan->nama_layanan = $layanan->nama_layanan . ' (Copy)';
        $newLayanan->id_admin = Auth::id();
        $newLayanan->created_at = now();
        $newLayanan->updated_at = now();
        $newLayanan->save();
        
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diduplikasi');
    }
    
    // Method tambahan: Bulk delete (hapus massal)
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return redirect()->route('admin.layanan.index')
                ->with('error', 'Tidak ada data yang dipilih');
        }
        
        // Hapus gambar-gambar yang terkait
        $layanans = Layanan::whereIn('id_layanan', $ids)->get();
        foreach ($layanans as $layanan) {
            if ($layanan->gambar && file_exists(public_path($layanan->gambar))) {
                unlink(public_path($layanan->gambar));
            }
        }
        
        Layanan::whereIn('id_layanan', $ids)->delete();
        
        return redirect()->route('admin.layanan.index')
            ->with('success', count($ids) . ' layanan berhasil dihapus');
    }
    
    // Method tambahan: Export ke JSON
    public function export()
    {
        $layanan = Layanan::with('admin')->get();
        return response()->json([
            'data' => $layanan,
            'total' => $layanan->count(),
            'exported_at' => now()
        ]);
    }
}
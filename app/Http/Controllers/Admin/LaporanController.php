<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan jenis laporan
        if ($request->filled('jenis_laporan')) {
            $query->where('jenis_laporan', $request->jenis_laporan);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_pelapor', 'like', '%' . $request->search . '%')
                  ->orWhere('judul_laporan', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_laporan', 'like', '%' . $request->search . '%');
            });
        }

        $laporans = $query->latest()->paginate(15);
        
        // Statistik
        $statistik = [
            'total' => Laporan::count(),
            'baru' => Laporan::where('status', 'baru')->count(),
            'diproses' => Laporan::where('status', 'diproses')->count(),
            'selesai' => Laporan::where('status', 'selesai')->count(),
            'belum_dibaca' => Laporan::belumDibaca()->count()
        ];

        return view('admin.laporan.index', compact('laporans', 'statistik'));
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        
        // Mark as read
        if ($laporan->status == 'baru') {
            $laporan->markAsRead();
        }
        
        return view('admin.laporan.show', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string'
        ]);
        
        $laporan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);
        
        return redirect()->route('admin.laporan.index')
            ->with('success', 'Status laporan berhasil diupdate');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        
        if ($laporan->foto_pendukung) {
            Storage::disk('public')->delete($laporan->foto_pendukung);
        }
        
        $laporan->delete();
        
        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }

    // API untuk notifikasi
    public function notifikasi()
    {
        $belumDibaca = Laporan::belumDibaca()->count();
        $laporanBaru = Laporan::where('status', 'baru')->latest()->take(5)->get();
        
        return response()->json([
            'total_belum_dibaca' => $belumDibaca,
            'laporan_baru' => $laporanBaru
        ]);
    }
}
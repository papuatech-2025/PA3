<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\MasyarakatExport;
use Maatwebsite\Excel\Facades\Excel;

class MasyarakatController extends Controller
{
    /**
     * Menampilkan semua data masyarakat (aktif) dengan pagination
     */
    public function index(Request $request)
    {
        $query = Masyarakat::active();

        // Fitur pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'LIKE', "%{$search}%")
                  ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('desa_kelurahan', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan desa/kelurahan
        if ($request->filled('desa')) {
            $query->where('desa_kelurahan', $request->desa);
        }

        // Filter berdasarkan jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Pagination: 10 data per halaman
        $data = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Untuk dropdown filter
        $desaList = Masyarakat::select('desa_kelurahan')->distinct()->pluck('desa_kelurahan');

        return view('admin.masyarakat.index', compact('data', 'desaList'));
    }

    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        return view('admin.masyarakat.create');
    }

    /**
     * Menyimpan data baru
     * REDIRECT KE DASHBOARD
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:masyarakat,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'desa_kelurahan' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:15',
            'keterangan' => 'nullable|string',
        ]);

        Masyarakat::create($request->all());

        // ✅ UPDATE: Redirect ke dashboard agar angka total masyarakat langsung terupdate
        return redirect()->route('admin.dashboard')
            ->with('success', 'Data masyarakat berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail data
     */
    public function show($id)
    {
        $data = Masyarakat::findOrFail($id);
        return view('admin.masyarakat.show', compact('data'));
    }

    /**
     * Menampilkan form edit data
     */
    public function edit($id)
    {
        $data = Masyarakat::findOrFail($id);
        return view('admin.masyarakat.edit', compact('data'));
    }

    /**
     * Mengupdate data
     * REDIRECT KE DASHBOARD
     */
    public function update(Request $request, $id)
    {
        $data = Masyarakat::findOrFail($id);

        $request->validate([
            'nik' => 'required|string|size:16|unique:masyarakat,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'desa_kelurahan' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:15',
            'keterangan' => 'nullable|string',
        ]);

        $data->update($request->all());

        // ✅ UPDATE: Redirect ke dashboard
        return redirect()->route('admin.dashboard')
            ->with('success', 'Data masyarakat berhasil diupdate!');
    }

    /**
     * Menghapus data (soft delete)
     * REDIRECT KE DASHBOARD
     */
    public function destroy($id)
    {
        $data = Masyarakat::findOrFail($id);
        $data->delete();

        // ✅ UPDATE: Redirect ke dashboard
        return redirect()->route('admin.dashboard')
            ->with('success', 'Data masyarakat berhasil dihapus!');
    }

    /**
     * Fitur pencarian dan filter (redirect ke index)
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Menampilkan data arsip (data lama) dengan pagination
     */
    public function archive()
    {
        // Pagination: 10 data per halaman untuk arsip
        $data = Masyarakat::archived()->orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.masyarakat.archive', compact('data'));
    }

    /**
     * Memindahkan data ke arsip
     * REDIRECT KE DASHBOARD
     */
    public function moveToArchive($id)
    {
        $data = Masyarakat::findOrFail($id);
        $data->update(['is_archived' => true]);

        // ✅ UPDATE: Redirect ke dashboard
        return redirect()->route('admin.dashboard')
            ->with('success', 'Data berhasil dipindahkan ke arsip!');
    }

    /**
     * Mengembalikan data dari arsip
     * REDIRECT KE DASHBOARD
     */
    public function restoreFromArchive($id)
    {
        $data = Masyarakat::findOrFail($id);
        $data->update(['is_archived' => false]);

        // ✅ UPDATE: Redirect ke dashboard
        return redirect()->route('admin.dashboard')
            ->with('success', 'Data berhasil dikembalikan dari arsip!');
    }

    /**
     * Laporan sederhana (statistik)
     */
    public function reports()
    {
        $total = Masyarakat::active()->count();
        $totalLaki = Masyarakat::active()->where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Masyarakat::active()->where('jenis_kelamin', 'Perempuan')->count();
        $totalDesa = Masyarakat::active()->distinct('desa_kelurahan')->count('desa_kelurahan');
        $totalArsip = Masyarakat::archived()->count();

        $perDesa = Masyarakat::active()
            ->select('desa_kelurahan', DB::raw('count(*) as total'))
            ->groupBy('desa_kelurahan')
            ->get();

        return view('admin.masyarakat.reports', compact(
            'total', 'totalLaki', 'totalPerempuan', 'totalDesa', 'totalArsip', 'perDesa'
        ));
    }

    /**
     * Export data ke Excel
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel(Request $request)
    {
        // Ambil parameter filter dari request
        $status = $request->get('status', 'active'); // active, archived, all
        $desa = $request->get('desa');
        $jenisKelamin = $request->get('jenis_kelamin');
        
        // Tentukan apakah akan mengexport data arsip atau tidak
        $isArchived = false;
        if ($status == 'archived') {
            $isArchived = true;
        } elseif ($status == 'all') {
            $isArchived = null; // null berarti semua data (aktif + arsip)
        }
        
        // Buat nama file dengan timestamp
        $fileName = 'data_masyarakat_' . date('Y-m-d_His') . '.xlsx';
        
        // Export ke Excel
        return Excel::download(
            new MasyarakatExport($isArchived, $desa, $jenisKelamin), 
            $fileName
        );
    }

    /**
     * Export data ke PDF (opsional)
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportPdf(Request $request)
    {
        // Ambil parameter filter dari request
        $status = $request->get('status', 'active');
        $desa = $request->get('desa');
        $jenisKelamin = $request->get('jenis_kelamin');
        
        // Tentukan query berdasarkan filter
        $query = Masyarakat::query();
        
        if ($status == 'active') {
            $query->where('is_archived', false);
        } elseif ($status == 'archived') {
            $query->where('is_archived', true);
        }
        // jika 'all', tidak ada filter status
        
        if ($desa) {
            $query->where('desa_kelurahan', $desa);
        }
        
        if ($jenisKelamin) {
            $query->where('jenis_kelamin', $jenisKelamin);
        }
        
        $data = $query->orderBy('created_at', 'desc')->get();
        
        // Load view untuk PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.masyarakat.pdf', compact('data'));
        
        // Download PDF
        return $pdf->download('data_masyarakat_' . date('Y-m-d_His') . '.pdf');
    }
}
<?php

namespace App\Exports;

use App\Models\Masyarakat;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MasyarakatExport implements 
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize,
    WithColumnWidths
{
    protected $isArchived;
    protected $desa;
    protected $jenisKelamin;
    protected $no = 0;

    public function __construct($isArchived = false, $desa = null, $jenisKelamin = null)
    {
        $this->isArchived    = $isArchived;
        $this->desa          = $desa;
        $this->jenisKelamin  = $jenisKelamin;
    }

    public function query()
    {
        return Masyarakat::query()
            ->when($this->isArchived === 'true' || $this->isArchived === true, function ($q) {
                $q->where('is_archived', true);
            }, function ($q) {
                $q->where('is_archived', false);
            })
            ->when($this->desa, fn ($q) => $q->where('desa_kelurahan', $this->desa))
            ->when($this->jenisKelamin, fn ($q) => $q->where('jenis_kelamin', $this->jenisKelamin))
            ->latest();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIK',
            'Nama Lengkap',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Desa/Kelurahan',
            'No. Telepon',
            'Keterangan',
            'Status',
            'Tanggal Dibuat',
            'Tanggal Diupdate',
        ];
    }

    public function map($masyarakat): array
    {
        $this->no++;

        return [
            $this->no,
            $masyarakat->nik,
            $masyarakat->nama_lengkap,
            $masyarakat->tempat_lahir,
            $this->formatTanggal($masyarakat->tanggal_lahir),
            $masyarakat->jenis_kelamin,
            $masyarakat->alamat,
            $masyarakat->desa_kelurahan,
            $masyarakat->no_telepon ?? '-',
            $masyarakat->keterangan ?? '-',
            $masyarakat->is_archived ? 'Diarsipkan' : 'Aktif',
            $this->formatTanggalTime($masyarakat->created_at),
            $this->formatTanggalTime($masyarakat->updated_at),
        ];
    }

    private function formatTanggal($tanggal)
    {
        return $tanggal ? Carbon::parse($tanggal)->format('d/m/Y') : '-';
    }

    private function formatTanggalTime($tanggal)
    {
        return $tanggal ? Carbon::parse($tanggal)->format('d/m/Y H:i:s') : '-';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 18,
            'C' => 25,
            'D' => 15,
            'E' => 15,
            'F' => 12,
            'G' => 30,
            'H' => 20,
            'I' => 15,
            'J' => 25,
            'K' => 12,
            'L' => 20,
            'M' => 20,
        ];
    }
}
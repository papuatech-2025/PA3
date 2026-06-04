<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Masyarakat</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Masyarakat</h2>
        <p>Tanggal Export: {{ date('d/m/Y H:i:s') }}</p>
    </div>
    
    <table>
        <thead>
            32<tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Desa/Kelurahan</th>
                <th>No. Telepon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ date('d/m/Y', strtotime($item->tanggal_lahir)) }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->desa_kelurahan }}</td>
                <td>{{ $item->no_telepon ?: '-' }}</td>
                <td>{{ $item->is_archived ? 'Diarsipkan' : 'Aktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total Data: {{ $data->count() }}</p>
    </div>
</body>
</html>
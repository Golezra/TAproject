<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Sampah</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Laporan Sampah</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Pelapor</th>
                <th>Lokasi Sampah</th>
                <th>Jenis Sampah</th>
                <th>Berat (Kg)</th>
                <th>Nominal (Rp)</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                    <td>{{ $item->lokasi_sampah }}</td>
                    <td>{{ ucfirst($item->jenis_sampah) }}</td>
                    <td>{{ $item->berat_sampah }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
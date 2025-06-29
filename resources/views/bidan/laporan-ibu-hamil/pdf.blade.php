<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Ibu Hamil</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Kunjungan Ibu Hamil</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal Kunjungan</th>
                <th>Nama Ibu</th>
                <th>Tensi Badan</th>
                <th>Berat Badan (kg)</th>
                <th>Usia Hamil</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanIbuHamil as $laporan)
            <tr>
                <td>{{ $laporan->tgl_kunjungan }}</td>
                <td>{{ $laporan->ibu->nama_ibu_hamil ?? '-' }}</td>
                <td>{{ $laporan->tensi }}</td>
                <td>{{ $laporan->bb_ibu_hamil }}</td>
                <td>{{ $laporan->usia_hamil }}</td>
                <td>{{ $laporan->kondisi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

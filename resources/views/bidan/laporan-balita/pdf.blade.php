<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Balita</title>
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
    <h2 style="text-align: center;">Laporan Kunjungan Balita</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal Kunjungan</th>
                <th>Nama Anak</th>
                <th>BB</th>
                <th>TB</th>
                <th>LK</th>
                <th>LILA</th>
                <th>Imunisasi</th>
                <th>Tgl Imunisasi</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanBalita as $laporan)
            <tr>
                <td>{{ $laporan->tgl_kunjungan }}</td>
                <td>{{ $laporan->anak->nama_anak ?? '-' }}</td>
                <td>{{ $laporan->bb_anak }}</td>
                <td>{{ $laporan->tb_anak }}</td>
                <td>{{ $laporan->lk_anak }}</td>
                <td>{{ $laporan->lila_anak }}</td>
                <td>{{ $laporan->imunisasi }}</td>
                <td>{{ $laporan->tgl_imunisasi }}</td>
                <td>{{ $laporan->catatan_kesehatan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

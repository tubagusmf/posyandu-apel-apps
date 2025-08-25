<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Penimbangan</title>
    <style>
        body { font-family: sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        .center { text-align: center; }
        .signature { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <h2 class="center">Hasil Penimbangan Balita</h2>
    <br>
    <p><strong>Nama Anak:</strong> {{ $layanan->anak->nama_anak }}</p>
    <p><strong>Nama Ibu:</strong> {{ $layanan->anak->nama_ibu }}</p>
    <p><strong>Tanggal Kunjungan:</strong> {{ $layanan->tgl_kunjungan }}</p>

    <table>
        <tr>
            <th>Berat Badan (kg)</th>
            <th>Tinggi Badan (cm)</th>
            <th>Lingkar Kepala (cm)</th>
            <th>LILA (cm)</th>
            <th>Status Gizi</th>
        </tr>
        <tr>
            <td>{{ $layanan->bb_anak }}</td>
            <td>{{ $layanan->tb_anak }}</td>
            <td>{{ $layanan->lk_anak }}</td>
            <td>{{ $layanan->lila_anak }}</td>
            <td>{{ $layanan->status_gizi ?? '-' }}</td>
        </tr>
    </table>

    <p><strong>Imunisasi:</strong> {{ $layanan->imunisasi }}</p>
    <p><strong>Tanggal Imunisasi:</strong> {{ $layanan->tgl_imunisasi }}</p>
    <p><strong>Catatan Kesehatan:</strong> {{ $layanan->catatan_kesehatan }}</p>

    <br><br>
    <div class="signature">
        <p>Penanggung Jawab</p><br><br><br>
        <p>Kader {{ $layanan->kader->nama_kader }}</p>
    </div>
</body>
</html>

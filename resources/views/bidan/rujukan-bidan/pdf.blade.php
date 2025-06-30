<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Rujukan Posyandu</title>
    <style>
        body { font-family: sans-serif; font-size: 12pt; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { margin: 0 30px; }
        .row { display: flex; justify-content: space-between; }
        .section { margin-bottom: 15px; }
        .signature { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h3>SURAT RUJUKAN POSYANDU</h3>
    </div>

    <div class="content">
        <div class="row">
            <div>
                <p>Kepada Yth.<br>Petugas {{ $bidan->nama_bidan }}</p>
            </div>
            <div>
                <p>No Rujukan: {{ $rujukan->no_rujukan }}</p>
            </div>
        </div>

        <p>Dengan ini kami menghadapkan sasaran berikut ini :</p>

        <div class="section">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $rujukan->ibu->nama_ibu_hamil }}</td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($rujukan->ibu->tgl_lahir)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>Posyandu</td>
                    <td>:</td>
                    <td>Posyandu Apel</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $rujukan->ibu->alamat }}</td>
                </tr>
                <tr>
                    <td>Keluhan/masalah</td>
                    <td>:</td>
                    <td>{{ $rujukan->catatan_kesehatan }}</td>
                </tr>
            </table>
        </div>

        <p>Mohon sekiranya dapat ditindak lanjuti,</p>
        <p>Demikian atas perhatiannya, kami ucapkan terima kasih.</p>

        <div class="signature">
            <p>Penanggung Jawab</p><br><br><br>
            <p>Kader {{ $rujukan->kader->nama_kader }}</p>
        </div>
    </div>
</body>
</html>

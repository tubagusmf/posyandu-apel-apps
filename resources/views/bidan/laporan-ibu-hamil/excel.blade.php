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

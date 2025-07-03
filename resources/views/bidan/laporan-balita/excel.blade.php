<table>
    <thead>
        <tr>
            <th>Tanggal Kunjungan</th>
            <th>Nama Anak</th>
            <th>BB (kg)</th>
            <th>TB (cm)</th>
            <th>LK (cm)</th>
            <th>LILA (cm)</th>
            <th>Status Gizi</th>
            <th>Imunisasi</th>
            <th>Tanggal Imunisasi</th>
            <th>Catatan Kesehatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporanBalita as $laporan)
        <tr>
            <td>{{ $laporan->tgl_kunjungan }}</td>
            <td>{{ $laporan->anak->nama_anak }}</td>
            <td>{{ $laporan->bb_anak }}</td>
            <td>{{ $laporan->tb_anak }}</td>
            <td>{{ $laporan->lk_anak }}</td>
            <td>{{ $laporan->lila_anak }}</td>
            <td>{{ $laporan->status_gizi }}</td>
            <td>{{ $laporan->imunisasi }}</td>
            <td>{{ $laporan->tgl_imunisasi }}</td>
            <td>{{ $laporan->catatan_kesehatan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

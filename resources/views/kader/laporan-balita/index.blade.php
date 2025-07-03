<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <form action="{{ route('kader.laporan-balita') }}" method="GET" class="form-inline">
                    <label for="bulan" class="mr-2">Pilih Bulan:</label>
                    <input type="month" name="bulan" id="bulan" class="form-control mr-2" value="{{ request('bulan') }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('kader.laporan-balita') }}" class="btn btn-secondary ml-2">Reset</a>
                </form>  
                
                @if(request('bulan'))
                    <div class="alert alert-info">
                        Menampilkan laporan untuk bulan <strong>{{ \Carbon\Carbon::parse(request('bulan'))->translatedFormat('F Y') }}</strong>
                    </div>
                @endif
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table
                  id="basic-datatables"
                  class="display table table-striped table-hover"
                >
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
                    @foreach ($laporanBalita as $laporan)
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
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
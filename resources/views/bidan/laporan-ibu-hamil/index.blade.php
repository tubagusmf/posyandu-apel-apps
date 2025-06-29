<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <form action="{{ route('bidan.laporan-ibu-hamil') }}" method="GET" class="form-inline d-flex flex-wrap gap-2">
                    <label for="bulan" class="mr-2">Pilih Bulan:</label>
                    <input type="month" name="bulan" id="bulan" class="form-control mr-2" value="{{ request('bulan') }}">
                    <button type="submit" class="btn btn-primary mr-2">Filter</button>
                    <a href="{{ route('bidan.laporan-ibu-hamil') }}" class="btn btn-secondary">Reset</a>
                </form>
            
                <div class="mt-2 mt-md-0">
                    <a href="{{ route('bidan.laporan-ibu-hamil.export.pdf', ['bulan' => request('bulan')]) }}" class="btn btn-danger">Export PDF</a>
                </div>
            </div>

            @if(request('bulan'))
            <div class="card-body pt-0">
                <div class="alert alert-info">
                    Menampilkan laporan untuk bulan <strong>{{ \Carbon\Carbon::parse(request('bulan'))->translatedFormat('F Y') }}</strong>
                </div>
            </div>
            @endif

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
                      <th>Nama Ibu</th>
                      <th>Tensi Badan</th>
                      <th>Berat Badan (kg)</th>
                      <th>Usia Hamil</th>
                      <th>Kondisi</th>                   
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($laporanIbuHamil as $laporan)
                    <tr>
                      <td>{{ $laporan->tgl_kunjungan }}</td>
                      <td>{{ $laporan->ibu->nama_ibu_hamil }}</td>
                      <td>{{ $laporan->tensi }}</td>
                      <td>{{ $laporan->bb_ibu_hamil }}</td>
                      <td>{{ $laporan->usia_hamil }}</td>
                      <td>{{ $laporan->kondisi }}</td>
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
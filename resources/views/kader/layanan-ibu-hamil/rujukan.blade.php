<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            {{-- <div class="card-header">
              <a href="{{ route('kader.layanan-ibu-hamil.create') }}" class="btn btn-primary">Buat Rujukan</a>
            </div> --}}
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
                        <th>Nama Kader</th>                        
                        <th>Tensi</th>
                        <th>Berat Badan (kg)</th>
                        <th>Usia Hamil</th>
                        <th>Kondisi</th>
                        <th>Buat Rujukan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rujukanList as $item)
                    <tr>
                      <td>{{ $item->tgl_kunjungan }}</td>
                      <td>{{ $item->ibu->nama_ibu_hamil }}</td>
                      <td>{{ $item->kader->nama_kader }}</td>
                      <td>{{ $item->tensi }}</td>
                      <td>{{ $item->bb_ibu_hamil }}</td>
                      <td>{{ $item->usia_hamil }}</td>
                      <td>
                        <span class="badge badge-danger">{{ $item->kondisi }}</span>
                      </td>
                      <td>
                        <a href="#" class="btn btn-warning btn-sm" alt="Buat Rujukan"><i class="fas fa-paper-plane"></i></a>
                      </td>
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
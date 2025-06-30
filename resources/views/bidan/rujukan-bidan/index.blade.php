<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
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
                        <th>Tanggal Rujukan</th>
                        <th>Nama Ibu</th>
                        <th>Nama Kader</th>   
                        <th>Keluhan/Masalah</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rujukanList as $item)
                    <tr>
                      <td>{{ $item->tgl_rujukan }}</td>
                      <td>{{ $item->ibu->nama_ibu_hamil }}</td>
                      <td>{{ $item->kader->nama_kader }}</td>
                      <td>{{ $item->catatan_kesehatan }}</td>
                      <td>
                        <a href="{{ route('bidan.rujukan-bidan.download.pdf', $item->id) }}" class="btn btn-warning btn-sm" title="Unduh PDF" target="_blank"><i class="fas fa-download"></i></a>
                        <a href="{{ route('bidan.rujukan-bidan.print.pdf', $item->id) }}" class="btn btn-danger btn-sm" title="Cetak PDF" target="_blank"><i class="fas fa-file-pdf"></i></a>
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
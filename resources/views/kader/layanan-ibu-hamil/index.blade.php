<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('kader.layanan-ibu-hamil.create') }}" class="btn btn-primary">Tambah Data</a>
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
                      <th>Nama Ibu</th>
                      <th>Nama Kader</th>
                      <th>Tensi</th>
                      <th>Berat Badan</th>
                      <th>Usia Hamil</th>
                      <th>Tanggal Kunjungan</th>
                      <th>Kondisi</th>
                      <th>Aksi</th>                        
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($layananIbu as $item)
                    <tr>
                      <td>{{ $item->ibu->nama_ibu_hamil }}</td>
                      <td>{{ $item->kader->nama_kader }}</td>
                      <td>{{ $item->tensi }}</td>
                      <td>{{ $item->bb_ibu_hamil }}</td>
                      <td>{{ $item->usia_hamil }}</td>
                      <td>{{ $item->tgl_kunjungan }}</td>
                      <td>{{ $item->kondisi }}</td>
                      <td>
                        <a href="{{ route('kader.layanan-ibu-hamil.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('kader.layanan-ibu-hamil.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>                        
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
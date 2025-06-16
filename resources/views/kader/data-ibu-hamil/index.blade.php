<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('kader.data-ibu-hamil.create') }}" class="btn btn-primary">Tambah Data</a>
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
                      <th>NIK Ibu</th>
                      <th>Nama Ibu</th>
                      <th>Tanggal Lahir</th>
                      <th>Usia</th>
                      <th>Telepon</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($ibuHamil as $item)
                    <tr>
                      <td>{{ $item->nik_ibu_hamil }}</td>
                      <td>{{ $item->nama_ibu_hamil }}</td>
                      <td>{{ $item->tgl_lahir }}</td>
                      <td>{{ $item->usia }} tahun</td>
                      <td>{{ $item->telepon }}</td>
                      <td>{{ $item->alamat }}</td>
                      <td>
                        <a href="{{ route('kader.data-ibu-hamil.edit', $item->nik_ibu_hamil) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('kader.data-ibu-hamil.destroy', $item->nik_ibu_hamil) }}" method="POST" style="display:inline;">
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
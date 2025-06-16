<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('kader.data-anak.create') }}" class="btn btn-primary">Tambah Data</a>
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
                      <th>NIK Anak</th>
                      <th>Nama Anak</th>
                      <th>Tanggal Lahir</th>
                      <th>Usia</th>
                      <th>Jenis Kelamin</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($anak as $item)
                    <tr>
                      <td>{{ $item->nik_anak }}</td>
                      <td>{{ $item->nama_anak }}</td>
                      <td>{{ $item->tgl_lahir }}</td>
                      <td>{{ $item->usia }} tahun</td>
                      <td>{{ $item->jenis_kelamin }}</td>
                      <td>
                        <a href="{{ route('kader.data-anak.edit', $item->nik_anak) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('kader.data-anak.destroy', $item->nik_anak) }}" method="POST" style="display:inline;">
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
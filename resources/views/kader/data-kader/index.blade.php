<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('kader.data-kader.create') }}" class="btn btn-primary">Tambah Data</a>
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
                      <th>NIK Kader</th>
                      <th>Nama Kader</th>
                      <th>Username</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @dd($kader) --}}
                    @foreach ($list_kader as $item)
                    <tr>
                      <td>{{ $item->nik_kader }}</td>
                      <td>{{ $item->nama_kader }}</td>
                      <td>{{ $item->username }}</td>
                      <td>
                        <a href="{{ route('kader.data-kader.edit', $item->nik_kader) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('kader.data-kader.destroy', $item->nik_kader) }}" method="POST" style="display:inline;">
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
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
                        <a href="{{ route('kader.rujukan-kader.edit', $item->id) }}" class="btn btn-warning btn-sm" alt="Edit Rujukan"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('kader.rujukan-kader.destroy', $item->id) }}" method="POST" style="display:inline;">
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
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('kader.layanan-balita.create') }}" class="btn btn-primary">Tambah Data</a>
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
                      <th>Nama Anak</th>
                      <th>Nama Kader</th>
                      <th>BB (kg)</th>
                      <th>TB (cm)</th>
                      <th>LK (cm)</th>
                      <th>LILA (cm)</th>
                      <th>Status Gizi</th>
                      <th>Imunisasi</th>
                      <th>Tanggal Imunisasi</th>
                      <th>Catatan</th>
                      <th>Aksi</th>                        
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($layananBalita as $item)
                    <tr>
                      <td>{{ $item->anak->nama_anak }}</td>
                      <td>{{ $item->kader->nama_kader }}</td>
                      <td>{{ $item->bb_anak }}</td>
                      <td>{{ $item->tb_anak }}</td>
                      <td>{{ $item->lk_anak }}</td>
                      <td>{{ $item->lila_anak }}</td>
                      <td>
                        <span class="badge 
                            @if($item->status_gizi == 'Gizi Normal') badge-success
                            @elseif($item->status_gizi == 'Gizi Kurang') badge-warning
                            @else badge-danger
                            @endif">
                            {{ $item->status_gizi ?? '-' }}
                        </span>
                    </td>                    
                      <td>{{ $item->imunisasi }}</td>
                      <td>{{ $item->tgl_imunisasi }}</td>
                      <td>{{ $item->catatan_kesehatan }}</td>
                      <td>
                        <a href="{{ route('kader.layanan-balita.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('kader.layanan-balita.destroy', $item->id) }}" method="POST" style="display:inline;">
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
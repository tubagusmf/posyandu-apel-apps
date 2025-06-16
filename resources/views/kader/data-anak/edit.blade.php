<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-10 col-lg-10">
                    @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                <form action="{{ route('kader.data-anak.update', $anak->nik_anak) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="nik">Nik Anak</label>
                    <input type="number" name="nik_anak" class="form-control" id="nik" placeholder="Nik anak" value="{{ old('nik_anak', $anak->nik_anak) }}"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="nama_anak" class="form-control" id="name" placeholder="Nama Lengkap" value="{{ old('nama_anak', $anak->nama_anak) }}"/>
                  </div>
                  <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="{{ old('tgl_lahir', $anak->tgl_lahir) }}"/>
                  </div>
                  <div class="form-group">
                    <label for="telepon">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                        <option value="Laki-laki" {{ $anak->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $anak->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>                
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.data-anak') }}" class="btn btn-danger">Cancel</a>
            </div>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
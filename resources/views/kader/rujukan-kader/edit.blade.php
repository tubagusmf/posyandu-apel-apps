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
                <form action="{{ route('kader.rujukan-kader.update', $rujukan->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label>No Rujukan</label>
                    <input type="text" name="no_rujukan" class="form-control" value="{{ $rujukan->no_rujukan }}" readonly>
                  </div>
                  <input type="hidden" name="nik_kader" value="{{ $rujukan->kader->nik_kader }}">
                  <input type="hidden" name="nik_ibu_hamil" value="{{ $rujukan->ibu->nik_ibu_hamil }}">
                  <div class="form-group">
                    <label>Nama Ibu Hamil</label>
                    <input type="text" class="form-control" value="{{ $rujukan->ibu->nama_ibu_hamil }}" readonly>
                  </div>             
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" readonly>{{ $rujukan->ibu->alamat }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="text" class="form-control" value="{{ $rujukan->ibu->tgl_lahir }}" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keluhan/Masalah</label>
                    <textarea name="catatan_kesehatan" class="form-control" required>{{ old('catatan_kesehatan', $rujukan->catatan_kesehatan) }}</textarea>
                </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.rujukan-kader.data-rujukan') }}" class="btn btn-danger">Cancel</a>
            </div>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
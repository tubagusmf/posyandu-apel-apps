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
                <form action="{{ route('kader.data-ibu-hamil.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="nik">Nik Ibu</label>
                    <input type="number" name="nik_ibu_hamil" class="form-control" id="nik" placeholder="Nik Ibu"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="nama_ibu_hamil" class="form-control" id="name" placeholder="Nama Lengkap"/>
                  </div>
                  <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Nomor Telepon</label>
                    <input type="number" name="telepon" class="form-control" id="telepon" placeholder="Nomor Telepon"/>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10" placeholder="Alamat Lengkap"></textarea>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.data-ibu-hamil') }}" class="btn btn-danger">Cancel</a>
            </div>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
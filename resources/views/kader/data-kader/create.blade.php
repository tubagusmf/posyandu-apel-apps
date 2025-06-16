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
                <form action="{{ route('kader.data-kader.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="nik">Nik Kader</label>
                    <input type="number" name="nik_kader" class="form-control" id="nik" placeholder="Nik Kader"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="nama_kader" class="form-control" id="name" placeholder="Nama Lengkap"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" name="password" class="form-control" id="name" placeholder="Password"/>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.data-kader') }}" class="btn btn-danger">Cancel</a>
            </div>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
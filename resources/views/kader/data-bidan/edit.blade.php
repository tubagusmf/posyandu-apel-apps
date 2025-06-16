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
                <form action="{{ route('kader.data-bidan.update', $list_bidan->nik_bidan) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="nik">Nik bidan</label>
                    <input type="number" name="nik_bidan" class="form-control" id="nik" placeholder="Nik bidan" value="{{ old('nik_bidan', $list_bidan->nik_bidan) }}"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="nama_bidan" class="form-control" id="name" placeholder="Nama Lengkap" value="{{ old('nama_bidan', $list_bidan->nama_bidan) }}"/>
                  </div>
                  <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ old('username', $list_bidan->username) }}"/>
                  </div>   
                  <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="password"/>
                  </div>             
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.data-bidan') }}" class="btn btn-danger">Cancel</a>
            </div>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
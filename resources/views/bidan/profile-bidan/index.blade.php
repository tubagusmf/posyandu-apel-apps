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
                        <div class="col-12 col-md-4">
                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-profile-tab-icons" data-bs-toggle="pill" href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons" aria-selected="true">
                                    <i class="far fa-user"></i>
                                    Profile
                                </a>
                                <a class="nav-link" id="v-pills-home-tab-icons" data-bs-toggle="pill" href="#v-pills-home-icons" role="tab" aria-controls="v-pills-home-icons" aria-selected="false">
                                    <i class="icon-pencil"></i>
                                    Edit
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="tab-content" id="v-pills-with-icon-tabContent">                                
                                <div class="tab-pane fade show active" id="v-pills-profile-icons" role="tabpanel" aria-labelledby="v-pills-profile-tab-icons">
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <table class="table table-hover">
                                        <tr>
                                          <th>NIK</th>
                                          <td>:</td>
                                          <td>{{ $profile->nik_bidan }}</td>
                                        </tr>
                                        <tr>
                                          <th>Nama</th>
                                          <td>:</td>
                                          <td>{{ $profile->nama_bidan }}</td>
                                        </tr>
                                        <tr>
                                          <th>Username</th>
                                          <td>:</td>
                                          <td>{{ $profile->username }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">

                                    <form action="{{ route('bidan.profile-bidan.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    
                                        <div class="form-group">
                                          <label>NIK Bidan</label>
                                          <input type="text" class="form-control" value="{{ $profile->nik_bidan }}" disabled>
                                        </div>
                                    
                                        <div class="form-group">
                                          <label>Nama Bidan</label>
                                          <input type="text" name="nama_bidan" class="form-control" value="{{ old('nama_bidan', $profile->nama_bidan) }}">
                                        </div>
                                    
                                        <div class="form-group">
                                          <label>Username</label>
                                          <input type="text" name="username" class="form-control" value="{{ old('username', $profile->username) }}">
                                        </div>
                                    
                                        <div class="form-group">
                                          <label>Password (Kosongkan jika tidak ingin mengganti)</label>
                                          <input type="password" name="password" class="form-control">
                                        </div>
                                    
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>
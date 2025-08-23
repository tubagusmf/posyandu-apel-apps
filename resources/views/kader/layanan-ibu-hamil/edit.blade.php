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
                <form action="{{ route('kader.layanan-ibu-hamil.update', $layananIbuHamil->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="nik_ibu_hamil">Nama Ibu <span class="text-danger">*</span></label>
                    <select name="nik_ibu_hamil" class="form-control" id="nik_ibu_hamil" required>
                      <option value="">-- Pilih Nama Ibu --</option>
                      @foreach($ibuList as $ibuHamil)
                        <option value="{{ $ibuHamil->nik_ibu_hamil }}"
                          {{ $ibuHamil->nik_ibu_hamil == $layananIbuHamil->nik_ibu_hamil ? 'selected' : '' }}>
                          {{ $ibuHamil->nama_ibu_hamil }}
                        </option>
                      @endforeach
                    </select>
                  </div>             
                  <div class="form-group">
                    <label for="tensi">Tensi Badan (cm) <span class="text-danger">*</span></label>
                    <input type="text" name="tensi" step="0.01" class="form-control" placeholder="Contoh: 120/80" value="{{ $layananIbuHamil->tensi }}" required>
                  </div>
                  <div class="form-group">
                    <label for="bb_ibu_hamil">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <input type="number" name="bb_ibu_hamil" step="0.01" class="form-control" placeholder="Contoh: 58.50" value="{{ $layananIbuHamil->bb_ibu_hamil }}" required>
                  </div>
                  <div class="form-group">
                    <label for="usia_hamil">Usia Hamil <span class="text-danger">*</span></label>
                    <select name="usia_hamil" class="form-control" id="usia_hamil" required>
                      <option value="">-- Pilih Usia Kehamilan --</option>
                      @for ($i = 1; $i <= 42; $i++)
                        <option value="{{ $i }} minggu"
                          {{ $layananIbuHamil->usia_hamil == $i.' minggu' ? 'selected' : '' }}>
                          {{ $i }} minggu
                        </option>
                      @endfor
                    </select>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.layanan-ibu-hamil') }}" class="btn btn-danger">Cancel</a>
            </div>
            <p>note: untuk tanda <span class="text-danger">*</span> wajib diisi</p>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
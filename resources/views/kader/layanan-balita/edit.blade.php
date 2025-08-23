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
                <form action="{{ route('kader.layanan-balita.update', $layananBalita->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="nik_anak">Nama Anak <span class="text-danger">*</span></label>
                    <select name="nik_anak" class="form-control" id="nik_anak" required>
                      <option value="">-- Pilih Anak --</option>
                      @foreach($anakList as $anak)
                        <option value="{{ $anak->nik_anak }}" {{ $layananBalita->nik_anak == $anak->nik_anak ? 'selected' : '' }}>
                          {{ $anak->nama_anak }}
                        </option>
                      @endforeach
                    </select>
                  </div>                 
                  <div class="form-group">
                    <label for="bb_anak">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <input type="number" name="bb_anak" step="0.01" class="form-control" value="{{ $layananBalita->bb_anak }}" required>
                  </div>                 
                  <div class="form-group">
                    <label for="tb_anak">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                    <input type="number" name="tb_anak" step="0.01" class="form-control" value="{{ $layananBalita->tb_anak }}" required>
                  </div>
                  <div class="form-group">
                    <label for="lk_anak">Lingkar Kepala (cm) <span class="text-danger">*</span></label>
                    <input type="number" name="lk_anak" step="0.01" class="form-control" value="{{ $layananBalita->lk_anak }}" required>
                  </div>
                  <div class="form-group">
                    <label for="lila_anak">Lingkar Lengan (cm) <span class="text-danger">*</span></label>
                    <input type="number" name="lila_anak" step="0.01" class="form-control" value="{{ $layananBalita->lila_anak }}" required>
                  </div>
                  <div class="form-group">
                    <label for="imunisasi">Jenis & Jadwal Imunisasi</label>
                    <textarea name="imunisasi" class="form-control" rows="3">{{ $layananBalita->imunisasi }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="tgl_imunisasi">Tanggal Imunisasi</label>
                    <input type="date" name="tgl_imunisasi" class="form-control" value="{{ $layananBalita->tgl_imunisasi }}">
                  </div>
                  <div class="form-group">
                    <label for="catatan_kesehatan">Catatan Kesehatan</label>
                    <textarea name="catatan_kesehatan" class="form-control" rows="3">{{ $layananBalita->catatan_kesehatan }}</textarea>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.layanan-balita') }}" class="btn btn-danger">Cancel</a>
            </div>
            <p>note: untuk tanda <span class="text-danger">*</span> wajib diisi</p>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
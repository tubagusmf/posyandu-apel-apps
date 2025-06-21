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
                <form action="{{ route('kader.layanan-balita.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="nik_anak">Nama Anak</label>
                    <select name="nik_anak" class="form-control" id="nik_anak" required>
                      <option value="">-- Pilih Nama Anak --</option>
                      @foreach($anakList as $anak)
                        <option value="{{ $anak->nik_anak }}">{{ $anak->nama_anak }}</option>
                      @endforeach
                    </select>
                  </div>                  
                  <div class="form-group">
                    <label for="bb_anak">Berat Badan (kg)</label>
                    <input type="number" name="bb_anak" step="0.01" class="form-control" placeholder="Contoh: 10.50" required>
                  </div>                 
                  <div class="form-group">
                    <label for="tb_anak">Tinggi Badan (cm)</label>
                    <input type="number" name="tb_anak" step="0.01" class="form-control" placeholder="Contoh: 75.50" required>
                  </div>
                  <div class="form-group">
                    <label for="lk_anak">Lingkar Kepala (cm)</label>
                    <input type="number" name="lk_anak" step="0.01" class="form-control" placeholder="Contoh: 44.20" required>
                  </div>
                  <div class="form-group">
                    <label for="lila_anak">Lingkar Lengan (cm)</label>
                    <input type="number" name="lila_anak" step="0.01" class="form-control" placeholder="Contoh: 13.50" required>
                  </div>
                  <div class="form-group">
                    <label for="imunisasi">Jenis & Jadwal Imunisasi</label>
                    <textarea name="imunisasi" class="form-control" rows="3" placeholder="Contoh: BCG - 12 Jan 2025" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="tgl_imunisasi">Tanggal Imunisasi</label>
                    <input type="date" name="tgl_imunisasi" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="catatan_kesehatan">Catatan Kesehatan</label>
                    <textarea name="catatan_kesehatan" class="form-control" rows="3" placeholder="Catatan Kesehatan" required></textarea>
                  </div>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="{{ route('kader.layanan-balita') }}" class="btn btn-danger">Cancel</a>
            </div>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>
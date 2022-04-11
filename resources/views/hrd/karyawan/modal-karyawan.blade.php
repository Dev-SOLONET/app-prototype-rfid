<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" name="id">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 col-12 mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Karyawan" required>
                            <span class="text-danger">
                                <strong id="nama"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik" placeholder="Masukan NIK" required>
                            <span class="text-danger">
                                <strong id="nik"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control selectpicker">
                              <option value="" selected disabled>-- Pilih Jabatan --</option>
                              @foreach ($jabatan as $data)
                              <option value="{{ $data->id }}">{{ $data->nama }}</option>
                              @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="jabatan"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Masukan Username"
                                required>
                            <span class="text-danger">
                                <strong id="username"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukan Password"
                                required>
                            <span class="text-danger">
                                <strong id="password"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control selectpicker">
                              <option value="" selected disabled>-- Pilih Jenis kelamin --</option>
                              <option value="L">Laki - Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                            <span class="text-danger">
                                <strong id="jenis_kelamin"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Nomor HP</label>
                            <input type="number" class="form-control" name="no_hp" placeholder="Masukan Nomor HP"
                                required>
                            <span class="text-danger">
                                <strong id="no_hp"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" placeholder="Masukan Alamat"></textarea>
                            <span class="text-danger">
                                <strong id="alamat"></strong>
                            </span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
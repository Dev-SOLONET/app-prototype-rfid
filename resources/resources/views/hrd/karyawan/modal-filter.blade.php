<!-- Modal -->
<div class="modal fade" id="filter_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-filter">
          @csrf
          <div class="form-row">
            <div class="col-md-6 col-12 mb-3">
              <label>Jabatan</label>
              <select name="filter-jabatan" id="filter-jabatan" class="form-control selectpicker">
                <option value="all" selected>-- Semua Jabatan --</option>
                @foreach ($jabatan as $data)
                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 col-12 mb-3">
              <label>Bank</label>
              <select name="filter-bank" id="filter-bank" class="form-control selectpicker">
                <option value="all" selected>-- Semua Bank --</option>
                <option value="BNI">BNI</option>
                <option value="BCA">BCA</option>
                <option value="BRI">BRI</option>
                <option value="MANDIRI">MANDIRI</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="filter_data()" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
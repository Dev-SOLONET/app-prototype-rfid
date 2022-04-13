@extends('layouts.default')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner" style="background-color: #e8f1f7">
    <div class="container">
        <div class="row">
            <!-- data table start -->
            <div class="col-md-3 col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="title">Filter Data</h5>
                        <div class="row">
                            <div class="col-md-12 col-12 mt-2">
                                <label>Dari Tanggal : </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="from"
                                        placeholder="Pilih Tanggal Awal" value="{{ date('Y-m-01') }}" id="from">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <label>Sampai Tanggal : </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="to"
                                        placeholder="Pilih Tanggal Akhir" value="{{ date('Y-m-t') }}" id="to">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <label>Jabatan : </label>
                                <div class="input-group">
                                    <select id="jabatan" name="jabatan" class="form-control selectpicker"
                                        data-live-search="true">
                                        <option value="all" selected>--Semua Jabatan--</option>
                                        @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 text-center mt-2">
                                <div class="form-group">
                                    <button type="button" onclick="add_filter()" class="btn btn-outline-primary"><i
                                            class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <h4 class="header-title">Data Jadwal Karyawan</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <button type="button" onclick="add()"
                                    class="btn btn-rounded btn-outline-info float-right mb-3"><i class="ti-plus"> </i>
                                    Tambah</button>
                            </div>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Shift</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <!-- data table end -->
        </div>
    </div>
</div>
<!-- main content area end -->
@include('hrd.jadwal.modal')

@endsection

@section('js')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script src="{{ url('srtdash/assets/vendor/number/jquery.number.min.js') }}"></script>

<script src="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    var table;
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
            ajax: {
                  url: "{{ route('hrd.jadwal.index') }}",
                  type: "GET",
                  data: function(data) {
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.jabatan = $('#jabatan').val();
              }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'nama_karyawan', name: 'nama_karyawan'},
                {data: 'nama_shift', name: 'nama_shift'},
                {data: 'tgl', name: 'tgl'},
                {data: 'action', name: 'action'},

            ],
        });

    });

    function add_filter(){
      var from = $("#from").val();
      var to = $("#to").val();
      var distributor = $("#jabatan").val();
      table.draw();
      info();
    }

        function info() {
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                    });
                Toast.fire({
                    icon: 'info',
                    title: 'Sukses Filter Data !'
                })
            }

        function reload_table(){
            table.ajax.reload(null,false);
        }

        function show_filter(){
            $('.modal-title').text('Filter Data'); // Set Title to Bootstrap modal title
            $("#stok").val('');
            $('#modal-filter').modal('show'); // show bootstrap modal
        }

        function add(){
            $('#form')[0].reset(); // reset form on modals
            $('#tanggal_mulai').html("");
            $('#tanggal_selesai').html("");
            $('#user_id').html("");
            $('#shift_id').html("");
            $('[name="user_id"]').selectpicker('val', [0]);
            $('[name="shift_id"]').selectpicker('val', [0]);
            $('[name="id"]').val('');
            $('#modal-form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Input Data Jadwal'); // Set Title to Bootstrap modal title
        }

        function save(){
            $.ajax({
                url : "{{ route('hrd.jadwal.store') }}",
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data){
                    console.log(data);
                    if(data.status) {
                        $('#modal-form').modal('hide');
                        reload_table();
                        sukses();
                    }else{
                        if(data.errors.user_id){
                            $('#user_id').text(data.errors.user_id[0]);
                        }if(data.errors.shift_id){
                            $('#shift_id').text(data.errors.shift_id[0]);
                        }if(data.errors.tanggal_mulai){
                            $('#tanggal_mulai').text(data.errors.tanggal_mulai[0]);
                        }
                    }
                },
                error: function (jqXHR, textStatus , errorThrown){ 
                    alert(errorThrown);
                }
            });
        }

        function edit(id){
            $('#form')[0].reset(); // reset form on modals
            $('#tanggal_mulai').html("");
            $('#tanggal_selesai').html("");
            $('#user_id').html("");
            $('#shift_id').html("");
            $('[name="id"]').val('');
            //Ajax Load data from ajax
            $.ajax({
            url : "/absensirfid/hrd/jadwal/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="tanggal_mulai"]').val(data.tanggal_mulai);
                $('[name="tanggal_selesai"]').val(data.tanggal_selesai);
                $('[name="user_id"]').selectpicker('val', data.user_id);
                $('[name="shift_id"]').selectpicker('val', data.shift_id);
                $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Jadwal'); // Set title to Bootstrap modal title   
            },
            error: function (jqXHR, textStatus , errorThrown) {
                alert(errorThrown);
            }
            });
        }

        function delete_data(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
            })
            swalWithBootstrapButtons.fire({
                title: 'Konfirmasi !',
                text: "Anda Akan Menghapus Data ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus !',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url : "/absensirfid/hrd/jadwal/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function(data){
                        if(data.status){
                        console.log(status);
                        reload_table();
                        sukseshapus();
                        }else{
                            alert('Data tidak boleh dihapus');
                        }
                    },
                    error: function (jqXHR, textStatus , errorThrown){ 
                        console.log(errorThrown);
                    }
                })
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Batal',
                    'Data tidak dihapus',
                    'error'
                )
                }
            })
        }
</script>
@endsection
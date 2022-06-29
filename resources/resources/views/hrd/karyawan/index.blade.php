@extends('layouts.default')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">

@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner" style="background-color: #bbcfdd">
    <div class="container">
        <div class="row">
            <!-- data table start -->
            <div class="col-md-12 col-12">
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h4 class="header-title">Data Karyawan</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <button type="button" onclick="add()"
                                    class="btn btn-rounded btn-outline-info float-right mb-3 mr-1"><i
                                        class="ti-plus"> </i> Tambah Karyawan</button>
                                <button type="button" onclick="modal_data()"
                                    class="btn btn-rounded btn-outline-secondary float-right mb-3 mr-1"><i
                                        class="ti-filter"> </i> Filter Data</button>
                            </div>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Karyawan</th>
                                    <th>NIK</th>
                                    <th>Jabatan</th>
                                    <th>Bank</th>
                                    <th>No Rekening</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
</div>
<!-- main content area end -->
@include('hrd.karyawan.modal-filter')
@include('hrd.karyawan.modal-karyawan')
@endsection

@section('js')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

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
                  url: '{{ route('hrd.karyawan.index')}}',
                  type: "GET",
                  data: function(data) {
                    data.jabatan = $('#filter-jabatan').val();
                    data.bank = $('#filter-bank').val();
              }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'link_kode_po', name: 'link_kode_po'},
                {data: 'nik', name: 'nik'},
                {data: 'nama_jabatan', name: 'nama_jabatan'},
                {data: 'bank', name: 'bank'},
                {data: 'no_rekening', name: 'no_rekening'},
                {data: 'action', name: 'action'},
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-rounded btn-outline-success',
                    exportOptions: {
                        columns: [0, 1, 4, 5]
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn btn-rounded btn-outline-danger',
                    exportOptions: {
                        columns: [0, 1, 4, 5]
                    }
                }
            ]
        });

    });

    function filter_data(){
        console.log('filter');
        var jabatan = $("#filter-jabatan").val();
        var bank = $("#filter-bank").val();
        table.draw();
        info();
    }

    function add(){
        $('#form')[0].reset(); // reset form on modals
        $('#nik').html("");
        $('#nama').html("");
        $('#no_hp').html("");
        $('#alamat').html("");
        $('#username').html("");
        $('#password').html("");
        $('#jabatan').html("");
        $('#jenis_kelamin').html("");
        $('#uid').html("");
        $('[name="id"]').val('');
        $('[name="jenis_kelamin"]').selectpicker('val', 0);
        $('[name="jabatan"]').selectpicker('val', 0);
        $('[name="bank"]').selectpicker('val', 0);
        $('#modal-form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Data Karyawan'); // Set Title to Bootstrap modal title
    }

    function modal_data(){
      $('#filter_modal').modal('show');
    }

    function save(){
        $('#nik').html("");
        $('#nama').html("");
        $('#no_hp').html("");
        $('#alamat').html("");
        $('#username').html("");
        $('#password').html("");
        $('#jabatan').html("");
        $('#jenis_kelamin').html("");
        $('#uid').html("");
        $.ajax({
            url : "{{ route('hrd.karyawan.store')}}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) {
                    $('#modal-form').modal('hide');
                    reload_table();
                    sukses();
                }else{
                    if(data.errors.nik){
                        $('#nik').text(data.errors.nik[0]);
                    }
                    if(data.errors.nama){
                        $('#nama').text(data.errors.nama[0]);
                    }
                    if(data.errors.no_hp){
                        $('#no_hp').text(data.errors.no_hp[0]);
                    }
                    if(data.errors.alamat){
                        $('#alamat').text(data.errors.alamat[0]);
                    }
                    if(data.errors.username){
                        $('#username').text(data.errors.username[0]);
                    }
                    if(data.errors.password){
                        $('#password').text(data.errors.password[0]);
                    }
                    if(data.errors.jabatan){
                        $('#jabatan').text(data.errors.jabatan[0]);
                    }
                    if(data.errors.jenis_kelamin){
                        $('#jenis_kelamin').text(data.errors.jenis_kelamin[0]);
                    }
                    if(data.errors.uid){
                        $('#uid').text(data.errors.uid[0]);
                    }
                    if(data.errors.bank){
                        $('#bank').text(data.errors.bank[0]);
                    }
                    if(data.errors.no_rekening){
                        $('#no_rekening').text(data.errors.no_rekening[0]);
                    }
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
        });
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

    function edit(id){
        $('#form')[0].reset(); // reset form on modals
        $('#nik').html("");
        $('#nama').html("");
        $('#no_hp').html("");
        $('#alamat').html("");
        $('#username').html("");
        $('#password').html("");
        $('#jabatan').html("");
        $('#jenis_kelamin').html("");
        $('#uid').html("");
        $('[name="id"]').val('');
        //Ajax Load data from ajax
        $.ajax({
            url : "karyawan/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="alamat"]').val(data.alamat);
                $('[name="username"]').val(data.user.name);
                $('[name="alamat"]').val(data.alamat);
                $('[name="nik"]').val(data.nik);
                $('[name="uid"]').val(data.uid);
                $('[name="jenis_kelamin"]').selectpicker('val', [data.jenis_kelamin]);
                $('[name="jabatan"]').selectpicker('val', [data.user.jabatan_id]);
                $('[name="bank"]').selectpicker('val', [data.bank]);
                $('[name="no_rekening"]').val(data.no_rekening);
                $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Karyawan'); // Set title to Bootstrap modal title   
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
            url : "karyawan/" + id,
            type: "DELETE",
            dataType: "JSON",
            success: function(data){
                if(data.status){
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
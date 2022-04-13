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
<div class="main-content-inner">
    <div class="container">
        <div class="row">
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
                                <label>Sampai Tanggal: </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="to"
                                        placeholder="Pilih Tanggal Akhir" value="{{ date('Y-m-t') }}" id="to">
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
            <!-- data table start -->
            <div class="col-md-9 col-12">
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h4 class="header-title">Data Penjualan</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <button type="button" onclick="reload_table()"
                                    class="btn btn-rounded btn-outline-secondary float-right mb-3 mr-1"><i
                                        class="ti-reload"> </i> Reload</button>
                            </div>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Hari</th>
                                    <th>Total</th>
                                    <th>Pembayaran</th>
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
                  url: '',
                  type: "GET",
                  data: function(data) {
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.distributor = $('#distributor').val();
                    data.penggunaan = $('#penggunaan').val();
              }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'link_kode_po', name: 'link_kode_po'},
                {data: 'nama', name: 'nama'},
                {data: 'no_invoice', name: 'no_invoice'},
                {data: 'beli', name: 'beli'},
                {data: 'h_total', name: 'h_total'},
            ],
        });

    });

    function add_filter(){
      var from = $("#from").val();
      var to = $("#to").val();
      var distributor = $("#distributor").val();
      var penggunaan = $('#penggunaan').val();
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

</script>
@endsection
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">

@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <!-- data table start -->
            <div class="col-md-1"></div>
            <div class="col-md-10 col-12">
                <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
                    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                        <div class="toast-header">
                            <strong class="mr-auto">Info</strong>
                            <small>a mins ago</small>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            <span id="nama-karyawan"></span>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <h4 class="header-title">Data Absensi Karyawan</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-5 col-12 mt-1">
                                        <div class="input-group">
                                            <input type="date" class="form-control float-right datepicker" name="from" placeholder="Pilih Tanggal Awal" value="{{ date('Y-m-01') }}" id="from">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="col-md-5 col-12 mt-1">
                                        <div class="input-group">
                                            <input type="date" class="form-control float-right datepicker" name="to" placeholder="Pilih Tanggal Akhir" value="{{ date('Y-m-t') }}" id="to">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="col-md-2 col-12 text-center mt-2">
                                        <div class="form-group">
                                            <button type="button" onclick="add_filter()" class="btn btn-outline-primary"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Hari / Tanggal</th>
                                    <th>Shift</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    {{-- <th>Jam Kerja</th> --}}
                                    {{-- <th>Shift</th> --}}
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

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.socket.io/4.4.1/socket.io.min.js" integrity="sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H" crossorigin="anonymous">
</script>

<script type="text/javascript">
    // socket.io
    var socket = io('http://aplikasi.solonet.net.id:3000/');
    // on message from server
    socket.on('chat message', function(message) {
        console.log(message);
        $('.toast').toast('show');
        $('#nama-karyawan').text(message.karyawan);
        reload_table();
    });

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
            lengthMenu: [
                [50, 100, 200, -1],
                [50, 100, 200, "All"]
            ],
            ajax: {
                url: "{{ route('hrd.absensi.index') }}",
                type: "GET",
                data: function(data) {
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.penggunaan = $('#penggunaan').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'karyawan.nama',
                    name: 'karyawan.nama'
                },
                {
                    data: 'tgl',
                    name: 'tgl'
                },
                {
                    data: 'shift.nama',
                    name: 'shift.nama'
                },
                {
                    data: 'jam_masuk',
                    name: 'jam_masuk'
                },
                {
                    data: 'jam_pulang',
                    name: 'jam_pulang'
                },
                // {data: 'jam_pulang', name: 'jam_pulang'},
                // {data: 'shift.nama', name: 'shift.nama'},
            ],
        });

    });

    function show_notification(){
        $('.toast').toast('show');
    }

    function add_filter() {
        var from = $("#from").val();
        var to = $("#to").val();
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

    function reload_table() {
        table.ajax.reload(null, false);
    }
</script>
@endsection
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
@endsection
@section('content')
<div class="main-content-inner" style="background-color: #e8f1f7">
    <div class="container">
        <div class="row">
            <!-- seo fact area start -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6 mt-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg1">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-thumb-up"></i> Masuk</div>
                                    <h2>2,315</h2>
                                </div>
                                <canvas id="seolinechart1" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-5 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg2">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-share"></i> Pulang</div>
                                    <h2>3,984</h2>
                                </div>
                                <canvas id="seolinechart2" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 mb-lg-0">
                        <div class="card">
                            <div class="seo-fact sbg3">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon">Cuti</div>
                                    <canvas id="seolinechart3" height="60"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="seo-fact sbg4">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon">Izin</div>
                                    <canvas id="seolinechart4" height="60"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- seo fact area end -->
            <!-- Advertising area start -->
            <div class="col-lg-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Statistik Cuti Karyawan</h4>
                        <canvas id="seolinechart8" height="130"></canvas>
                    </div>
                </div>
            </div>
            <!-- Statistics area start -->
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Statistik Kehadiran Karyawan</h4>
                        <div id="user-statistics"></div>
                    </div>
                </div>
            </div>
            <!-- Statistics area end -->
            
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

<!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- start amcharts -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<script src="{{ url('srtdash/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="{{ url('srtdash/assets/js/popper.min.js') }}"></script>
<script src="{{ url('srtdash/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('srtdash/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('srtdash/assets/js/metisMenu.min.js') }}"></script>
<script src="{{ url('srtdash/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('srtdash/assets/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ url('srtdash/assets/js/line-chart.js') }}"></script>
<script src="{{ url('srtdash/assets/js/pie-chart.js') }}"></script>
<script src="{{ url('srtdash/assets/js/maps.js') }}"></script>
<script src="{{ url('srtdash/assets/js/plugins.js') }}"></script>
<script src="{{ url('srtdash/assets/js/scripts.js') }}"></script>



@endsection
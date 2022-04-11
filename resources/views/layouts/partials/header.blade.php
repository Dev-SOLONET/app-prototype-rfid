<div class="container d-print-none">
    <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
            <div class="horizontal-menu ml-md-2">
                <nav>
                    <ul id="nav_menu">
                        <li><a href="{{ route('karyawan.jadwal.index')}}"><i class="ti-calendar"></i> <span>Jadwal</span></a></li>
                        <li><a href="{{ route('karyawan.absensi.index')}}"><i class="ti-calendar"></i> <span>Absensi</span></a></li>
                        <li><a href="{{ route('hrd.karyawan.index')}}"><i class="ti-calendar"></i> <span>Karyawan HRD</span></a></li>
                        <li><a href="{{ route('hrd.absensi.index')}}"><i class="ti-calendar"></i> <span>Absensi HRD</span></a></li>
                        <li><a href="{{ route('hrd.jadwal.index')}}"><i class="ti-calendar"></i> <span>Jadwal HRD</span></a></li>
                        <li><a href="{{ route('hrd.gaji.index')}}"><i class="ti-calendar"></i> <span>Gaji</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- mobile_menu -->
        <div class="col-12 d-block d-lg-none">
            <div id="mobile_menu"></div>
        </div>
    </div>
</div>
<!-- header area end -->
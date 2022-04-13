<div class="container d-print-none">
    <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
            <div class="horizontal-menu ml-md-2">
                <nav>
                    <ul id="nav_menu">
                        @if ( auth()->user()->jabatan_id == '1')
                        <li><a href="{{ route('hrd.dashboard.index')}}"><i class="ti-cup"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('hrd.karyawan.index')}}"><i class="ti-user"></i> <span>Karyawan</span></a></li>
                        <li><a href="{{ route('hrd.absensi.index')}}"><i class="ti-check-box"></i> <span>Absensi</span></a></li>
                        <li><a href="{{ route('hrd.jadwal.index')}}"><i class="ti-calendar"></i> <span>Jadwal</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '2')
                        <li><a href="{{ route('karyawan.jadwal.index') }}"><i class="ti-receipt"></i> <span>Jadwal</span></a></li>
                        <li><a href="{{ route('karyawan.absensi.index') }}"><i class="ti-clipboard"></i> <span>Absensi</span></a></li>
                        @endif
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
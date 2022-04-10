@extends('layouts.default')
@section('content')
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-area">
                            <div class="invoice-head">
                                <div class="row text-center">
                                    <div class="iv-left col-12">
                                        <span>PT. SOLO JALA BUANA</span>
                                    </div>
                                    <div class="iv-left col-12">
                                        <p class="text-small">Jl. Arifin No.129, Kepatihan Kulon, Kec. Jebres, Kota
                                            Surakarta, Jawa Tengah 57129</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="invoice-address text-center">
                                        <h5><u>SLIP GAJI KARYAWAN</u></h5>
                                        <p>Periode 1 April - 30 April 2022</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="d-flex justify-content-center">
                                        <div class="p-2 bd-highlight"><h6>Nama : {{ $data->nama }}</h6></div>
                                        <div class="p-2 bd-highlight"><h6>NIK : {{$data->nik }}</h6></div>
                                        <div class="p-2 bd-highlight"><h6>Jabatan : {{ $data->user->jabatan->nama }}</h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-table table-sm table-responsive mt-2">
                                    <h6>PENGHASILAN</h6>
                                    <table class="table table-borderless text-left">
                                        <tr class="text-capitalize">
                                            <td class="text-v" style="width: 40%;">Gaji Pokok</td>
                                            <td>:</td>
                                            <td class="text-right" style="width: 45%; min-width: 130px;">Rp. {{ number_format($data->user->jabatan->gaji_pokok) }}</td>
                                        </tr>
                                        <tr class="text-capitalize">
                                            <td class="text-left" style="width: 40%;">Tunjangan Absensi</td>
                                            <td>:</td>
                                            <td class="text-right" style="width: 45%; min-width: 130px;">Rp. 0</td>
                                        </tr>
                                        <tr class="text-capitalize">
                                            <td class="text-left" style="width: 40%;">Bonus Target</td>
                                            <td>:</td>
                                            <td class="text-right" style="width: 45%; min-width: 130px;">Rp. 0</td>
                                        </tr>
                                        <tr class="text-capitalize">
                                            <td class="text-center" style="width: 40%;"><b>TOTAL (A)</b></td>
                                            <td>:</td>
                                            <td class="text-right" style="width: 45%; min-width: 130px;"><b>Rp. {{ number_format($data->user->jabatan->gaji_pokok) }}</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-table table-sm table-responsive mt-2">
                                    <h6>POTONGAN</h6>
                                    <table class="table table-borderless text-left">
                                        <tr class="text-capitalize">
                                            <td class="text-v" style="width: 30%;">Pph 21</td>
                                            <td>:</td>
                                            <td class="text-right" style="width: 45%; min-width: 130px;">Rp. 0</td>
                                        </tr>
                                        <tr class="text-capitalize">
                                            <td class="text-left" style="width: 30%;">Asuransi</td>
                                            <td>:</td>
                                            <td class="text-right" style="width: 45%; min-width: 130px;">Rp. 0</td>
                                        </tr>
                                        <tr class="text-capitalize">
                                            <td class="text-center" style="width: 40%;"><b>TOTAL (B)</b></td>
                                            <td>:</td>
                                            <td class="text-right" style="width: 45%; min-width: 130px;"><b>Rp. 0</b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <div class="p-2 bd-highlight"><h5> PENERIMAAN BERSIH (A-B) : Rp. {{ number_format($data->user->jabatan->gaji_pokok) }}</h5></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="invoice-buttons text-right mb-2 mr-2">
                        <a href="#" class="invoice-btn">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
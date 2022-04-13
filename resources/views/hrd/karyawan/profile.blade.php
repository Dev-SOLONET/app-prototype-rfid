@extends('layouts.default')
@section('content')
<div class="main-content-inner">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ url('srtdash/assets/images/author/avatar.png') }}"
                                alt="User profile picture">
                        </div>
                        <br>
                        <h3 class="profile-username text-center">{{ $data->nama }}</h3>
                        <p class="text-muted text-center">{{ $data->user->jabatan->nama }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Nik</b> <a class="float-right">{{ $data->nik }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>No Hp</b> <a class="float-right">{{ $data->no_hp }}</a>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="ti-map mr-1"></i> Alamat</strong>
                        <p class="text-muted">
                            {{ $data->alamat }}
                        </p>
                        <hr>
                        <strong><i class="ti-book mr-1"></i> Jenis Kelamin</strong>
                        <p class="text-muted">
                            {{ $data->jenis_kelamin }}
                        </p>
                        <hr>
                        <strong><i class="ti-agenda mr-1"></i> Bank</strong>
                        <p class="text-muted">
                            {{ $data->bank }}
                        </p>
                        <hr>
                        <strong><i class="ti-clipboard mr-1"></i> No Rekening</strong>
                        <p class="text-muted">{{ $data->no_rekening }}</p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>


@endsection
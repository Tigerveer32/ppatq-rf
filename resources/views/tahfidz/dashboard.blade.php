@extends('layouts.user_type.tahfidz')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Santri</p>
                            <h5 class="font-weight-bolder mb-0">
                                150
                                <span class="text-success text-sm font-weight-bolder">+5%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-bullet-list-67 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Hafalan</p>
                            <h5 class="font-weight-bolder mb-0">
                                300
                                <span class="text-danger text-sm font-weight-bolder">-2%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kegiatan</p>
                            <h5 class="font-weight-bolder mb-0">
                                75
                                <span class="text-success text-sm font-weight-bolder">+10%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Santri Terbaru</p>
                            <h5 class="font-weight-bolder mb-0">
                                Santri D
                                <span class="text-success text-sm font-weight-bolder">+1</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column h-100">
                            <p class="mb-1 pt-2 text-bold">Aktivitas Terbaru</p>
                            <h5 class="font-weight-bolder">Kegiatan Santri</h5>
                            <ul class="list-unstyled">
                                <li>Santri A telah menyelesaikan hafalan 1 juz.</li>
                                <li>Santri B melakukan latihan hafalan 2 halaman.</li>
                                <li>Santri C mendapatkan pujian dari Ustad.</li>
                                <li>Santri D melakukan ujian hafalan.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 text-end">
                        <div class="d-flex flex-column h-100">
                            <p class="mb-1 pt-2 text-bold">Akses Fitur Penting</p>
                            <ul class="list-unstyled">
                                <li><a href="/santri" class="text-body">Data Santri</a></li>
                                <li><a href="/tahfidz" class="text-body">Data Hafalan</a></li>
                                <li><a href="/users" class="text-body">Manajemen Pengguna</a></li>
                                <li><a href="/logout" class="text-danger">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

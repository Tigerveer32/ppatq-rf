@extends('layouts.user_type.auth')

@section('title', 'Daftar Tahfidz')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Daftar Tahfidz</h4>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Tahfidz</th>
                            <th>Nama Ustadz</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahfidzs as $tahfidz)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <!-- Mengubah tautan untuk mengarah ke halaman santri tahfidz -->
                                    <a href="{{ route('admin.hafalan.hafalan', $tahfidz->id_tahfidz) }}">{{ $tahfidz->nama_tahfidz }}</a>
                                </td>
                                <td>{{ optional($tahfidz->pegawai)->nama_pegawai }}</td> <!-- Menampilkan nama ustadz -->
                                <td class="text-center">
                                    <a href="{{ route('admin.hafalan.hafalan', $tahfidz->id_tahfidz) }}" class="btn btn-warning btn-sm">Input Hafalan</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

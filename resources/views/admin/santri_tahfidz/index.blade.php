@extends('layouts.user_type.auth')

@section('title', 'Daftar Santri Tahfidz - ' . $Tahfidz->nama_tahfidz)

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Daftar Santri Tahfidz - {{ $Tahfidz->nama_tahfidz }}</h4>
                <h5>Ustadz: {{ optional($Ustadz)->nama_pegawai }}</h5>
                <a href="{{ route('admin.santri_tahfidz.form', $Tahfidz->id_tahfidz) }}" class="btn btn-success">Tambah Santri</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Nama Ustadz</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($santriTahfidz as $st)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $st->santri->nama_santri }}</td>
                            <td>{{ optional($st->pegawai)->nama_pegawai }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.santri_tahfidz.destroy', [$Tahfidz->id_tahfidz, $st->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus santri ini?')">Hapus</button>
                                </form>
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

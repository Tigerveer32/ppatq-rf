@extends('layouts.user_type.auth')

@section('title', 'Daftar Pegawai')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Daftar Pegawai</h4>
                <a href="{{ route('admin.pegawai.form') }}" class="btn btn-success">Tambah Pegawai</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawais as $pegawai)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.pegawai.edit', $pegawai->id_pegawai) }}">{{ $pegawai->nama_pegawai }}</a>
                                </td>
                                <td>{{ $pegawai->tempat_lahir }}</td>
                                <td>{{ $pegawai->tgl_lahir->format('d-m-Y') }}</td>
                                <td>{{ $pegawai->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $pegawai->jabatan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pegawai.edit', $pegawai->id_pegawai) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.pegawai.destroy', $pegawai->id_pegawai) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">Hapus</button>
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

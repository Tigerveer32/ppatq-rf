@extends('layouts.user_type.auth')

@section('title', 'Daftar Santri')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Daftar Santri</h4>
                <a href="{{ route('admin.santri.form') }}" class="btn btn-success">Tambah Santri</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>No Induk</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($santris as $santri)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $santri->no_induk }}</td>
                                <td>
                                    <a href="{{ route('admin.santri.edit', $santri->id_santri) }}">{{ $santri->nama_santri }}</a>
                                </td>
                                <td>{{ $santri->nik }}</td>
                                <td>{{ $santri->tempat_lahir }}</td>
                                <td>{{ $santri->tgl_lahir->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.santri.edit', $santri->id_santri) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.santri.destroy', $santri->id_santri) }}" method="POST" style="display:inline-block;">
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

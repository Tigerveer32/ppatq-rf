@extends('layouts.user_type.auth')

@section('title', 'Daftar Santri Kelompok Murobby')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Daftar Santri Kelompok: {{ $murobby->nama_kamar }}</h4>
                <a href="{{ route('admin.santri_murobby.create', $murobby->id_murobby) }}" class="btn btn-success btn-sm float-right">Tambah Santri</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>No Induk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($santris as $santri)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $santri->santri->nama_santri }}</td>
                            <td>{{ $santri->santri->no_induk }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.santri_murobby.edit', [$murobby->id_murobby, $santri->id_santri]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.santri_murobby.destroy', [$murobby->id_murobby, $santri->id_santri]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus santri ini?')">Hapus</button>
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

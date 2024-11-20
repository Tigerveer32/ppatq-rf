@extends('layouts.user_type.auth')

@section('title', 'Daftar Murobby')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Daftar Murobby</h4>
                <a href="{{ route('admin.murobby.form') }}" class="btn btn-success">Tambah Murobby</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Murobby</th>
                            <th>Nama Kamar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($murobbies as $murobby)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <!-- Tambahkan link ke halaman kelompok_murobby -->
                                    <a href="{{ route('admin.santri_murobby.indexSantri', $murobby->id_murobby) }}">
                                        {{ optional($murobby->pegawai)->nama_pegawai }}
                                    </a>
                                </td>
                                <td>{{ $murobby->nama_kamar }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.murobby.edit', $murobby->id_murobby) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.murobby.destroy', $murobby->id_murobby) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus murobby ini?')">Hapus</button>
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

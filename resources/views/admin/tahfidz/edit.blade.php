@extends('layouts.user_type.auth')

@section('title', 'Edit Tahfidz')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Edit Tahfidz</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.tahfidz.update', $tahfidz->id_tahfidz) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_tahfidz">Nama Tahfidz</label>
                        <input type="text" name="nama_tahfidz" class="form-control" value="{{ old('nama_tahfidz', $tahfidz->nama_tahfidz) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="id_pegawai">Ustadz (Pegawai)</label>
                        <select name="id_pegawai" class="form-control" required>
                            <option value="">Pilih Ustadz</option>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id_pegawai }}" {{ old('id_pegawai', $tahfidz->id_pegawai) == $pegawai->id_pegawai ? 'selected' : '' }}>
                                    {{ $pegawai->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

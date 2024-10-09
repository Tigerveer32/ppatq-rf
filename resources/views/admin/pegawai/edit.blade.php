@extends('layouts.user_type.auth')

@section('title', 'Edit Pegawai')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Edit Pegawai</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.pegawai.update', $pegawai->id_pegawai) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_pegawai">ID Pegawai</label>
                        <input type="text" name="id_pegawai" class="form-control" value="{{ old('id_pegawai', $pegawai->id_pegawai) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $pegawai->tgl_lahir) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" class="form-control" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="murobby" {{ old('jabatan', $pegawai->jabatan) == 'murobby' ? 'selected' : '' }}>Murobby</option>
                            <option value="tahfidz" {{ old('jabatan', $pegawai->jabatan) == 'tahfidz' ? 'selected' : '' }}>Tahfidz</option>
                            <option value="pembina" {{ old('jabatan', $pegawai->jabatan) == 'pembina' ? 'selected' : '' }}>Pembina</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ old('alamat', $pegawai->alamat) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan_terakhir" class="form-control" value="{{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.user_type.auth')

@section('title', 'Edit Santri')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Edit Santri</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.santri.update', $santri->id_santri) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="no_induk">Nomor Induk</label>
                        <input type="text" name="no_induk" class="form-control" value="{{ old('no_induk', $santri->no_induk) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Santri</label>
                        <input type="text" name="nama_santri" class="form-control" value="{{ old('nama_santri', $santri->nama_santri) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ old('nik', $santri->nik) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $santri->nisn) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="anak_ke">Anak Ke</label>
                        <input type="number" name="anak_ke" class="form-control" value="{{ old('anak_ke', $santri->anak_ke) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $santri->tempat_lahir) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $santri->tgl_lahir) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ old('alamat', $santri->alamat) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $santri->provinsi) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" name="kota" class="form-control" value="{{ old('kota', $santri->kota) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $santri->kecamatan) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan', $santri->kelurahan) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $santri->kode_pos) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $santri->no_hp) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="status_santri">Status Santri</label>
                        <select name="status_santri" class="form-control" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ old('status_santri', $santri->status_santri) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="alumni" {{ old('status_santri', $santri->status_santri) == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                        <input type="text" name="no_kk" class="form-control" value="{{ old('no_kk', $santri->no_kk) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $santri->nama_ayah) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="pendidikan_ayah">Pendidikan Ayah</label>
                        <input type="text" name="pendidikan_ayah" class="form-control" value="{{ old('pendidikan_ayah', $santri->pendidikan_ayah) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $santri->pekerjaan_ayah) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $santri->nama_ibu) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="pendidikan_ibu">Pendidikan Ibu</label>
                        <input type="text" name="pendidikan_ibu" class="form-control" value="{{ old('pendidikan_ibu', $santri->pendidikan_ibu) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $santri->pekerjaan_ibu) }}" placeholder="Opsional">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

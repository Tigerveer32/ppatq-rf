@extends('layouts.user_type.auth')

@section('title', 'Tambah Santri')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Tambah Santri</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.santri.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="no_induk">Nomor Induk</label>
                        <input type="text" name="no_induk" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Santri</label>
                        <input type="text" name="nama_santri" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" name="nisn" class="form-control" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="anak_ke">Anak Ke</label>
                        <input type="number" name="anak_ke" class="form-control" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" name="kota" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" name="kelurahan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="status_santri">Status Santri</label>
                        <select name="status_santri" class="form-control" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="alumni">Alumni</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                        <input type="text" name="no_kk" class="form-control" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="pendidikan_ayah">Pendidikan Ayah</label>
                        <input type="text" name="pendidikan_ayah" class="form-control" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="pendidikan_ibu">Pendidikan Ibu</label>
                        <input type="text" name="pendidikan_ibu" class="form-control" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control" placeholder="Opsional">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

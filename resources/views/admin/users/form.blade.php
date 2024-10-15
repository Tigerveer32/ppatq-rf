@extends('layouts.user_type.auth')

@section('title', 'Tambah User')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Form Tambah User</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="location">Lokasi</label>
                        <input type="text" name="location" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="about_me">Tentang Saya</label>
                        <textarea name="about_me" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="pembina">Pembina</option>
                            <option value="tahfidz">Tahfidz</option>
                            <option value="murobby">Murobby</option>
                            <option value="walsan">Wali Santri</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pegawai_id">Pegawai</label>
                        <select name="pegawai_id" class="form-control">
                            <option value="">Pilih Pegawai</option>
                            @foreach($Pegawai as $pegawai)
                                <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="santri_id">Santri</label>
                        <select name="santri_id" class="form-control">
                            <option value="">Pilih Santri</option>
                            @foreach($santris as $santri)
                                <option value="{{ $santri->id_santri }}">{{ $santri->nama_santri }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

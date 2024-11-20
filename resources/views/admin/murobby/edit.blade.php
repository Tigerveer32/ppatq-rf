@extends('layouts.user_type.auth')

@section('title', 'Edit Kelompok Murobby')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Edit Kelompok Murobby</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.murobby.update', $murobbies->id_murobby) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT request -->

                    <div class="form-group">
                        <label for="nama_kamar">Nama Murobby</label>
                        <input type="text" name="nama_kamar" class="form-control" value="{{ old('nama_kamar', $murobbies->nama_kamar) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="id_pegawai">Ustadz (Pegawai)</label>
                        <select name="id_pegawai" class="form-control" required>
                            <option value="">Pilih Ustadz</option>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id_pegawai }}" 
                                    @if($pegawai->id_pegawai == $murobbies->id_pegawai) selected @endif>
                                    {{ $pegawai->nama_pegawai }}
                                </option>
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

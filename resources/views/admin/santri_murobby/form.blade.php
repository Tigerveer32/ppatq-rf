@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h1>Tambah Santri ke Kelompok Murobby - {{ $murobby->nama_kamar }}</h1>

    <form action="{{ route('admin.santri_murobby.store', $murobby->id_murobby) }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="id_santri">Pilih Santri</label>
            <select name="id_santri" id="id_santri" class="form-control" required>
                <option value="">Pilih Santri</option>
                @foreach($santris as $santri)
                    <option value="{{ $santri->id_santri }}">{{ $santri->nama_santri }}</option>
                @endforeach
            </select>
            @error('id_santri')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tambah Santri</button>
        <a href="{{ route('admin.santri_murobby.indexSantri', $murobby->id_murobby) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

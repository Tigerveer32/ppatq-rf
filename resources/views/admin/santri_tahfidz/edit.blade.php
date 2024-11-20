@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h1>Edit Santri di Kelompok Tahfidz - {{ $tahfidz->nama_tahfidz }}</h1>

    <form action="{{ route('update', ['id_tahfidz' => $tahfidz->id_tahfidz, 'id' => $santriTahfidz->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menambahkan method PUT untuk melakukan update data -->

        <div class="form-group">
            <label for="id_santri">Pilih Santri</label>
            <select name="id_santri" id="id_santri" class="form-control" required>
                <option value="">Pilih Santri</option>
                @foreach($santris as $santri)
                    <option value="{{ $santri->id_santri }}" 
                        {{ $santri->id_santri == $santriTahfidz->id_santri ? 'selected' : '' }}>
                        {{ $santri->nama_santri }}
                    </option>
                @endforeach
            </select>
            @error('id_santri')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Santri</button>
        <a href="{{ route('admin.santri_tahfidz.indexSantri', $tahfidz->id_tahfidz) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

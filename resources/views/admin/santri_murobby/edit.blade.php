@extends('layouts.user_type.auth')

@section('title', 'Edit Santri Kelompok Murobby')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Edit Santri Kelompok: {{ $murobby->nama_kamar }}</h4>
                <a href="{{ route('admin.santri_murobby.indexSantri', $murobby->id_murobby) }}" class="btn btn-default btn-sm float-right">Kembali</a>
            </div>
            <div class="box-body">
            <form action="{{ route('admin.santri_murobby.update', [$murobby->id_murobby, $santriMurobby->id_santri]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_santri">Santri</label>
                    <select name="id_santri" id="id_santri" class="form-control">
                        @foreach($santris as $santri)
                            <option value="{{ $santri->id_santri }}" {{ $santri->id_santri == $santriMurobby->id_santri ? 'selected' : '' }}>
                                {{ $santri->nama_santri }} (No Induk: {{ $santri->no_induk }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Santri</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

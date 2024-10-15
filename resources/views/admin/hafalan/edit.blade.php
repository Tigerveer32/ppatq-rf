@extends('layouts.user_type.auth')

@section('title', 'Edit Hafalan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Edit Hafalan</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.hafalan.update', $hafalan->id_hafalan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="santri_id">Nama Santri:</label>
                        <select name="santri_id" id="santri_id" class="form-control" required>
                            @foreach ($santris as $santri)
                                <option value="{{ $santri->id_santri }}" {{ $hafalan->id_santri == $santri->id_santri ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ayat">Ayat:</label>
                        <input type="text" name="ayat" id="ayat" class="form-control" value="{{ $hafalan->ayat }}" required>
                    </div>

                    <div class="form-group">
                        <label for="surat">Surat:</label>
                        <input type="text" name="surat" id="surat" class="form-control" value="{{ $hafalan->surat }}" required>
                    </div>

                    <div class="form-group">
                        <label for="juz">Juz:</label>
                        <input type="text" name="juz" id="juz" class="form-control" value="{{ $hafalan->juz }}" required>
                    </div>

                    <div class="form-group">
                        <label for="bulan">Bulan:</label>
                        <select name="bulan" id="bulan" class="form-control" required>
                            @foreach (range(1, 12) as $month)
                                <option value="{{ sprintf('%02d', $month) }}" {{ $hafalan->bulan == sprintf('%02d', $month) ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun:</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $hafalan->tahun }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Hafalan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

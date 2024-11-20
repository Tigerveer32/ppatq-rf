@extends('layouts.user_type.tahfidz')

@section('title', 'Tambah Target Hafalan')

@section('content')
<div class="container">
    <h1>Tambah Target Hafalan</h1>

    <!-- Menampilkan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk menambahkan target hafalan -->
    <form action="{{ route('tahfidz.target.store') }}" method="POST">
        @csrf
        <!-- Pilih Santri -->
        <div class="form-group">
            <label for="id_santri">Santri:</label>
            <select name="id_santri" id="id_santri" class="form-control" required>
                <option value="">Pilih Santri</option>
                @foreach ($santris as $santri)
                    <option value="{{ $santri->id_santri }}">{{ $santri->nama_santri }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Target Hafalan -->
        <div class="form-group">
            <label for="id_target">Target Hafalan:</label>
            <select name="id_target" id="id_target" class="form-control" required>
                <option value="">Pilih Target</option>
                @foreach ($kodeJuz as $juz)
                    <option value="{{ $juz->id }}">{{ $juz->nama_surah }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input Bulan -->
        <div class="form-group">
            <label for="bulan">Bulan:</label>
            <select name="bulan" id="bulan" class="form-control" required>
                @foreach (range(1, 12) as $month)
                    <option value="{{ sprintf('%02d', $month) }}">
                        {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input Tahun -->
        <div class="form-group">
            <label for="tahun">Tahun:</label>
            <select name="tahun" id="tahun" class="form-control" required>
                @foreach (range(date('Y'), 2020) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection

@extends('layouts.user_type.tahfidz')

@section('title', 'Tambah Hafalan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Tambah Hafalan - Kelompok Tahfidz: {{ $tahfidz->nama_tahfidz }}</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('tahfidz.tahfidz.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Pilih Santri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_santri">Nama Santri:</label>
                                <select name="id_santri" id="id_santri" class="form-control" required>
                                    <option value="">Pilih Santri</option>
                                    @foreach ($santris as $santri)
                                        <option value="{{ $santri->id_santri }}" 
                                            {{ old('id_santri') == $santri->id_santri ? 'selected' : '' }}>
                                            {{ $santri->nama_santri }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Input Ayat -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayat">Ayat:</label>
                                <input type="text" name="ayat" id="ayat" class="form-control" placeholder="Masukkan ayat" value="{{ old('ayat') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Input Surat -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surat">Surat:</label>
                                <input type="text" name="surat" id="surat" class="form-control" placeholder="Masukkan surat" value="{{ old('surat') }}" required>
                            </div>
                        </div>

                        <!-- Input Juz -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="juz">Juz:</label>
                                <input type="number" name="juz" id="juz" class="form-control" placeholder="Masukkan juz" value="{{ old('juz') }}" min="1" max="30" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Input Bulan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bulan">Bulan:</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ sprintf('%02d', $month) }}" 
                                            {{ old('bulan') == sprintf('%02d', $month) ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Input Tahun -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun">Tahun:</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    @foreach (range(date('Y'), 2020) as $year)
                                        <option value="{{ $year }}" 
                                            {{ old('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Simpan Hafalan</button>
                            <a href="{{ route('tahfidz.tahfidz.hafalan') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

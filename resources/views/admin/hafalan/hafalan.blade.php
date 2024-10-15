@extends('layouts.user_type.auth')

@section('title', 'Daftar Hafalan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Daftar Hafalan - Kelompok Tahfidz: {{ $tahfidz->nama_tahfidz }}</h4>
            </div>
            <div class="box-body">
                <!-- Form untuk Filter Bulan -->
                <form action="{{ route('admin.hafalan.hafalan', $tahfidz->id_tahfidz) }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bulan">Filter Bulan:</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ sprintf('%02d', $month) }}" 
                                            {{ $selectedBulan == sprintf('%02d', $month) ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahun">Filter Tahun:</label>
                                <select name="tahun" id="tahun" class="form-control">
                                    @foreach (range(date('Y'), 2020) as $year)
                                        <option value="{{ $year }}" {{ $selectedTahun == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>

                        <div class="col-md-4 text-right">
                            <div class="form-group mt-4">
                                <a href="{{ route('admin.hafalan.form', $tahfidz->id_tahfidz) }}" class="btn btn-success">
                                    Tambah Hafalan
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Table Daftar Hafalan -->
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Santri</th>
                            <th>Ayat</th>
                            <th>Surat</th>
                            <th>Juz</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($hafalans->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data hafalan untuk bulan yang dipilih.</td>
                            </tr>
                        @else
                            @foreach ($hafalans as $hafalan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hafalan->santri->nama_santri }}</td>
                                    <td>{{ $hafalan->ayat }}</td>
                                    <td>{{ $hafalan->surat }}</td>
                                    <td>{{ $hafalan->juz }}</td>
                                    <td>{{ $hafalan->bulan }}</td>
                                    <td>{{ $hafalan->tahun }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.hafalan.edit', $hafalan->id_hafalan) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.hafalan.destroy', $hafalan->id_hafalan) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hafalan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

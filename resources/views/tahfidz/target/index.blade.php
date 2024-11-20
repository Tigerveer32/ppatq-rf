@extends('layouts.user_type.tahfidz')

@section('title', 'Target Hafalan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4>Target Hafalan - Kelompok Tahfidz: {{ $tahfidz->nama_tahfidz }}</h4>
            </div>
            <div class="box-body">
                <!-- Form untuk Filter Bulan dan Tahun (Optional) -->
                <form action="{{ route('tahfidz.target.index') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bulan">Filter Bulan:</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ sprintf('%02d', $month) }}" 
                                            {{ request()->bulan == sprintf('%02d', $month) ? 'selected' : '' }}>
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
                                        <option value="{{ $year }}" 
                                            {{ request()->tahun == $year ? 'selected' : '' }}>
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
                                <a href="{{ route('tahfidz.target.form') }}" class="btn btn-success">
                                    Tambah Target Hafalan
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Table Daftar Target Hafalan -->
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Santri</th>
                            <th>Target Hafalan</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Tanggal Ditetapkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($targetHafalans->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada target hafalan untuk santri di kelompok tahfidz ini.</td>
                            </tr>
                        @else
                            @foreach ($targetHafalans as $index => $targetHafalan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $targetHafalan->santri->nama_santri }}</td>
                                    <td>
                                        {{ $targetHafalan->kodeJuz->kode }} - {{ $targetHafalan->kodeJuz->nama_surah }}
                                    </td>
                                    <td>{{ $targetHafalan->bulan}}</td>
                                    <td>
                                        {{ $targetHafalan->tahun }} 
                                    </td>
                                    <td>{{ $targetHafalan->created_at->format('d M Y') }}</td>
                                    <td>
                                        <!-- Form untuk Hapus -->
                                        <form action="{{ route('tahfidz.target.destroy', $targetHafalan->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus target hafalan ini?')">Hapus</button>
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

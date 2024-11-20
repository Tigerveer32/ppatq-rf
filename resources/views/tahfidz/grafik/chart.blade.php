@extends('layouts.user_type.tahfidz')

@section('title', 'Grafik Hafalan')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Grafik Target Hafalan</h1>

    <!-- Form Filter -->
    <form action="{{ route('tahfidz.grafik.chart') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-5">
                <label for="bulan">Bulan:</label>
                <select name="bulan" id="bulan" class="form-control">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $selectedBulan == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-5">
                <label for="tahun">Tahun:</label>
                <select name="tahun" id="tahun" class="form-control">
                    @for ($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ $selectedTahun == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Grafik -->
    <div class="card">
        <div class="card-body">
            {!! $chart->container() !!}
        </div>
    </div>
</div>

<!-- LarapexChart Script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{{ $chart->script() }}
@endsection

@extends('layouts.user_type.santri')

@section('title', 'Dashboard Santri')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 text-center mb-4">
            <h1>Dashboard Santri</h1>
            <p>Selamat datang, {{ auth()->user()->name }}!</p>
        </div>
    </div>
    <div class="row">
        <!-- Jumlah Hafalan -->
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Hafalan</h5>
                    
                </div>
            </div>
        </div>

        <!-- Jadwal -->
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Jadwal Hari Ini</h5>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Status Pembayaran</h5>
                </div>
            </div>
        </div>

        <!-- Perilaku -->
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Poin Perilaku</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Hafalan -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Grafik Perkembangan Hafalan</div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection

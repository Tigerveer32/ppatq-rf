@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Pengeluaran Abid Yusra Al Musyaffa Subhiyarsono</h3>
                <h4> Bulan Desember</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Jumlah (Rp)</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluarans as $index => $pengeluaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td> <!-- Menambahkan nomor urut -->
                                    <td>{{ $pengeluaran['tanggal'] }}</td>
                                    <td>{{ number_format($pengeluaran['jumlah'], 0, ',', '.') }}</td>
                                    <td>{{ $pengeluaran['keterangan'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

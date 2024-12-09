@extends('layouts.user_type.santri')

@section('content')
    <div class="container">
        <h1>Detail Pembayaran Santri: {{ $santri->name }}</h1>
        
        <h3>Status: {{ $pembayaran->status }}</h3>
        <p><strong>Metode Pembayaran:</strong> {{ $pembayaran->payment_method }}</p>
        <p><strong>Total Bayar:</strong> {{ $pembayaran->total_bayar }}</p>

        <h4>Detail Pembayaran</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>SPP</th>
                    <th>Uang Saku</th>
                    <th>Infaq</th>
                    <th>Cicilan Daftar Ulang</th>
                    <th>Zarkasi</th>
                    <th>Pelunasan Zarkasi</th>
                    <th>Saku Zarkasi</th>
                    <th>Ujian</th>
                    <th>Arwahan</th>
                    <th>Lain Lain</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran_detail as $detail)
                    <tr>
                        <td>{{ $detail->spp }}</td>
                        <td>{{ $detail->uang_saku }}</td>
                        <td>{{ $detail->infaq }}</td>
                        <td>{{ $detail->cicilan_DaftarUlang }}</td>
                        <td>{{ $detail->Zarkasi }}</td>
                        <td>{{ $detail->Pelunasan_Zarkasi }}</td>
                        <td>{{ $detail->saku_zarkasi }}</td>
                        <td>{{ $detail->ujian }}</td>
                        <td>{{ $detail->arwahan }}</td>
                        <td>{{ $detail->lain_lain }}</td>
                        <td>{{ $detail->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

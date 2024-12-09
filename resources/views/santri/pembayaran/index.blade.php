@extends('layouts.user_type.santri')

@section('content')
    <div class="container">
        <h1>Pembayaran Santri: {{ $santri->name }}</h1>
        
        <a href="{{ route('santri.pembayaran.create', $santri->id) }}" class="btn btn-primary">Buat Pembayaran Baru</a>
        
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID Pembayaran</th>
                    <th>Status</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Bayar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->payment_method }}</td>
                        <td>{{ $item->total_bayar }}</td>
                        <td>
                            <a href="{{ route('santri.pembayaran.show', [$santri->id, $item->id]) }}" class="btn btn-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

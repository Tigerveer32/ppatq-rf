@extends('layouts.user_type.santri')

@section('content')
<div class="container">
    <h2>Halaman Checkout Pembayaran Santri</h2>

    <h4>Detail Pembayaran</h4>
    <table class="table table-striped">
        @if($pembayaran_detail->sum('spp') > 0)
        <tr>
            <th>SPP</th>
            <td>{{ number_format($pembayaran_detail->sum('spp'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('uang_saku') > 0)
        <tr>
            <th>Uang Saku</th>
            <td>{{ number_format($pembayaran_detail->sum('uang_saku'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('infaq') > 0)
        <tr>
            <th>Infaq</th>
            <td>{{ number_format($pembayaran_detail->sum('infaq'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('cicilan_DaftarUlang') > 0)
        <tr>
            <th>Cicilan Daftar Ulang</th>
            <td>{{ number_format($pembayaran_detail->sum('cicilan_DaftarUlang'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('Zarkasi') > 0)
        <tr>
            <th>Zarkasi</th>
            <td>{{ number_format($pembayaran_detail->sum('Zarkasi'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('Pelunasan_Zarkasi') > 0)
        <tr>
            <th>Pelunasan Zarkasi</th>
            <td>{{ number_format($pembayaran_detail->sum('Pelunasan_Zarkasi'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('saku_zarkasi') > 0)
        <tr>
            <th>Saku Zarkasi</th>
            <td>{{ number_format($pembayaran_detail->sum('saku_zarkasi'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('ujian') > 0)
        <tr>
            <th>Ujian</th>
            <td>{{ number_format($pembayaran_detail->sum('ujian'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('arwahan') > 0)
        <tr>
            <th>Arwahan</th>
            <td>{{ number_format($pembayaran_detail->sum('arwahan'), 0, ',', '.') }}</td>
        </tr>
        @endif

        @if($pembayaran_detail->sum('lain_lain') > 0)
        <tr>
            <th>Lain-lain</th>
            <td>{{ number_format($pembayaran_detail->sum('lain_lain'), 0, ',', '.') }}</td>
        </tr>
        @endif

        <tr>
            <th>Total Bayar</th>
            <td>{{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h4>Metode Pembayaran</h4>
    <p>Silakan pilih metode pembayaran berikut untuk melanjutkan pembayaran menggunakan Midtrans.</p>

    <button type="button" class="btn btn-primary"  id="pay-button">Bayar dengan Midtrans</button>
    <!-- <form action="{{ route('santri.pembayaran.snap_token') }}" method="POST">
        @csrf
        <input type="hidden" name="snap_token" value="{{ $pembayaran->snap_token }}">
        <button type="submit" class="btn btn-primary">Bayar dengan Midtrans</button>
    </form> -->
</div>

@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.clientKey')}}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{$pembayaran->snap_token}}', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
@endsection

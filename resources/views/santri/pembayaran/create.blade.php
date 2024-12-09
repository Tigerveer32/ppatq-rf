@extends('layouts.user_type.santri')

@section('content')
    <div class="container">
        <h1>Buat Pembayaran Baru untuk Santri: {{ $santri->name }}</h1>

        <form action="{{ route('santri.pembayaran.store', $santri->id) }}" method="POST" id="payment-form">
            @csrf

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <h4>Rincian Pembayaran</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Jenis Pembayaran</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SPP</td>
                                <td><input type="number" name="spp" id="spp" class="form-control" value="0" required></td>
                            </tr>
                            <tr>
                                <td>Uang Saku</td>
                                <td><input type="number" name="uang_saku" id="uang_saku" class="form-control" value="0" required></td>
                            </tr>
                            <tr>
                                <td>Infaq</td>
                                <td><input type="number" name="infaq" id="infaq" class="form-control" value="0" required></td>
                            </tr>
                            <tr>
                                <td>Cicilan Daftar Ulang</td>
                                <td><input type="number" name="cicilan_daftar_ulang" id="cicilan_daftar_ulang" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Daftar Ulang</td>
                                <td><input type="number" name="daftar_ulang" id="daftar_ulang" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Zarkasi</td>
                                <td><input type="number" name="zarkasi" id="zarkasi" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Pelunasan Zarkasi</td>
                                <td><input type="number" name="pelunasan_zarkasi" id="pelunasan_zarkasi" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Saku Zarkasi</td>
                                <td><input type="number" name="saku_zarkasi" id="saku_zarkasi" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Ujian</td>
                                <td><input type="number" name="ujian" id="ujian" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Arwahan</td>
                                <td><input type="number" name="arwahan" id="arwahan" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Lain-lain</td>
                                <td><input type="number" name="lain_lain" id="lain_lain" class="form-control" value="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <h4>Total Pembayaran</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><input type="text" id="total" class="form-control" readonly></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-group">
                        <select name="payment_method" id="payment_method" class="form-control" required style="display: none;">
                            <option value="online" selected>Online</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                    </div>

                    <input type="hidden" name="total_pembayaran" id="total_pembayaran">

                    <button type="submit" class="btn btn-success mt-3"> Bayar</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.clientKey')}}"></script>
    <script>
        // Ambil elemen input dan total
        const fields = document.querySelectorAll('#spp, #uang_saku, #infaq, #cicilan_daftar_ulang, #daftar_ulang, #zarkasi, #pelunasan_zarkasi, #saku_zarkasi, #ujian, #arwahan, #lain_lain');
        const totalField = document.getElementById('total');
        const totalPembayaranField = document.getElementById('total_pembayaran');

        // Fungsi untuk menghitung total pembayaran
        function calculateTotal() {
            let total = 0;
            fields.forEach(field => {
                total += parseFloat(field.value) || 0;  // Menambahkan nilai dari setiap inputan (default 0 jika tidak ada nilai)
            });
            totalField.value = total;  // Menampilkan total pembayaran
            totalPembayaranField.value = total;  // Menyimpan total pembayaran ke input tersembunyi
        }

        // Menambahkan event listener untuk setiap inputan
        fields.forEach(field => {
            field.addEventListener('input', calculateTotal);  // Menghitung total ketika ada perubahan nilai
        });

        // Menghitung total saat pertama kali halaman dimuat
        calculateTotal();
    </script>
@endsection

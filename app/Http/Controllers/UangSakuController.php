<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UangSakuController extends Controller
{
    public function index()
    {
        $pengeluarans = [
            ['tanggal' => '2024-12-01', 'jumlah' => 50000, 'keterangan' => 'Pembelian Buku'],
            ['tanggal' => '2024-12-02', 'jumlah' => 10000, 'keterangan' => 'Uang Jajan'],
            ['tanggal' => '2024-12-03', 'jumlah' => 20000, 'keterangan' => 'Makan'],
            ['tanggal' => '2024-12-04', 'jumlah' => 15000, 'keterangan' => 'sabun mandi dan sampo'],
            ['tanggal' => '2024-12-05', 'jumlah' => 10000, 'keterangan' => 'Uang Jajan'],
            ['tanggal' => '2024-12-06', 'jumlah' => 10000, 'keterangan' => 'Uang Jajan'],
            ['tanggal' => '2024-12-07', 'jumlah' => 10000, 'keterangan' => 'Uang Jajan'],
            // Tambahkan lebih banyak data uang jajan jika diperlukan
        ];

        return view('uang_saku.index', compact('pengeluarans'));
    }
}

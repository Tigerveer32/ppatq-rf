<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranDetail extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_detail';

    protected $fillable = [
        'id_pembayaran', 
        'spp',
        'uang_saku',
        'infaq',
        'cicilan_daftar_ulang',
        'daftar_ulang',
        'zarkasi',
        'pelunasan_zarkasi',
        'saku_zarkasi',
        'ujian',
        'arwahan',
        'lain_lain',
        'keterangan',
    ];

    /**
     * Relasi ke tabel pembayaran.
     */
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}

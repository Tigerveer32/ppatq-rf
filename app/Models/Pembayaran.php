<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    
    protected $fillable = [
        'status', 
        'snap_token', 
        'id_santri', 
        'payment_method', 
        'total_bayar',
    ];

    /**
     * Relasi ke tabel santri.
     */
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri', 'id_santri');
    }

    /**
     * Relasi ke tabel pembayaran_detail.
     */
    public function detailPembayaran()
    {
        return $this->hasMany(PembayaranDetail::class, 'id_pembayaran');
    }
}

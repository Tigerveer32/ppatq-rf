<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\santri;
use App\Models\tahfidz;

class Hafalan extends Model
{
    use HasFactory;

    protected $table = 'hafalan'; // Nama tabel di database

    protected $primaryKey = 'id_hafalan'; // Primary key tabel

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_santri',
        'id_tahfidz',
        'ayat',
        'surat',
        'juz',
        'bulan',
        'tahun'
    ];

    /**
     * Relasi dengan model Santri.
     * Setiap hafalan dimiliki oleh seorang santri.
     */
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri', 'id_santri');
    }

    /**
     * Relasi dengan model Tahfidz.
     * Setiap hafalan terkait dengan salah satu tahfidz.
     */
    public function tahfidz()
    {
        return $this->belongsTo(Tahfidz::class, 'id_tahfidz', 'id_tahfidz');
    }
}

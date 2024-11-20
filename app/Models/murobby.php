<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class murobby extends Model
{
    use HasFactory;

    protected $table = 'murobby';
    protected $primaryKey = 'id_murobby';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'id_pegawai', // ID Pegawai (Guru)
        'nama_kamar' // Nama Tahfidz
    ];

    // Relasi ke model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}

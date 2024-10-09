<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahfidz extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model
    protected $table = 'tahfidz';
    protected $primaryKey = 'id_tahfidz';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'id_pegawai', // ID Pegawai (Guru)
        'id_santri',  // ID Santri
        'nama_tahfidz' // Nama Tahfidz
    ];

    // Relasi dengan model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(pegawai::class, 'id_pegawai', 'id_pegawai');
    }

}

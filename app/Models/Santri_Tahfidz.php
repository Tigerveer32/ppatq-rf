<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\santri;
use App\Models\tahfidz;

class Santri_Tahfidz extends Model
{
    use HasFactory;

    protected $table = 'santri_tahfidz'; // Nama tabel di database

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_santri',
        'id_tahfidz',
        'id_pegawai',
        'created_at',
        'updated_at'
    ];

    // Relasi ke model Santri
    public function santri()
    {
        return $this->belongsTo(santri::class, 'id_santri', 'id_santri');
    }

    // Relasi ke model Tahfidz
    public function tahfidz()
    {
        return $this->belongsTo(tahfidz::class, 'id_tahfidz', 'id_tahfidz');
    }

    // Relasi ke model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}

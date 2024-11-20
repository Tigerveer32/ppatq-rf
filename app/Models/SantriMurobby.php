<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantriMurobby extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dari nama model
    protected $table = 'santri_murobby';

    // Menentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = ['id_murobby', 'id_santri'];

    // Relasi dengan model Murobby
    public function murobby()
    {
        return $this->belongsTo(murobby::class, 'id_murobby','id_murobby');
    }

    // Relasi dengan model Santri
    public function santri()
    {
        return $this->belongsTo(santri::class, 'id_santri','id_santri');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetHafalan extends Model
{
    use HasFactory;

    protected $table = 'target_hafalan';

    protected $fillable = [
        'id_tahfidz',
        'id_santri',
        'id_target',
        'bulan',
        'tahun',
    ];

    /**
     * Relasi dengan model Tahfidz
     */
    public function tahfidz()
    {
        return $this->belongsTo(tahfidz::class, 'id_tahfidz','id_tahfidz');
    }

    /**
     * Relasi dengan model Santri
     */
    public function santri()
    {
        return $this->belongsTo(santri::class, 'id_santri','id_santri');
    }

    /**
     * Relasi dengan model Target
     */
    public function kodeJuz()
    {
        return $this->belongsTo(KodeJuz::class, 'id_target');
    }
}
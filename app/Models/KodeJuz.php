<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeJuz extends Model
{
    use HasFactory;

    protected $table = 'kode_juz';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'kode_surah',
        'nama_surah',
    ];
}

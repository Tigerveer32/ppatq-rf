<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai'; // Nama tabel
    protected $primaryKey = 'id_pegawai'; // Primary key

    protected $fillable = [
        'nama_pegawai',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'jabatan',
        'alamat',
        'pendidikan_terakhir',
    ];

    protected $casts = [
        'tgl_lahir' => 'datetime:d/m/Y', // Format dd/mm/yyyy
    ];    
}

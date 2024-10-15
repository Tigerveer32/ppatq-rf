<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class santri extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'santri';

    // Primary key
    protected $primaryKey = 'id_santri';

    // Field yang bisa diisi secara massal
    protected $fillable = [
        'no_induk',
        'nama_santri',
        'nik',
        'nisn',
        'anak_ke',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'no_hp',
        'status_santri',
        'no_kk',
        'nama_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
    ];

       protected $casts = [
        'tgl_lahir' => 'datetime:d/m/Y', // Format dd/mm/yyyy
    ];
    public $timestamps = true;

    public function santriTahfidz()
    {
        return $this->hasMany(Santri_Tahfidz::class, 'id_santri');
    }

}

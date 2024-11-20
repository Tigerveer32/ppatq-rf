<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
        'role',
        'pegawai_id',
        'santri_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class, 'pegawai_id', 'id_pegawai'); // Pastikan sesuai dengan nama model dan kolom
    }

    public function santri()
    {
        return $this->belongsTo(santri::class, 'santri_id', 'id_santri'); // Pastikan sesuai dengan nama model dan kolom
    }
}

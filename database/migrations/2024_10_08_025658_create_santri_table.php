<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id('id_santri'); // Primary key
            $table->string('no_induk')->unique(); // Nomor Induk
            $table->string('nama_santri');
            $table->string('nik', 16)->unique(); // NIK
            $table->string('nisn')->nullable(); // NISN
            $table->integer('anak_ke')->nullable(); // Anak ke
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']); // Laki-laki atau Perempuan
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('kode_pos');
            $table->string('no_hp')->nullable(); // No HP
            $table->enum('status_santri', ['aktif', 'alumni']); // Status: Aktif atau Alumni
            $table->string('no_kk')->nullable(); // Nomor Kartu Keluarga
            $table->string('nama_ayah');
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu');
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();

            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};

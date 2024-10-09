<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class tahfidz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahfidz', function (Blueprint $table) {
            $table->id('id_tahfidz'); // ID Tahfidz
            $table->unsignedBigInteger('id_pegawai'); // ID Pegawai (Guru)
            $table->unsignedBigInteger('id_santri'); // ID Santri
            $table->string('nama_tahfidz'); // Nama Tahfidz
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key constraints (pastikan tabel pegawai dan santri sudah ada)
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
            $table->foreign('id_santri')->references('id_santri')->on('santri')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahfidz');
    }
}

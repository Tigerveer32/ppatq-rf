<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SantriTahfidz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri_tahfidz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_tahfidz');
            $table->unsignedBigInteger('id_pegawai');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_santri')->references('id_santri')->on('santri')->onDelete('cascade');
            $table->foreign('id_tahfidz')->references('id_tahfidz')->on('tahfidz')->onDelete('cascade');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santri_tahfidz');
    }
}

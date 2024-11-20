<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('murobby', function (Blueprint $table) {
            $table->id('id_murobby'); // Kolom id_murobby
            $table->unsignedBigInteger('id_pegawai'); // Kolom id_pegawai
            $table->timestamps(); // Kolom created_at dan updated_at
            
            // Menambahkan foreign key untuk id_pegawai yang merujuk ke tabel pegawai
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('murobby');
    }
};

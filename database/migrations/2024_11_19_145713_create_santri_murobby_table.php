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
        Schema::create('santri_murobby', function (Blueprint $table) {
            $table->id(); // Kolom id (auto increment)
            $table->unsignedBigInteger('id_murobby'); // Kolom id_murobby (referensi ke tabel murobby)
            $table->unsignedBigInteger('id_santri'); // Kolom id_santri (referensi ke tabel santri)
            $table->timestamps(); // Kolom created_at dan updated_at

            // Tambahkan foreign key constraints
            $table->foreign('id_murobby')->references('id_murobby')->on('murobby')->onDelete('cascade');
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
        Schema::dropIfExists('santri_murobby');
    }
};

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
        Schema::create('kode_juz', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('kode_surah', 10)->unique(); // Kolom kode_surah dengan panjang maksimal 10 karakter
            $table->string('nama_surah'); // Kolom nama_surah
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kode_juz');
    }
};

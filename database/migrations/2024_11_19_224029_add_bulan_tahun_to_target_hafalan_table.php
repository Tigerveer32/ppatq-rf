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
        Schema::table('target_hafalan', function (Blueprint $table) {
            // Menambahkan kolom bulan dan tahun
            $table->string('bulan', 2)->nullable()->after('id_target'); // Kolom bulan (2 karakter)
            $table->year('tahun')->nullable()->after('bulan'); // Kolom tahun
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('target_hafalan', function (Blueprint $table) {
            // Menghapus kolom bulan dan tahun
            $table->dropColumn(['bulan', 'tahun']);
        });
    }
};

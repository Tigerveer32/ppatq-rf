<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hafalan', function (Blueprint $table) {
            $table->string('bulan')->after('juz');  // Menambahkan kolom bulan setelah juz
            $table->string('tahun')->after('bulan'); // Menambahkan kolom tahun setelah bulan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hafalan', function (Blueprint $table) {
            $table->dropColumn(['bulan', 'tahun']); // Menghapus kolom bulan dan tahun saat rollback
        });
    }
};
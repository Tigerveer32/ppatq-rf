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
        Schema::table('santri_tahfidz', function (Blueprint $table) {
            // Hapus foreign key constraint untuk id_pegawai
            $table->dropForeign(['id_pegawai']);
            // Hapus kolom id_pegawai
            $table->dropColumn('id_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('santri_tahfidz', function (Blueprint $table) {
            // Menambahkan kembali kolom id_pegawai jika rollback
            $table->unsignedBigInteger('id_pegawai');

            // Menambahkan kembali foreign key constraint untuk id_pegawai
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->onDelete('cascade');
        });
    }
};

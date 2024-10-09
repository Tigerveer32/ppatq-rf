<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdSantriFromTahfidzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tahfidz', function (Blueprint $table) {
            // Ganti 'tahfidz_id_santri_foreign' dengan nama foreign key yang sesuai
            $table->dropForeign('tahfidz_id_santri_foreign'); // Menghapus foreign key constraint
            $table->dropColumn('id_santri'); // Menghapus kolom id_santri
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tahfidz', function (Blueprint $table) {
            $table->unsignedBigInteger('id_santri')->after('id_pegawai'); // Menambahkan kembali kolom id_santri jika rollback
            // Jika Anda ingin menambahkan kembali foreign key, lakukan di sini
            // $table->foreign('id_santri')->references('id')->on('santri');
        });
    }
}

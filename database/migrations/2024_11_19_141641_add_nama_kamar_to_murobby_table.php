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
        Schema::table('murobby', function (Blueprint $table) {
            $table->string('nama_kamar')->nullable()->after('id_pegawai'); // Add 'nama_kamar' column
        });
    }

    public function down()
    {
        Schema::table('murobby', function (Blueprint $table) {
            $table->dropColumn('nama_kamar'); // Drop 'nama_kamar' column if rolling back
        });
    }
};

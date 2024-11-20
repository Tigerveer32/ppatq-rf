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
        Schema::table('kode_juz', function (Blueprint $table) {
            $table->renameColumn('kode_surah', 'kode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kode_juz', function (Blueprint $table) {
            $table->renameColumn('kode', 'kode_surah');
        });
    }
};

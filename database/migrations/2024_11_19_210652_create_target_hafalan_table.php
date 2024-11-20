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
        Schema::create('target_hafalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahfidz');
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_target');
            $table->timestamps();

            // Defining foreign keys
            $table->foreign('id_tahfidz')->references('id_tahfidz')->on('tahfidz')->onDelete('cascade');
            $table->foreign('id_santri')->references('id_santri')->on('santri')->onDelete('cascade');
            $table->foreign('id_target')->references('id')->on('kode_juz')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_hafalan');
    }
};

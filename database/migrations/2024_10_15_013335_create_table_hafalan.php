<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHafalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hafalan', function (Blueprint $table) {
            $table->id('id_hafalan');
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_tahfidz');
            $table->string('ayat');
            $table->string('surat');
            $table->string('juz');
            $table->timestamps();

            $table->foreign('id_santri')->references('id_santri')->on('santri');
            $table->foreign('id_tahfidz')->references('id_tahfidz')->on('tahfidz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hafalan');
    }
}
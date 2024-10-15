<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferentialColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('pegawai_id')->nullable()->after('role'); // Menyimpan ID pegawai
            $table->unsignedBigInteger('santri_id')->nullable()->after('pegawai_id'); // Menyimpan ID santri
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pegawai_id');
            $table->dropColumn('santri_id');
        });
    }
}

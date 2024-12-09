<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel pembayaran
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('status'); // Status pembayaran
            $table->string('snap_token')->nullable(); // Token pembayaran (nullable)
            $table->unsignedBigInteger('id_santri'); // Relasi ke tabel santri
            $table->enum('payment_method', ['cash', 'online']); // Metode pembayaran hanya cash atau online
            $table->decimal('total_bayar', 15, 2); // Total pembayaran
            $table->timestamps(); // created_at dan updated_at

            // Relasi
            $table->foreign('id_santri')->references('id_santri')->on('santri')->onDelete('cascade');
        });

        // Tabel pembayaran_detail
        Schema::create('pembayaran_detail', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('id_pembayaran'); // Relasi ke tabel pembayaran
            $table->decimal('spp', 15, 2)->nullable(); // SPP
            $table->decimal('uang_saku', 15, 2)->nullable(); // Uang Saku
            $table->decimal('infaq', 15, 2)->nullable(); // Infaq
            $table->decimal('cicilan_daftar_ulang', 15, 2)->nullable(); // Cicilan Daftar Ulang
            $table->decimal('daftar_ulang', 15, 2)->nullable(); // Daftar Ulang
            $table->decimal('zarkasi', 15, 2)->nullable(); // Zarkasi
            $table->decimal('pelunasan_zarkasi', 15, 2)->nullable(); // Pelunasan Zarkasi
            $table->decimal('saku_zarkasi', 15, 2)->nullable(); // Saku Zarkasi
            $table->decimal('ujian', 15, 2)->nullable(); // Ujian
            $table->decimal('arwahan', 15, 2)->nullable(); // Arwahan
            $table->decimal('lain_lain', 15, 2)->nullable(); // Lain-lain
            $table->text('keterangan')->nullable(); // Keterangan
            $table->timestamps(); // created_at dan updated_at

            // Relasi
            $table->foreign('id_pembayaran')->references('id')->on('pembayaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus tabel
        Schema::dropIfExists('pembayaran_detail');
        Schema::dropIfExists('pembayaran');
    }
};

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
        Schema::create('tbl_trx_barang_pindah_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pindah')->nullable();
            $table->string('kode_pindah')->nullable();
            $table->bigInteger('norut')->nullable();
            $table->bigInteger('id_pindah_sebelumnya')->nullable();
            // pindah
            $table->bigInteger('id_barang')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('lokasi_sebelumnya', 50)->nullable();
            $table->string('lokasi_sekarang', 50)->nullable();
            $table->bigInteger('id_gedung')->length(20)->nullable();
            $table->bigInteger('id_gudang')->length(20)->nullable();
            $table->bigInteger('id_blok')->length(20)->nullable();
            $table->bigInteger('id_lokasi')->length(20)->nullable();
            $table->string('nama_gedung')->nullable();
            $table->string('nama_gudang')->nullable();
            $table->string('nama_blok')->nullable();
            $table->string('nama_lokasi')->nullable();
            $table->bigInteger('stok')->nullable(); // stok yang pindah

            // update TM 5Mei23
            $table->bigInteger('user_id_prodi')->length(20)->nullable();
            $table->string('user_kode_prodi', 50)->nullable();
            $table->string('user_nama_prodi', 150)->nullable();

            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();
            $table->uuid('uid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_trx_barang_pindah_detail');
    }
};

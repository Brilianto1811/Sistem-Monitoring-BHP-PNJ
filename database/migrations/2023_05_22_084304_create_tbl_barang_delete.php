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
        Schema::create('tbl_barang_delete', function (Blueprint $table) {
            $table->id('id_barang_delete');
            $table->bigInteger('id_barang')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('unit', 20)->nullable(); # pcs/batang/lembar/dll..
            $table->bigInteger('stok_awal')->nullable();
            $table->bigInteger('stok_sebelumnya')->nullable();
            $table->bigInteger('stok_sekarang')->nullable();
            $table->string('lokasi_awal', 50)->nullable();
            $table->string('lokasi_sebelumnya', 50)->nullable();
            $table->string('lokasi_sekarang', 50)->nullable();
            $table->string('status_barang', 10)->default('nonaktif'); # nonaktif/aktif

            $table->bigInteger('id_gedung_create')->length(20)->nullable();
            $table->bigInteger('id_gudang_create')->length(20)->nullable();
            $table->bigInteger('id_blok_create')->length(20)->nullable();
            $table->bigInteger('id_lokasi_create')->length(20)->nullable();
            $table->string('nama_gedung_create')->nullable();
            $table->string('nama_gudang_create')->nullable();
            $table->string('nama_blok_create')->nullable();
            $table->string('nama_lokasi_create')->nullable();

            $table->bigInteger('id_gedung_now')->length(20)->nullable();
            $table->bigInteger('id_gudang_now')->length(20)->nullable();
            $table->bigInteger('id_blok_now')->length(20)->nullable();
            $table->bigInteger('id_lokasi_now')->length(20)->nullable();
            $table->string('nama_gedung_now')->nullable();
            $table->string('nama_gudang_now')->nullable();
            $table->string('nama_blok_now')->nullable();
            $table->string('nama_lokasi_now')->nullable();

            $table->bigInteger('id_gedung_old')->length(20)->nullable();
            $table->bigInteger('id_gudang_old')->length(20)->nullable();
            $table->bigInteger('id_blok_old')->length(20)->nullable();
            $table->bigInteger('id_lokasi_old')->length(20)->nullable();
            $table->string('nama_gedung_old')->nullable();
            $table->string('nama_gudang_old')->nullable();
            $table->string('nama_blok_old')->nullable();
            $table->string('nama_lokasi_old')->nullable();

            $table->bigInteger('id_trx_last')->length(20)->nullable();
            $table->string('kode_trx_last')->nullable();
            $table->string('tipe_trx_last')->length(20)->nullable();

            $table->bigInteger('id_trx_move_last')->length(20)->nullable();
            $table->string('kode_trx_move_last')->nullable();

            $table->string('user_create_last')->nullable();
            $table->string('user_update_last')->nullable();
            $table->string('created_at_last')->nullable();
            $table->string('updated_at_last')->nullable();
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
        Schema::dropIfExists('tbl_barang_delete');
    }
};

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
        Schema::create('tbl_permintaan_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_permintaan')->nullable();
            $table->string('kode_permintaan')->nullable();
            $table->bigInteger('norut')->nullable();
            $table->bigInteger('id_pindah_sebelumnya')->nullable();
            $table->bigInteger('id_barang')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('qty')->nullable();
            $table->text('ket')->nullable();
            $table->string('lokasi_sebelumnya', 50)->nullable();
            $table->string('lokasi_sekarang', 50)->nullable();
            $table->bigInteger('id_gedung')->length(20)->nullable();
            $table->bigInteger('id_gudang')->length(20)->nullable();
            $table->bigInteger('id_blok')->length(20)->nullable();
            $table->bigInteger('id_lokasi')->length(20)->nullable();

            $table->uuid('uid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_permintaan_barang_detail');
    }
};

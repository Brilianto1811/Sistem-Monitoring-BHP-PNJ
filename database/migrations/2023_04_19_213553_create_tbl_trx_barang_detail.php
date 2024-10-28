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
        Schema::create('tbl_trx_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_trx')->nullable();
            $table->string('kode_trx')->nullable();
            $table->bigInteger('norut')->nullable();
            $table->bigInteger('id_barang')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->bigInteger('stok');

            // update TM 5Mei23
            $table->bigInteger('user_id_prodi')->length(20)->nullable();
            $table->string('user_kode_prodi', 50)->nullable();
            $table->string('user_nama_prodi', 150)->nullable();

            $table->uuid('uid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_trx_barang_detail');
    }
};

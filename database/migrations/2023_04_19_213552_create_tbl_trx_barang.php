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
        Schema::create('tbl_trx_barang', function (Blueprint $table) {
            $table->id('id_trx');
            $table->string('kode_trx')->nullable();
            $table->string('tipe_trx')->nullable(); # IN/OUT
            $table->string('ket')->nullable();
            $table->bigInteger('id_mahasiswa')->length(20)->nullable();
            $table->string('nama_mahasiswa')->nullable();
            $table->bigInteger('trxfrom')->length(20)->nullable();
            $table->string('trxfrom_ket')->nullable();

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
        Schema::dropIfExists('tbl_trx_barang');
    }
};

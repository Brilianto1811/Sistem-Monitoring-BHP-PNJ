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
        Schema::create('tbl_lokasi', function (Blueprint $table) {
            $table->id('id_lokasi');
            $table->string('kode_lokasi', 50)->nullable();
            $table->bigInteger('id_gedung')->length(20)->nullable();
            $table->string('kode_gedung', 50)->nullable();
            $table->bigInteger('id_gudang')->length(20)->nullable();
            $table->string('kode_gudang', 50)->nullable();
            $table->bigInteger('id_blok')->length(20)->nullable();
            $table->string('kode_blok', 50)->nullable();
            $table->string('nama_lokasi', 150)->nullable();

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
        Schema::dropIfExists('tbl_lokasi');
    }
};

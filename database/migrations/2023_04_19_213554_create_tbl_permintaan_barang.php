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
        Schema::create('tbl_permintaan_barang', function (Blueprint $table) {
            $table->id('id_permintaan');
            $table->string('kode_permintaan')->nullable();
            $table->bigInteger('id_mahasiswa')->nullable();
            $table->string('noid')->nullable(); # nim/nip/nidn/nik
            $table->string('nama')->nullable();
            $table->bigInteger('id_jurusan')->length(20)->nullable();
            $table->string('kode_jurusan', 50)->nullable();
            $table->bigInteger('id_prodi')->length(20)->nullable();
            $table->string('kode_prodi', 50)->nullable();
            $table->bigInteger('id_kelas')->length(20)->nullable();
            $table->string('kode_kelas', 50)->nullable();
            $table->string('informasi', 255)->nullable();
            $table->string('status_permintaan', 10)->nullable(); # setuju/tolak

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
        Schema::dropIfExists('tbl_permintaan_barang');
    }
};

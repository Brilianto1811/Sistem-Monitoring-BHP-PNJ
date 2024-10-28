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
        // [LOGIN]
        // https://stackoverflow.com/questions/39089190/laravel-authloginuser-not-working-properly
        Schema::create('tbl_mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->bigInteger('id_jurusan')->length(20)->nullable();
            $table->string('kode_jurusan', 50)->nullable();
            $table->bigInteger('id_prodi')->length(20)->nullable();
            $table->string('kode_prodi', 50)->nullable();
            $table->bigInteger('id_kelas')->length(20)->nullable();
            $table->string('kode_kelas', 50)->nullable();
            $table->string('nim', 15)->nullable();
            $table->string('password')->nullable();
            $table->string('nama_mahasiswa')->nullable();
            $table->string('telp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->string('email', 150)->nullable();

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
        Schema::dropIfExists('tbl_mahasiswa');
    }
};

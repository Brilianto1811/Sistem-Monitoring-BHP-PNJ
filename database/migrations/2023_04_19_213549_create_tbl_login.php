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
        Schema::create('tbl_login', function (Blueprint $table) {
            $table->id('id_login');
            $table->string('userid', 50)->nullable();
            $table->string('password')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_user')->nullable();
            $table->string('level', 50)->default('operator'); # admin/operator
            $table->string('status_user', 10)->default('nonaktif'); # nonaktif/aktif

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
        Schema::dropIfExists('tbl_login');
    }
};

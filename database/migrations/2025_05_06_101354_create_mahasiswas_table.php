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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nama', 30);
            $table->string('npm', 11);
            $table->enum('jk', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 30);
            $table->string('asal_sma', 50);
            $table->string('foto', 50)->nullable(); // Menambahkan nullable karena mungkin foto belum ada saat seeding/pembuatan awal
            $table->uuid('prodi_id');
            // --- BAGIAN YANG DIUBAH: 'on' harus mereferensikan 'prodis' (jamak) ---
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('restrict')->onUpdate('restrict');
            // ---------------------------------------------------------------------
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
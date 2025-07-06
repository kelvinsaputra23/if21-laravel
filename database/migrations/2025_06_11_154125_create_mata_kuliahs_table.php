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
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            // Ubah dari $table->id() menjadi $table->uuid('id')->primary()
            // agar konsisten dengan tabel lain yang menggunakan UUID
            $table->uuid('id')->primary();

            $table->string('nama');
            $table->string('kode_mk')->unique(); // Kode MK harus unik
            $table->integer('sks');

            // --- BAGIAN YANG DITAMBAHKAN: prodi_id sebagai foreign key ---
            $table->uuid('prodi_id'); // Pastikan tipe data sesuai dengan ID di tabel 'prodis' (uuid)
            $table->foreign('prodi_id')
                  ->references('id')
                  ->on('prodis') // Mereferensikan tabel 'prodis' (jamak)
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            // -----------------------------------------------------------

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
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
        Schema::create('jadwals', function (Blueprint $table) {
            // Ubah dari $table->id() menjadi $table->uuid('id')->primary()
            // agar konsisten dengan tabel lain yang menggunakan UUID
            $table->uuid('id')->primary();

            // --- KOLOM-KOLOM YANG DITAMBAHKAN SESUAI KEBUTUHAN SEEDER ---
            $table->string('tahun_akademik', 9); // Contoh: 2024/2025
            $table->string('kode_smt', 10); // Contoh: Gasal, Genap, Pendek
            $table->string('kelas', 10); // Contoh: SI-4A

            // Foreign key ke tabel 'mata_kuliahs'
            $table->uuid('mata_kuliah_id');
            $table->foreign('mata_kuliah_id')
                  ->references('id')
                  ->on('mata_kuliahs')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // Foreign key ke tabel 'users' (untuk dosen)
            $table->uuid('dosen_id'); // Asumsi ID user adalah UUID
            $table->foreign('dosen_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // Foreign key ke tabel 'sesis'
            $table->uuid('sesi_id'); // Asumsi ID sesi adalah UUID
            $table->foreign('sesi_id')
                  ->references('id')
                  ->on('sesis')
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
        Schema::dropIfExists('jadwals');
    }
};

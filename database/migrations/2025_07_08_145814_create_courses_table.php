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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique(); // Kode mata kuliah, harus unik
            $table->string('nama'); // Nama mata kuliah
            $table->unsignedBigInteger('prodi_id')->nullable(); // Foreign key ke tabel prodi (jika ada)
            $table->timestamps();

            // Jika ada tabel 'prodi', tambahkan foreign key constraint
            // $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
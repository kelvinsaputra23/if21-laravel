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
        Schema::create('sesis', function (Blueprint $table) {
            // Ubah dari $table->id() menjadi $table->uuid('id')->primary()
            // agar konsisten dengan tabel lain yang menggunakan UUID
            $table->uuid('id')->primary();

            $table->string('nama', 20); // Kolom nama sesi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesis');
    }
};
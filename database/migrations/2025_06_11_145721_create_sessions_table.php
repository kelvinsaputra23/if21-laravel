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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // BIGINT, Primary key, auto increment
            $table->string('nama'); // STRING, Nama sesi (contoh: 07.50-09.30, 09.40-11.20, 11.30-13.10, dst)
            $table->timestamps(); // created_at and updated_at TIMESTAMPS
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
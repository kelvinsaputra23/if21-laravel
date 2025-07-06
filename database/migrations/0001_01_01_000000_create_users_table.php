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
        Schema::create('users', function (Blueprint $table) {
            // Ubah dari $table->id() menjadi $table->uuid('id')->primary()
            // agar konsisten dengan tabel lain yang menggunakan UUID
            $table->uuid('id')->primary(); // Menggunakan UUID sebagai primary key

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Tidak ada perubahan pada password_reset_tokens dan sessions
        // karena mereka tidak menggunakan UUID sebagai foreign key ke users.id
        // Jika di masa depan Anda ingin user_id di sessions juga UUID,
        // Anda harus mengubah $table->foreignId('user_id') menjadi $table->uuid('user_id')
        // dan menambahkan foreign key constraint. Namun, untuk saat ini biarkan saja.
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            // Jika Anda ingin user_id di sessions juga UUID, Anda harus mengubah ini:
            // $table->uuid('user_id')->nullable()->index();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Tapi untuk saat ini, biarkan $table->foreignId('user_id') jika Anda tidak ingin mengubah sessions
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
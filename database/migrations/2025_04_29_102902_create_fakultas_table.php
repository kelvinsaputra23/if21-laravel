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
        Schema::create('fakultas', function (Blueprint $table) {
            $table->uuid('id'); // Menggunakan UUID sebagai primary key
            $table->primary('id'); // Menetapkan 'id' sebagai primary key

            $table->string('nama', 50); // Kolom untuk nama fakultas
            $table->string('kode_fakultas', 10)->unique(); // Menambahkan kolom kode_fakultas, pastikan unik
            // Kolom 'singkatan', 'nama_dekan', 'nama_wadek' dihapus karena tidak digunakan di seeder FakultasSeeder Anda.
            // Jika Anda ingin tetap menggunakannya, Anda harus menambahkannya juga di FakultasSeeder.

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas');
    }
};
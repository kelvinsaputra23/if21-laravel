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
        // Pastikan nama tabel adalah 'prodis' (plural) sesuai konvensi Laravel
        Schema::create('prodis', function (Blueprint $table) {
            $table->uuid('id'); // Menggunakan UUID sebagai primary key
            $table->primary('id'); // Menetapkan 'id' sebagai primary key

            $table->string('nama', 30); // Kolom nama prodi
            $table->char('singkatan', 2); // Kolom singkatan prodi
            $table->string('kaprodi', 30); // Kolom nama kepala prodi
            $table->string('sekretaris', 30); // Kolom nama sekretaris prodi

            // Foreign key ke tabel 'fakultas'
            // Pastikan 'fakultas_id' di sini sesuai dengan tipe ID di tabel 'fakultas' (uuid)
            $table->uuid('fakultas_id');
            $table->foreign('fakultas_id')
                  ->references('id')
                  ->on('fakultas')
                  ->onDelete('restrict') // Jika fakultas dihapus, prodi tidak ikut dihapus (akan error)
                  ->onUpdate('restrict'); // Jika ID fakultas diupdate, prodi tidak ikut diupdate (akan error)

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis'); // Pastikan ini juga 'prodis'
    }
};

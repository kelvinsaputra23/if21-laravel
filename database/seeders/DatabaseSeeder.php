<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Pastikan UserSeeder dijalankan pertama jika ada dependensi
            UserSeeder::class,

            // Seeders terkait struktur akademik
            FakultasSeeder::class,
            ProdiSeeder::class, // Prodi kemungkinan bergantung pada Fakultas

            // Seeders terkait sesi, mata kuliah, dan jadwal
            SessionSeeder::class, // Ini dari versi HEAD
            SesiSeeder::class, // Ini dari versi lain (kemungkinan Sesi adalah versi bahasa Indonesia dari Session)
            MataKuliahSeeder::class,
            JadwalSeeder::class,

            // Seeders terkait materi pelajaran
            // Jika ada dua CourseSeeder yang berbeda secara fungsional,
            // Anda mungkin perlu mengganti nama salah satunya atau menggabungkannya.
            // Untuk sekarang, kita asumsikan CourseSeeder yang lebih lengkap dari salah satu versi sudah cukup.
            CourseSeeder::class,
            MaterialTypeSeeder::class,
            MaterialSeeder::class,
        ]);
    }
}
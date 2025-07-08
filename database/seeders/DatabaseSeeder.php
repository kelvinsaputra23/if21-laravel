<?php

namespace Database\Seeders;

<<<<<<< HEAD
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
<<<<<<< HEAD
            UserSeeder::class, // Panggil seeder User terlebih dahulu
            SessionSeeder::class,
            CourseSeeder::class,
            // Panggil seeder lain jika ada (misal: ProdiSeeder, MaterialTypeSeeder)
=======
            // Seeder yang sudah ada (biarkan saja jika Anda membutuhkannya)
            UserSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            SesiSeeder::class,
            MataKuliahSeeder::class,
            JadwalSeeder::class,

            // --- Seeder untuk Fitur Materi ---
            // Pastikan urutannya benar: Course dan MaterialType sebelum Material
            CourseSeeder::class,
            MaterialTypeSeeder::class,
            MaterialSeeder::class,
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
        ]);
    }
}
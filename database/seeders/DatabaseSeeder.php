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
        ]);
    }
}
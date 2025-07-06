<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SesiSeeder::class,
            ProdiSeeder::class,
            UserSeeder::class,
            MataKuliahSeeder::class,
            JadwalSeeder::class,
        ]);
    }
}
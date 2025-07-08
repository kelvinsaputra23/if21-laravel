<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course; // Import model Course

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::truncate();

        Course::create([
            'kode_mk' => 'SI1001',
            'nama' => 'Pemrograman Web I',
            'prodi_id' => 1, // Sesuaikan dengan ID prodi yang ada
        ]);
        Course::create([
            'kode_mk' => 'SI1002',
            'nama' => 'Basis Data Lanjut',
            'prodi_id' => 1,
        ]);
        Course::create([
            'kode_mk' => 'SK2003',
            'nama' => 'Jaringan Komputer',
            'prodi_id' => 2, // Sesuaikan dengan ID prodi lain jika ada
        ]);
    }
}
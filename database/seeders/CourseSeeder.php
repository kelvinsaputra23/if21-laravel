<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use App\Models\Course; // Import model Course
=======
use App\Models\Course; // Penting: Pastikan model Course di-import
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
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
=======
        // Data mata kuliah yang akan dimasukkan
        $courses = [
            ['name' => 'Algoritma dan Pemrograman', 'code' => 'IF212'],
            ['name' => 'Sistem Basis Data', 'code' => 'IF213'],
            ['name' => 'Jaringan Komputer', 'code' => 'IF214'],
            ['name' => 'Pemrograman Web Lanjut', 'code' => 'IF215'],
            ['name' => 'Kecerdasan Buatan', 'code' => 'IF216'],
        ];

        // Loop untuk memasukkan data.
        // firstOrCreate akan mencari data berdasarkan 'code'.
        // Jika data dengan 'code' tersebut belum ada, maka akan dibuat baru.
        // Ini mencegah duplikasi data jika seeder dijalankan berkali-kali.
        foreach ($courses as $courseData) {
            Course::firstOrCreate(
                ['code' => $courseData['code']], // Kriteria pencarian
                ['name' => $courseData['name']]  // Data yang akan dibuat jika tidak ditemukan
            );
        }
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }
}
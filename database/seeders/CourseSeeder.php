<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course; // Penting: Pastikan model Course di-import

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
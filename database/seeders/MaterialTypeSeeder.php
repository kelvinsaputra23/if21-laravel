<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaterialType; // Penting: Pastikan model MaterialType di-import

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data jenis materi yang akan dimasukkan
        $materialTypes = [
            ['name' => 'PDF'],
            ['name' => 'Video'],
            ['name' => 'Quiz'],
            ['name' => 'Dokumen'],
            ['name' => 'Gambar'],
            ['name' => 'Audio'],
        ];

        // Loop untuk memasukkan data.
        // firstOrCreate akan mencari data berdasarkan 'name'.
        // Jika data dengan 'name' tersebut belum ada, maka akan dibuat baru.
        // Ini mencegah duplikasi data jika seeder dijalankan berkali-kali.
        foreach ($materialTypes as $typeData) {
            MaterialType::firstOrCreate(
                ['name' => $typeData['name']], // Kriteria pencarian
                [] // Tidak perlu data tambahan karena 'name' sudah cukup
            );
        }
    }
}
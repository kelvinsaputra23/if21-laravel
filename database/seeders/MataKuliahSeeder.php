<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah; // Pastikan model MataKuliah sudah ada
use App\Models\Prodi; // Diperlukan untuk mendapatkan ID Prodi
use Illuminate\Support\Str; // Diperlukan untuk menghasilkan UUID

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari prodi yang sudah di-seed.
        // Pastikan ProdiSeeder sudah berjalan dan mengisi data ini.
        $prodiSI = Prodi::where('singkatan', 'SI')->first(); // Menggunakan singkatan karena lebih ringkas
        $prodiTI = Prodi::where('singkatan', 'TI')->first();

        // Semai data untuk Mata Kuliah di Prodi Sistem Informasi
        if ($prodiSI) {
            MataKuliah::firstOrCreate(
                ['kode_mk' => 'SI101'], // Kriteria pencarian untuk menghindari duplikasi
                [
                    'id' => Str::uuid(), // Menghasilkan UUID unik untuk kolom ID
                    'nama' => 'Algoritma Pemrograman',
                    'sks' => 3, // Menambahkan kolom SKS
                    'prodi_id' => $prodiSI->id, // Menggunakan ID dari Prodi Sistem Informasi
                    // created_at dan updated_at akan diisi otomatis oleh Laravel
                ]
            );
            MataKuliah::firstOrCreate(
                ['kode_mk' => 'SI201'],
                [
                    'id' => Str::uuid(),
                    'nama' => 'Basis Data',
                    'sks' => 3, // Menambahkan kolom SKS
                    'prodi_id' => $prodiSI->id,
                ]
            );
        } else {
            // Pesan informasi jika Prodi Sistem Informasi tidak ditemukan
            $this->command->info('Prodi Sistem Informasi tidak ditemukan. Mata Kuliah untuk SI tidak disemai.');
        }

        // Semai data untuk Mata Kuliah di Prodi Teknik Informatika
        if ($prodiTI) {
            MataKuliah::firstOrCreate(
                ['kode_mk' => 'TI101'],
                [
                    'id' => Str::uuid(),
                    'nama' => 'Struktur Data',
                    'sks' => 3, // Menambahkan kolom SKS
                    'prodi_id' => $prodiTI->id, // Menggunakan ID dari Prodi Teknik Informatika
                ]
            );
            MataKuliah::firstOrCreate(
                ['kode_mk' => 'TI201'],
                [
                    'id' => Str::uuid(),
                    'nama' => 'Jaringan Komputer',
                    'sks' => 3, // Menambahkan kolom SKS
                    'prodi_id' => $prodiTI->id,
                ]
            );
        } else {
            // Pesan informasi jika Prodi Teknik Informatika tidak ditemukan
            $this->command->info('Prodi Teknik Informatika tidak ditemukan. Mata Kuliah untuk TI tidak disemai.');
        }

        // Anda bisa menambahkan data mata kuliah lain di sini sesuai kebutuhan,
        // pastikan setiap mata kuliah memiliki UUID unik dan prodi_id yang valid.
    }
}

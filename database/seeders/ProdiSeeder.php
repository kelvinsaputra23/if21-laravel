<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi; // Pastikan model Prodi sudah ada
use App\Models\Fakultas; // Diperlukan untuk mengambil ID Fakultas
use Illuminate\Support\Str; // Diperlukan untuk menghasilkan UUID

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari fakultas yang sudah di-seed.
        // Pastikan FakultasSeeder sudah berjalan dan mengisi data ini.
        $fakultasIlmuKomputer = Fakultas::where('kode_fakultas', 'FIK')->first();
        $fakultasEkonomiBisnis = Fakultas::where('kode_fakultas', 'FEB')->first();


        // Semai data untuk Program Studi di Fakultas Ilmu Komputer
        if ($fakultasIlmuKomputer) {
            Prodi::firstOrCreate(
                ['nama' => 'Sistem Informasi'], // Kriteria pencarian untuk menghindari duplikasi
                [
                    'id' => Str::uuid(), // Menghasilkan UUID unik untuk kolom ID
                    'singkatan' => 'SI',
                    'kaprodi' => 'Dr. Andi Pratama', // Contoh nama kepala program studi
                    'sekretaris' => 'Budi Santoso, M.Kom', // Contoh nama sekretaris program studi
                    'fakultas_id' => $fakultasIlmuKomputer->id, // Menggunakan ID dari Fakultas Ilmu Komputer
                    // created_at dan updated_at akan diisi otomatis oleh Laravel
                ]
            );

            Prodi::firstOrCreate(
                ['nama' => 'Teknik Informatika'],
                [
                    'id' => Str::uuid(),
                    'singkatan' => 'TI',
                    'kaprodi' => 'Prof. Citra Dewi',
                    'sekretaris' => 'Agus Setiawan, S.T.',
                    'fakultas_id' => $fakultasIlmuKomputer->id,
                ]
            );
        } else {
            // Pesan informasi jika Fakultas Ilmu Komputer tidak ditemukan
            $this->command->info('Fakultas dengan kode FIK tidak ditemukan. Prodi Sistem Informasi dan Teknik Informatika tidak disemai.');
        }

        // Semai data untuk Program Studi di Fakultas Ekonomi dan Bisnis
        if ($fakultasEkonomiBisnis) {
            Prodi::firstOrCreate(
                ['nama' => 'Manajemen'],
                [
                    'id' => Str::uuid(),
                    'singkatan' => 'MN',
                    'kaprodi' => 'Dr. Rina Puspita',
                    'sekretaris' => 'Dewi Lestari, S.E.',
                    'fakultas_id' => $fakultasEkonomiBisnis->id,
                ]
            );
        } else {
            // Pesan informasi jika Fakultas Ekonomi dan Bisnis tidak ditemukan
            $this->command->info('Fakultas dengan kode FEB tidak ditemukan. Prodi Manajemen tidak disemai.');
        }

        // Anda bisa menambahkan data prodi lain di sini sesuai kebutuhan,
        // pastikan setiap prodi memiliki UUID unik dan fakultas_id yang valid.
    }
}
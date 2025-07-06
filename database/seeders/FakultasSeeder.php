<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fakultas; // Penting: Pastikan Anda memiliki Model Fakultas

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data Fakultas di sini
        // Contoh: Membuat satu Fakultas Ilmu Komputer
        Fakultas::firstOrCreate(
            ['nama' => 'Fakultas Ilmu Komputer'],
            ['kode_fakultas' => 'FIK']
        );

        // Anda bisa menambahkan data fakultas lain jika diperlukan
        Fakultas::firstOrCreate(
            ['nama' => 'Fakultas Ekonomi dan Bisnis'],
            ['kode_fakultas' => 'FEB']
        );

        // Pastikan model 'App\Models\Fakultas' sudah ada dan terhubung dengan tabel 'fakultas' di database Anda.
        // Dan pastikan migrasi 'create_fakultas_table' sudah ada dan berhasil dijalankan.
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal; // Pastikan model Jadwal sudah ada
use App\Models\MataKuliah; // Diperlukan untuk mendapatkan ID Mata Kuliah
use App\Models\Sesi; // Diperlukan untuk mendapatkan ID Sesi
use App\Models\User; // Diperlukan untuk mendapatkan ID Dosen
use Illuminate\Support\Str; // Penting: Diperlukan untuk menghasilkan UUID

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data yang dibutuhkan dari seeder sebelumnya
        $mk1 = MataKuliah::where('kode_mk', 'SI101')->first();
        $mk2 = MataKuliah::where('kode_mk', 'TI101')->first();
        $mkSI201 = MataKuliah::where('kode_mk', 'SI201')->first();
        $mkTI201 = MataKuliah::where('kode_mk', 'TI201')->first();


        $dosen1 = User::where('email', 'dosen1@example.com')->first();
        $dosen2 = User::where('email', 'dosen2@example.com')->first(); // <-- PASTIKAN BARIS INI ADA DAN BENAR


        $sesi1 = Sesi::where('nama', '07.50-09.30')->first();
        $sesi2 = Sesi::where('nama', '09.40-11.20')->first();


        // Semai data untuk Jadwal 1 (Algoritma Pemrograman, Dosen Budi, Sesi 1)
        if ($mk1 && $dosen1 && $sesi1) {
            Jadwal::firstOrCreate(
                [
                    'tahun_akademik' => '2024/2025',
                    'kode_smt' => 'Gasal',
                    'kelas' => 'SI-4A',
                    'mata_kuliah_id' => $mk1->id,
                    'dosen_id' => $dosen1->id,
                    'sesi_id' => $sesi1->id,
                ],
                [
                    'id' => Str::uuid(), // Menghasilkan UUID unik untuk ID jadwal
                    // created_at dan updated_at akan diisi otomatis oleh Laravel
                ]
            );
        } else {
            $this->command->info('Data referensi untuk Jadwal SI-4A (Algoritma Pemrograman) tidak ditemukan. Pastikan seeder MataKuliah, User, dan Sesi berjalan dengan benar.');
        }

        // Semai data untuk Jadwal 2 (Algoritma Pemrograman, Dosen Budi, Sesi 2)
        if ($mk1 && $dosen1 && $sesi2) {
            Jadwal::firstOrCreate(
                [
                    'tahun_akademik' => '2024/2025',
                    'kode_smt' => 'Gasal',
                    'kelas' => 'SI-4B',
                    'mata_kuliah_id' => $mk1->id,
                    'dosen_id' => $dosen1->id,
                    'sesi_id' => $sesi2->id,
                ],
                [
                    'id' => Str::uuid(),
                ]
            );
        } else {
            $this->command->info('Data referensi untuk Jadwal SI-4B (Algoritma Pemrograman) tidak ditemukan. Pastikan seeder MataKuliah, User, dan Sesi berjalan dengan benar.');
        }

        // Semai data untuk Jadwal 3 (Struktur Data, Dosen Ani, Sesi 1)
        if ($mk2 && $dosen2 && $sesi1) {
            Jadwal::firstOrCreate(
                [
                    'tahun_akademik' => '2024/2025',
                    'kode_smt' => 'Genap',
                    'kelas' => 'TI-2A',
                    'mata_kuliah_id' => $mk2->id,
                    'dosen_id' => $dosen2->id,
                    'sesi_id' => $sesi1->id,
                ],
                [
                    'id' => Str::uuid(),
                ]
            );
        } else {
            $this->command->info('Data referensi untuk Jadwal TI-2A (Struktur Data) tidak ditemukan. Pastikan seeder MataKuliah, User, dan Sesi berjalan dengan benar.');
        }

        // Contoh tambahan untuk Mata Kuliah Basis Data (Dosen Ani, Sesi Siang)
        if ($mkSI201 && $dosen2 && $sesi2) { // Menggunakan $dosen2 (Ani) di sini
            Jadwal::firstOrCreate(
                [
                    'tahun_akademik' => '2024/2025',
                    'kode_smt' => 'Genap',
                    'kelas' => 'SI-3C',
                    'mata_kuliah_id' => $mkSI201->id,
                    'dosen_id' => $dosen2->id,
                    'sesi_id' => $sesi2->id,
                ],
                [
                    'id' => Str::uuid(),
                ]
            );
        } else {
            $this->command->info('Data referensi untuk Jadwal SI-3C (Basis Data) tidak ditemukan.');
        }
    }
}

<?php
namespace Database\Seeders;
use App\Models\MataKuliah;
use App\Models\Prodi; // Pastikan ini diimport
use Illuminate\Database\Seeder;
class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $siProdi = Prodi::where('nama', 'Sistem Informasi')->first();
        $tiProdi = Prodi::where('nama', 'Teknik Informatika')->first();

        if ($siProdi) {
            MataKuliah::create(['kode_mk' => 'SI101', 'nama' => 'Algoritma Pemrograman', 'prodi_id' => $siProdi->id]);
            MataKuliah::create(['kode_mk' => 'SI201', 'nama' => 'Basis Data', 'prodi_id' => $siProdi->id]);
        }
        if ($tiProdi) {
            MataKuliah::create(['kode_mk' => 'TI101', 'nama' => 'Struktur Data', 'prodi_id' => $tiProdi->id]);
            MataKuliah::create(['kode_mk' => 'TI201', 'nama' => 'Jaringan Komputer', 'prodi_id' => $tiProdi->id]);
        }
    }
}
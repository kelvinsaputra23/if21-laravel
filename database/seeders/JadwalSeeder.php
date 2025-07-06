<?php
namespace Database\Seeders;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Sesi;
use App\Models\User;
use Illuminate\Database\Seeder;
class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $mk1 = MataKuliah::where('kode_mk', 'SI101')->first();
        $mk2 = MataKuliah::where('kode_mk', 'TI101')->first();
        $dosen1 = User::where('email', 'dosen1@example.com')->first();
        $dosen2 = User::where('email', 'dosen2@example.com')->first();
        $sesi1 = Sesi::where('nama', '07.50-09.30')->first();
        $sesi2 = Sesi::where('nama', '09.40-11.20')->first();

        if ($mk1 && $dosen1 && $sesi1) {
            Jadwal::create([
                'tahun_akademik' => '2024/2025',
                'kode_smt' => 'Gasal',
                'kelas' => 'SI-4A',
                'mata_kuliah_id' => $mk1->id,
                'dosen_id' => $dosen1->id,
                'sesi_id' => $sesi1->id,
            ]);
            Jadwal::create([
                'tahun_akademik' => '2024/2025',
                'kode_smt' => 'Gasal',
                'kelas' => 'SI-4B',
                'mata_kuliah_id' => $mk1->id,
                'dosen_id' => $dosen1->id,
                'sesi_id' => $sesi2->id,
            ]);
        }

        if ($mk2 && $dosen2 && $sesi2) {
            Jadwal::create([
                'tahun_akademik' => '2024/2025',
                'kode_smt' => 'Genap',
                'kelas' => 'TI-2A',
                'mata_kuliah_id' => $mk2->id,
                'dosen_id' => $dosen2->id,
                'sesi_id' => $sesi1->id,
            ]);
        }
    }
}
<?php
namespace Database\Seeders;
use App\Models\Prodi;
use Illuminate\Database\Seeder;
class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        Prodi::create(['nama' => 'Sistem Informasi']);
        Prodi::create(['nama' => 'Teknik Informatika']);
        Prodi::create(['nama' => 'Manajemen']);
    }
}
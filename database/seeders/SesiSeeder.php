<?php
namespace Database\Seeders;
use App\Models\Sesi;
use Illuminate\Database\Seeder;
class SesiSeeder extends Seeder
{
    public function run(): void
    {
        Sesi::create(['nama' => '07.50-09.30']);
        Sesi::create(['nama' => '09.40-11.20']);
        Sesi::create(['nama' => '11.30-13.10']);
        Sesi::create(['nama' => '13.20-15.00']);
        Sesi::create(['nama' => '15.10-16.50']);
    }
}
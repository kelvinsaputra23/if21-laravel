<?php

namespace Database\Seeders;

use App\Models\Sesi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Penting: Diperlukan untuk menghasilkan UUID

class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan firstOrCreate untuk menghindari duplikasi dan memastikan ID UUID
        Sesi::firstOrCreate(
            ['nama' => '07.50-09.30'],
            [
                'id' => Str::uuid(), // Menghasilkan UUID unik untuk ID
            ]
        );
        Sesi::firstOrCreate(
            ['nama' => '09.40-11.20'],
            [
                'id' => Str::uuid(),
            ]
        );
        Sesi::firstOrCreate(
            ['nama' => '11.30-13.10'],
            [
                'id' => Str::uuid(),
            ]
        );
        Sesi::firstOrCreate(
            ['nama' => '13.20-15.00'],
            [
                'id' => Str::uuid(),
            ]
        );
        Sesi::firstOrCreate(
            ['nama' => '15.10-16.50'],
            [
                'id' => Str::uuid(),
            ]
        );
    }
}

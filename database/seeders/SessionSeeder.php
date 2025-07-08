<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Session; // Import model Session

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ingin mengulang seed
        Session::truncate();

        Session::create(['name' => '07.50-09.30']);
        Session::create(['name' => '09.40-11.20']);
        Session::create(['name' => '11.30-13.10']);
        Session::create(['name' => '13.20-15.00']);
        Session::create(['name' => '15.10-16.50']);
    }
}
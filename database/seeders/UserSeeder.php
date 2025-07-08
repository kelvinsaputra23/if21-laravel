<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Untuk hashing password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan user dosen jika belum ada
        User::firstOrCreate(
            ['email' => 'dosen1@example.com'],
            [
                'name' => 'Dr. Budi Santoso',
                'password' => Hash::make('password'), // Ganti dengan password yang kuat
                'role' => 'dosen', // Tambahkan kolom 'role' di tabel users jika belum ada
            ]
        );
        User::firstOrCreate(
            ['email' => 'dosen2@example.com'],
            [
                'name' => 'Prof. Siti Aminah',
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]
        );
        // User admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Aplikasi',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Penting: Diperlukan untuk menghasilkan UUID

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Admin (jika belum ada)
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Kriteria pencarian
            [
                'id' => Str::uuid(), // Menghasilkan UUID unik untuk ID
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'admin' // Contoh role
            ]
        );

        // User Dosen 1
        User::firstOrCreate(
            ['email' => 'dosen1@example.com'],
            [
                'id' => Str::uuid(), // Menghasilkan UUID unik untuk ID
                'name' => 'Dr. Budi Santoso',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'dosen' // Penting untuk filter di controller
            ]
        );

        // User Dosen 2
        User::firstOrCreate(
            ['email' => 'dosen2@example.com'],
            [
                'id' => Str::uuid(), // Menghasilkan UUID unik untuk ID
                'name' => 'Prof. Ani Wijaya',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'dosen'
            ]
        );
    }
}

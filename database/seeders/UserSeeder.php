<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Untuk hashing password
=======
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Penting: Diperlukan untuk menghasilkan UUID
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
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
=======
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
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3

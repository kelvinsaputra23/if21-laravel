<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin (jika belum ada)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'admin' // Contoh role
            ]
        );

        // User Dosen
        User::firstOrCreate(
            ['email' => 'dosen1@example.com'],
            [
                'name' => 'Dr. Budi Santoso',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'dosen' // Penting untuk filter di controller
            ]
        );
        User::firstOrCreate(
            ['email' => 'dosen2@example.com'],
            [
                'name' => 'Prof. Ani Wijaya',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'dosen'
            ]
        );
    }
}
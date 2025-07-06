<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // Uncomment if you use email verification
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Menambahkan ini karena sering digunakan dengan User model

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Menambahkan HasApiTokens

    // Menentukan bahwa ID tidak auto-incrementing (karena menggunakan UUID)
    public $incrementing = false;

    // Menentukan tipe data primary key adalah string (karena menggunakan UUID)
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', // Tambahkan 'id' karena diisi manual dengan UUID di seeder
        'name',
        'email',
        'password',
        'role', // Tambahkan 'role' karena diisi di seeder
        'email_verified_at', // Tambahkan 'email_verified_at' karena diisi di seeder
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the jadwals for the user (dosen).
     * Ini adalah relasi opsional, tambahkan jika Anda menggunakannya.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'dosen_id'); // 'dosen_id' adalah foreign key di tabel jadwals
    }
}

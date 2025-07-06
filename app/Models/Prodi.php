<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    // Menentukan bahwa ID tidak auto-incrementing (karena menggunakan UUID)
    public $incrementing = false;

    // Menentukan tipe data primary key adalah string (karena menggunakan UUID)
    protected $keyType = 'string';

    // Kolom-kolom yang diizinkan untuk mass assignment
    // Pastikan semua kolom yang diisi di seeder ada di sini
    protected $fillable = [
        'id', // Tambahkan ID karena diisi manual dengan UUID
        'nama',
        'singkatan',
        'kaprodi',
        'sekretaris',
        'fakultas_id',
    ];

    /**
     * Get the mata kuliahs for the prodi.
     */
    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class);
    }

    /**
     * Get the fakultas that owns the prodi.
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}

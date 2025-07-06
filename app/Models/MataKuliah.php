<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

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
        'kode_mk',
        'nama',
        'sks', // Tambahkan 'sks' karena diisi di seeder
        'prodi_id',
    ];

    /**
     * Get the prodi that owns the mata kuliah.
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Get the jadwals for the mata kuliah.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}

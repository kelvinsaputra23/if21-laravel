<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode_mk',
        'sks',
    ];

    // Relasi dengan Jadwal (akan digunakan nanti)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'mata_kuliah_id');
    }
}
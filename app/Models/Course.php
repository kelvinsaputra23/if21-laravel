<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_mk',
        'nama',
        'prodi_id', // Asumsi ada tabel 'prodi'
    ];

    // Relasi: Satu Course memiliki banyak Material
    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    // Asumsi relasi ke tabel Prodi jika ada
    // public function prodi()
    // {
    //     return $this->belongsTo(Prodi::class);
    // }
}
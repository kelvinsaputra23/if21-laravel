<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

<<<<<<< HEAD
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
=======
    protected $table = 'courses';
    protected $fillable = ['name', 'description'];

    // Relationship with Material (one-to-many)
    public function materials()
    {
        return $this->hasMany(Material::class, 'course_id');
    }
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
}
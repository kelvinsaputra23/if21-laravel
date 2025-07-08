<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'name',
    ];

    // Relasi: Satu MaterialType memiliki banyak Material
    public function materials()
    {
        return $this->hasMany(Material::class);
=======
    protected $table = 'material_type';
    protected $fillable = ['name'];

    // Relationship with Material (one-to-many)
    public function materials()
    {
        return $this->hasMany(Material::class, 'material_type_id');
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }
}
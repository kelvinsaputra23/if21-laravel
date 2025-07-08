<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relasi: Satu MaterialType memiliki banyak Material
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
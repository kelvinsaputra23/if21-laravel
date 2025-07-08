<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

    protected $table = 'material_type';
    protected $fillable = ['name'];

    // Relationship with Material (one-to-many)
    public function materials()
    {
        return $this->hasMany(Material::class, 'material_type_id');
    }
}
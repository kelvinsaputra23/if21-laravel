<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialFile extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'material_type_id', 'file_path'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function type()
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialFile extends Model
{
    use HasFactory;
    protected $fillable = ['material_id', 'material_type_id', 'file_path'];

    // Definisi relasi: Satu MaterialFile dimiliki oleh satu Material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Definisi relasi: Satu MaterialFile memiliki satu MaterialType
    public function type()
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }
}
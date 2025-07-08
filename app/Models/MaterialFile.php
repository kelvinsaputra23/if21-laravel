<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'file_path',
        'file_name',
    ];

    // Relasi: Satu MaterialFile dimiliki oleh satu Material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialFile extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $fillable = [
        'material_id',
        'file_path',
        'file_name',
    ];

    // Relasi: Satu MaterialFile dimiliki oleh satu Material
=======
    protected $fillable = ['material_id', 'material_type_id', 'file_path'];

    // Definisi relasi: Satu MaterialFile dimiliki oleh satu Material
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
<<<<<<< HEAD
=======

    // Definisi relasi: Satu MaterialFile memiliki satu MaterialType
    public function type()
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
}
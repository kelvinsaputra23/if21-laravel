<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'material_type_id',
    ];

    // Relasi: Satu Material dimiliki oleh satu Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi: Satu Material memiliki satu MaterialType
    public function materialType()
    {
        return $this->belongsTo(MaterialType::class);
    }

    // Relasi: Satu Material memiliki banyak MaterialFile
    public function materialFiles()
    {
        return $this->hasMany(MaterialFile::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = ['name', 'description'];

    // Relationship with Material (one-to-many)
    public function materials()
    {
        return $this->hasMany(Material::class, 'course_id');
    }
}
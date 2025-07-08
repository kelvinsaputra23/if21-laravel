<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

<<<<<<< HEAD
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
=======
    protected $table = 'material';
    protected $fillable = [
        'course_id',
        'material_type_id',
        'title',
        'file_path',
        'url',
        'description',
        'uploaded_by_dosen_id'
    ];

    // Relationships (many-to-one)
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function materialType()
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }

    // Assuming you have a User model for dosen
    // public function uploader()
    // {
    //     return $this->belongsTo(User::class, 'uploaded_by_dosen_id');
    // }
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
}
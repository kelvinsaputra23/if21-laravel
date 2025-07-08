<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $table = 'sesi'; // Specify the table name
    protected $fillable = ['nama']; // Fields that can be mass assigned

    // Relationship with Jadwal (one-to-many)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'sesi_id');
    }
}
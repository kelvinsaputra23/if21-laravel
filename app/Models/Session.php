<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    // Relasi dengan Jadwal (akan digunakan nanti)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'session_id');
    }
}
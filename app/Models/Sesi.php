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

    // Definisi relasi jika ada (akan ditambahkan nanti untuk Jadwal)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'session_id');
    }
}
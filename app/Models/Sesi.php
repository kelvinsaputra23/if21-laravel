<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama', // Kolom 'nama' adalah satu-satunya yang bisa diisi secara massal
    ];

    /**
     * Get the jadwals for the sesi.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
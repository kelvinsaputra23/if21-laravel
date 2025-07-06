<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_mk',
        'nama',
        'prodi_id',
    ];

    /**
     * Get the prodi that owns the mata kuliah.
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    /**
     * Get the jadwals for the mata kuliah.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
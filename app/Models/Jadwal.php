<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'tahun_akademik',
        'kode_smt',
        'kelas',
        'mata_kuliah_id',
        'dosen_id',
        'sesi_id'
    ];

    // Relationships (many-to-one)
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id');
    }

    // Assuming you have a User model for dosen
    // public function dosen()
    // {
    //     return $this->belongsTo(User::class, 'dosen_id');
    // }
}
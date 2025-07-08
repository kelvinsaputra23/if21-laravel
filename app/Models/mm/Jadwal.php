<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // Menentukan bahwa ID tidak auto-incrementing (karena menggunakan UUID)
    public $incrementing = false;

    // Menentukan tipe data primary key adalah string (karena menggunakan UUID)
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', // Tambahkan 'id' karena diisi manual dengan UUID di seeder
        'tahun_akademik',
        'kode_smt',
        'kelas',
        'mata_kuliah_id',
        'dosen_id',
        'sesi_id',
    ];

    /**
     * Get the mata kuliah that owns the jadwal.
     */
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    /**
     * Get the dosen (user) that owns the jadwal.
     */
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    /**
     * Get the sesi that owns the jadwal.
     */
    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasUuids;
    protected $table = 'mahasiswas';

    protected $fillable = [
        'nama',
        'npm',
        'tempat_lahir',
        'tanggal_lahir',
        'jk',
        'asal_sma',
        'foto',
        'prodi_id'
    ];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
    

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}

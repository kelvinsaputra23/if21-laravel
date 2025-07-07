<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // <<< PERBAIKAN DI SINI: dari '->' menjadi '\'

class MaterialType extends Model
{
    use HasFactory;

    // Kolom 'name' bisa diisi secara massal
    protected $fillable = ['name'];

    /**
     * Definisi relasi: Satu MaterialType bisa memiliki banyak MaterialFile.
     * Ini memungkinkan kita untuk mengambil semua file materi yang memiliki jenis ini.
     */
    public function materialFiles()
    {
        return $this->hasMany(MaterialFile::class);
    }
}
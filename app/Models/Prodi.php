<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Prodi extends Model
{
    use HasFactory;
    protected $fillable = ['nama']; // Tambahkan kolom lain jika ada
    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class);
    }
}
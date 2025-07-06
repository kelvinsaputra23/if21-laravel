<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Prodi; // Pastikan model Prodi sudah ada dan diimport
use Illuminate\Support\Facades\DB; // Untuk query builder raw

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan data untuk grafik: Jumlah kelas per Prodi dan Tahun Akademik
        // Melakukan join ke tabel mata_kuliahs dan prodis
        $classCounts = Jadwal::select(
                'jadwals.tahun_akademik',
                'prodis.nama as prodi_nama',
                DB::raw('count(jadwals.id) as total_kelas') // Menghitung jumlah kelas
            )
            ->join('mata_kuliahs', 'jadwals.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->join('prodis', 'mata_kuliahs.prodi_id', '=', 'prodis.id')
            ->groupBy('jadwals.tahun_akademik', 'prodis.nama') // Kelompokkan berdasarkan tahun akademik dan prodi
            ->orderBy('jadwals.tahun_akademik', 'asc') // Urutkan untuk tampilan yang rapi
            ->orderBy('prodis.nama', 'asc')
            ->get();

        // Memformat data agar mudah digunakan oleh Chart.js
        $labels = []; // Contoh: ['2024/2025 - SI', '2024/2025 - TI', ...]
        $data = [];   // Contoh: [10, 15, ...]

        foreach ($classCounts as $item) {
            $labels[] = $item->tahun_akademik . ' - ' . $item->prodi_nama;
            $data[] = (int) $item->total_kelas; // Pastikan data adalah integer
        }

        // Mengirim data ke view dashboard
        return view('dashboard', compact('labels', 'data'));
    }
}
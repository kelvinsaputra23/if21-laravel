<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;      // Import model Jadwal
use App\Models\MataKuliah;  // Import model MataKuliah
use App\Models\Sesi;        // Import model Sesi
use App\Models\User;        // Import model User (untuk Dosen)
use Illuminate\Http\Request; // Import kelas Request untuk menangani input

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal.
     */
    public function index()
    {
        // Ambil semua jadwal beserta relasinya (mata kuliah, dosen, sesi)
        // Menggunakan with() untuk eager loading agar tidak terjadi N+1 query problem
        $jadwals = Jadwal::with(['mataKuliah', 'dosen', 'sesi'])->latest()->paginate(10);
        return view('jadwals.index', compact('jadwals'));
    }

    /**
     * Menampilkan form untuk membuat jadwal baru.
     */
    public function create()
    {
        // Ambil data yang diperlukan untuk dropdown di form
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get(); // Asumsi ada kolom 'role' di tabel users untuk dosen
        $sesis = Sesi::all();
        return view('jadwals.create', compact('mataKuliahs', 'dosens', 'sesis'));
    }

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'tahun_akademik' => 'required|string|max:255',
            'kode_smt' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id', // Pastikan ID mata kuliah ada di tabel mata_kuliahs
            'dosen_id' => 'required|exists:users,id',           // Pastikan ID dosen ada di tabel users
            'sesi_id' => 'required|exists:sesis,id',             // Pastikan ID sesi ada di tabel sesis
        ]);

        // Buat entri jadwal baru di database
        Jadwal::create($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail jadwal tertentu.
     */
    public function show(Jadwal $jadwal)
    {
        // Data jadwal sudah di-resolve oleh Route Model Binding
        // Pastikan relasi diload untuk ditampilkan
        $jadwal->load(['mataKuliah', 'dosen', 'sesi']);
        return view('jadwals.show', compact('jadwal'));
    }

    /**
     * Menampilkan form untuk mengedit jadwal tertentu.
     */
    public function edit(Jadwal $jadwal)
    {
        // Ambil data yang diperlukan untuk dropdown di form edit
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get();
        $sesis = Sesi::all();
        return view('jadwals.edit', compact('jadwal', 'mataKuliahs', 'dosens', 'sesis'));
    }

    /**
     * Memperbarui jadwal tertentu di database.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        // Validasi data input dari form
        $request->validate([
            'tahun_akademik' => 'required|string|max:255',
            'kode_smt' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id' => 'required|exists:users,id',
            'sesi_id' => 'required|exists:sesis,id',
        ]);

        // Perbarui entri jadwal di database
        $jadwal->update($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Menghapus jadwal tertentu dari database.
     */
    public function destroy(Jadwal $jadwal)
    {
        // Hapus jadwal dari database
        $jadwal->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
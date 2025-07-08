<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah; // Import model Matakuliah
use App\Models\Prodi;      // Import model Prodi karena Matakuliah punya foreign key ke Prodi
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Menampilkan daftar mata kuliah.
     */
    public function index()
    {
        // Mengambil semua mata kuliah dengan relasi prodi-nya
        $matakuliah = Matakuliah::with('prodi')->get();
        return view('matakuliah.index', compact('matakuliah'));
    }

    /**
     * Menampilkan form untuk membuat mata kuliah baru.
     */
    public function create()
    {
        // Ambil semua prodi untuk dropdown pilihan prodi
        $prodis = Prodi::all();
        return view('matakuliah.create', compact('prodis'));
    }

    /**
     * Menyimpan mata kuliah baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:255|unique:matakuliah,kode_mk',
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodis,id', // Pastikan prodi_id ada di tabel prodis
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail mata kuliah tertentu.
     */
    public function show(Matakuliah $matakuliah)
    {
        return view('matakuliah.show', compact('matakuliah'));
    }

    /**
     * Menampilkan form untuk mengedit mata kuliah.
     */
    public function edit(Matakuliah $matakuliah)
    {
        // Ambil semua prodi untuk dropdown pilihan prodi
        $prodis = Prodi::all();
        return view('matakuliah.edit', compact('matakuliah', 'prodis'));
    }

    /**
     * Memperbarui data mata kuliah di database.
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:255|unique:matakuliah,kode_mk,' . $matakuliah->id,
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $matakuliah->update($request->all());

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    /**
     * Menghapus mata kuliah dari database.
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
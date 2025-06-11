<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah; // Pastikan ini diimpor
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Menampilkan daftar semua mata kuliah.
     */
    public function index()
    {
        $mataKuliahs = MataKuliah::all();
        return view('mata_kuliahs.index', compact('mataKuliahs'));
    }

    /**
     * Menampilkan formulir untuk membuat mata kuliah baru.
     */
    public function create()
    {
        return view('mata_kuliahs.create');
    }

    /**
     * Menyimpan mata kuliah baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode_mk' => 'required|string|max:255|unique:mata_kuliahs,kode_mk',
            'sks' => 'required|integer|min:1',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('mata_kuliahs.index')
                         ->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu mata kuliah.
     */
    public function show(MataKuliah $mataKuliah)
    {
        return view('mata_kuliahs.show', compact('mataKuliah'));
    }

    /**
     * Menampilkan formulir untuk mengedit mata kuliah.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        return view('mata_kuliahs.edit', compact('mataKuliah'));
    }

    /**
     * Memperbarui mata kuliah di database.
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode_mk' => 'required|string|max:255|unique:mata_kuliahs,kode_mk,' . $mataKuliah->id,
            'sks' => 'required|integer|min:1',
        ]);

        $mataKuliah->update($request->all());

        return redirect()->route('mata_kuliahs.index')
                         ->with('success', 'Mata Kuliah berhasil diperbarui!');
    }

    /**
     * Menghapus mata kuliah dari database.
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        // Pengecekan: Jika ada jadwal yang terkait dengan mata kuliah ini, tidak boleh dihapus
        if ($mataKuliah->jadwals()->count() > 0) {
            return redirect()->route('mata_kuliahs.index')
                             ->with('error', 'Tidak dapat menghapus mata kuliah karena ada jadwal yang terkait.');
        }

        $mataKuliah->delete();

        return redirect()->route('mata_kuliahs.index')
                         ->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
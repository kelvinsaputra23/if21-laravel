<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesis = Sesi::all(); // Mengambil semua data sesi
        return view('sesi.index', compact('sesis')); // Mengirim data ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sesi.create'); // Menampilkan form untuk membuat sesi baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:20', // Validasi input nama
        ]);

        Sesi::create($request->all()); // Menyimpan data sesi baru
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sesi $sesi)
    {
        return view('sesi.show', compact('sesi')); // Menampilkan detail sesi
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sesi $sesi)
    {
        return view('sesi.edit', compact('sesi')); // Menampilkan form untuk mengedit sesi
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sesi $sesi)
    {
        $request->validate([
            'nama' => 'required|string|max:20', // Validasi input nama
        ]);

        $sesi->update($request->all()); // Memperbarui data sesi
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sesi $sesi)
    {
        $sesi->delete(); // Menghapus sesi
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Session; // Pastikan ini diimpor
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Menampilkan daftar semua sesi.
     */
    public function index()
    {
        $sessions = Session::all(); // Mengambil semua data sesi
        return view('sessions.index', compact('sessions')); // Mengirim data ke view 'sessions.index'
    }

    /**
     * Menampilkan formulir untuk membuat sesi baru.
     */
    public function create()
    {
        return view('sessions.create'); // Menampilkan view 'sessions.create'
    }

    /**
     * Menyimpan sesi baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari formulir
        $request->validate([
            'nama' => 'required|string|max:255|unique:sessions,nama', // Nama wajib diisi, string, maks 255 karakter, dan harus unik di tabel 'sessions'
        ]);

        Session::create($request->all()); // Membuat record sesi baru di database

        // Redirect kembali ke halaman daftar sesi dengan pesan sukses
        return redirect()->route('sessions.index')
                         ->with('success', 'Sesi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu sesi.
     */
    public function show(Session $session) // Laravel akan otomatis menemukan sesi berdasarkan ID di URL
    {
        return view('sessions.show', compact('session')); // Menampilkan view 'sessions.show'
    }

    /**
     * Menampilkan formulir untuk mengedit sesi.
     */
    public function edit(Session $session)
    {
        return view('sessions.edit', compact('session')); // Menampilkan view 'sessions.edit'
    }

    /**
     * Memperbarui sesi di database.
     */
    public function update(Request $request, Session $session)
    {
        // Validasi data yang masuk dari formulir
        $request->validate([
            'nama' => 'required|string|max:255|unique:sessions,nama,' . $session->id, // Nama wajib diisi, string, maks 255, unik (kecuali untuk ID sesi saat ini)
        ]);

        $session->update($request->all()); // Memperbarui record sesi di database

        // Redirect kembali ke halaman daftar sesi dengan pesan sukses
        return redirect()->route('sessions.index')
                         ->with('success', 'Sesi berhasil diperbarui!');
    }

    /**
     * Menghapus sesi dari database.
     */
    public function destroy(Session $session)
    {
        // Pengecekan: Jika ada jadwal yang terkait dengan sesi ini, tidak boleh dihapus
        if ($session->jadwals()->count() > 0) {
            return redirect()->route('sessions.index')
                             ->with('error', 'Tidak dapat menghapus sesi karena ada jadwal yang terkait.');
        }

        $session->delete(); // Menghapus record sesi dari database

        // Redirect kembali ke halaman daftar sesi dengan pesan sukses
        return redirect()->route('sessions.index')
                         ->with('success', 'Sesi berhasil dihapus!');
    }
}
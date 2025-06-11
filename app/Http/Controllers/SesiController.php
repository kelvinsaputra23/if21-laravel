<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:sessions,nama', // Tambahkan unique validation
        ]);

        Session::create($request->all());

        return redirect()->route('sessions.index')
                         ->with('success', 'Sesi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        return view('sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        return view('sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:sessions,nama,' . $session->id, // Tambahkan unique validation dengan pengecualian ID saat ini
        ]);

        $session->update($request->all());

        return redirect()->route('sessions.index')
                         ->with('success', 'Sesi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        // Tambahkan pengecekan jika ada jadwal yang terkait sebelum menghapus sesi
        if ($session->jadwals()->count() > 0) {
            return redirect()->route('sessions.index')
                             ->with('error', 'Tidak dapat menghapus sesi karena ada jadwal yang terkait.');
        }

        $session->delete();

        return redirect()->route('sessions.index')
                         ->with('success', 'Sesi berhasil dihapus!');
    }
}
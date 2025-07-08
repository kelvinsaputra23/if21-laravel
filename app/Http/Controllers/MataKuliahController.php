<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        return response()->json($mataKuliah);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|unique:mata_kuliah|max:255',
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|integer',
        ]);

        $mataKuliah = MataKuliah::create($request->all());
        return response()->json($mataKuliah, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        return response()->json($mataKuliah);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $request->validate([
            'kode_mk' => 'sometimes|required|string|unique:mata_kuliah,kode_mk,' . $id . '|max:255',
            'nama' => 'sometimes|required|string|max:255',
            'prodi_id' => 'sometimes|required|integer',
        ]);

        $mataKuliah->update($request->all());
        return response()->json($mataKuliah);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();
        return response()->json(null, 204);
    }
}
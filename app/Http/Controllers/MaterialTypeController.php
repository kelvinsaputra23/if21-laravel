<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materialTypes = MaterialType::all();
        return view('material_types.index', compact('materialTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:material_types,name',
        ]);

        MaterialType::create($request->all());
        return redirect()->route('material_types.index')->with('success', 'Jenis materi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaterialType $materialType)
    {
        return view('material_types.show', compact('materialType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialType $materialType)
    {
        return view('material_types.edit', compact('materialType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaterialType $materialType)
    {
        $request->validate([
            'name' => 'required|unique:material_types,name,' . $materialType->id,
        ]);

        $materialType->update($request->all());
        return redirect()->route('material_types.index')->with('success', 'Jenis materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialType $materialType)
    {
        $materialType->delete();
        return redirect()->route('material_types.index')->with('success', 'Jenis materi berhasil dihapus.');
    }
}
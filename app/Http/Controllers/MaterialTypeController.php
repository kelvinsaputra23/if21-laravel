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
<<<<<<< HEAD
        return view('material_types.index', compact('materialTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material_types.create');
=======
        return response()->json($materialTypes);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'name' => 'required|unique:material_types,name',
        ]);

        MaterialType::create($request->all());
        return redirect()->route('material_types.index')->with('success', 'Jenis materi berhasil ditambahkan.');
=======
            'name' => 'required|string|unique:material_type|max:255',
        ]);

        $materialType = MaterialType::create($request->all());
        return response()->json($materialType, 201);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Display the specified resource.
     */
<<<<<<< HEAD
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
=======
    public function show(string $id)
    {
        $materialType = MaterialType::findOrFail($id);
        return response()->json($materialType);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, MaterialType $materialType)
    {
        $request->validate([
            'name' => 'required|unique:material_types,name,' . $materialType->id,
        ]);

        $materialType->update($request->all());
        return redirect()->route('material_types.index')->with('success', 'Jenis materi berhasil diperbarui.');
=======
    public function update(Request $request, string $id)
    {
        $materialType = MaterialType::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|unique:material_type,name,' . $id . '|max:255',
        ]);

        $materialType->update($request->all());
        return response()->json($materialType);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy(MaterialType $materialType)
    {
        $materialType->delete();
        return redirect()->route('material_types.index')->with('success', 'Jenis materi berhasil dihapus.');
    }
}
=======
    public function destroy(string $id)
    {
        $materialType = MaterialType::findOrFail($id);
        $materialType->delete();
        return response()->json(null, 204);
    }
}
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3

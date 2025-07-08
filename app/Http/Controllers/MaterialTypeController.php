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
        return response()->json($materialTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:material_type|max:255',
        ]);

        $materialType = MaterialType::create($request->all());
        return response()->json($materialType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $materialType = MaterialType::findOrFail($id);
        return response()->json($materialType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $materialType = MaterialType::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|unique:material_type,name,' . $id . '|max:255',
        ]);

        $materialType->update($request->all());
        return response()->json($materialType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $materialType = MaterialType::findOrFail($id);
        $materialType->delete();
        return response()->json(null, 204);
    }
}

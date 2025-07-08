<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::with(['course', 'materialType'])->get();
        return response()->json($materials);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'material_type_id' => 'required|integer|exists:material_type,id',
            'title' => 'required|string|max:255',
            'file_path' => 'nullable|string', // Consider file upload logic if needed
            'url' => 'nullable|url',
            'description' => 'nullable|string',
            'uploaded_by_dosen_id' => 'nullable|integer', // Validate against users table if applicable
        ]);

        $material = Material::create($request->all());
        return response()->json($material, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Material::with(['course', 'materialType'])->findOrFail($id);
        return response()->json($material);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);
        $request->validate([
            'course_id' => 'sometimes|required|integer|exists:courses,id',
            'material_type_id' => 'sometimes|required|integer|exists:material_type,id',
            'title' => 'sometimes|required|string|max:255',
            'file_path' => 'nullable|string',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
            'uploaded_by_dosen_id' => 'nullable|integer',
        ]);

        $material->update($request->all());
        return response()->json($material);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return response()->json(null, 204);
    }
}
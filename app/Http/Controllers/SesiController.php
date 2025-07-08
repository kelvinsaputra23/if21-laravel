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
        $sesi = Sesi::all();
        return response()->json($sesi);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $sesi = Sesi::create($request->all());
        return response()->json($sesi, 201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sesi = Sesi::findOrFail($id);
        return response()->json($sesi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sesi = Sesi::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $sesi->update($request->all());
        return response()->json($sesi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sesi = Sesi::findOrFail($id);
        $sesi->delete();
        return response()->json(null, 204); // 204 No Content
    }
}
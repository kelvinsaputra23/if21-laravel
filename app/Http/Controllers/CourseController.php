<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
<<<<<<< HEAD
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
=======
        return response()->json($courses);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'kode_mk' => 'required|unique:courses,kode_mk',
            'nama' => 'required',
            'prodi_id' => 'nullable|exists:prodi,id', // Sesuaikan jika ada tabel prodi
        ]);

        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
=======
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course = Course::create($request->all());
        return response()->json($course, 201);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Display the specified resource.
     */
<<<<<<< HEAD
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
=======
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'kode_mk' => 'required|unique:courses,kode_mk,' . $course->id,
            'nama' => 'required',
            'prodi_id' => 'nullable|exists:prodi,id',
        ]);

        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil diperbarui.');
=======
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course->update($request->all());
        return response()->json($course);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil dihapus.');
=======
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json(null, 204);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }
}
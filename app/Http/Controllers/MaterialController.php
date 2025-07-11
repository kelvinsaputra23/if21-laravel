<?php

namespace App\Http\Controllers;

use App\Models\Material;
<<<<<<< HEAD
use App\Models\Course; // Import model Course agar bisa digunakan di controller ini
use App\Models\MaterialType; // Import model MaterialType agar bisa digunakan di controller ini
use Illuminate\Http\Request; // Import Request untuk menangani input dari form
=======
use Illuminate\Http\Request;
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
<<<<<<< HEAD
     * Menampilkan daftar semua materi.
     */
    public function index()
    {
        // Mengambil semua materi beserta relasi 'course' (mata kuliah) dan 'materialType' (jenis materi)
        // Ini memastikan data terkait juga diambil untuk ditampilkan di view.
        $materials = Material::with(['course', 'materialType'])->get();

        // Mengirim data materi ke view 'materials.index'
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan formulir untuk membuat materi baru.
     */
    public function create()
    {
        // Mengambil semua data course (mata kuliah) untuk dropdown di formulir
        $courses = Course::all();
        // Mengambil semua data materialType (jenis materi) untuk dropdown di formulir
        $materialTypes = MaterialType::all();

        // Mengirim data courses dan materialTypes ke view 'materials.create'
        return view('materials.create', compact('courses', 'materialTypes'));
=======
     */
    public function index()
    {
        $materials = Material::with(['course', 'materialType'])->get();
        return response()->json($materials);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Store a newly created resource in storage.
<<<<<<< HEAD
     * Menyimpan materi baru ke database.
     */
    public function store(Request $request)
    {
        // Melakukan validasi data yang dikirim dari formulir
        $request->validate([
            'course_id' => 'required|exists:courses,id', // Harus ada dan ID-nya harus ada di tabel 'courses'
            'title' => 'required|string|max:255', // Judul harus diisi, string, maksimal 255 karakter
            'description' => 'nullable|string', // Deskripsi boleh kosong, jika ada harus string
            'material_type_id' => 'required|exists:material_types,id', // Harus ada dan ID-nya harus ada di tabel 'material_types'
        ]);

        // Membuat record materi baru di database menggunakan semua data yang sudah divalidasi
        Material::create($request->all());

        // Mengarahkan kembali ke halaman index materi dengan pesan sukses
        return redirect()->route('materials.index')->with('success', 'Materi berhasil ditambahkan.');
=======
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
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Display the specified resource.
<<<<<<< HEAD
     * Menampilkan detail dari satu materi tertentu.
     */
    public function show(Material $material)
    {
        // Memuat relasi 'course', 'materialType', dan 'materialFiles' untuk materi yang spesifik.
        // Ini memastikan semua data terkait (mata kuliah, jenis materi, dan file-file materi)
        // tersedia di view detail.
        $material->load(['course', 'materialType', 'materialFiles']);

        // Mengirim data materi ke view 'materials.show'
        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan formulir untuk mengedit materi yang sudah ada.
     */
    public function edit(Material $material)
    {
        // Mengambil semua data course untuk dropdown di formulir edit
        $courses = Course::all();
        // Mengambil semua data materialType untuk dropdown di formulir edit
        $materialTypes = MaterialType::all();

        // Mengirim data materi yang akan diedit, courses, dan materialTypes ke view 'materials.edit'
        return view('materials.edit', compact('material', 'courses', 'materialTypes'));
=======
     */
    public function show(string $id)
    {
        $material = Material::with(['course', 'materialType'])->findOrFail($id);
        return response()->json($material);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Update the specified resource in storage.
<<<<<<< HEAD
     * Memperbarui materi yang sudah ada di database.
     */
    public function update(Request $request, Material $material)
    {
        // Melakukan validasi data yang dikirim dari formulir edit
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material_type_id' => 'required|exists:material_types,id',
        ]);

        // Memperbarui record materi yang sudah ada di database dengan data yang divalidasi
        $material->update($request->all());

        // Mengarahkan kembali ke halaman index materi dengan pesan sukses
        return redirect()->route('materials.index')->with('success', 'Materi berhasil diperbarui.');
=======
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
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }

    /**
     * Remove the specified resource from storage.
<<<<<<< HEAD
     * Menghapus materi dari database.
     */
    public function destroy(Material $material)
    {
        // Menghapus record materi dari database
        $material->delete();

        // Mengarahkan kembali ke halaman index materi dengan pesan sukses
        return redirect()->route('materials.index')->with('success', 'Materi berhasil dihapus.');
=======
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return response()->json(null, 204);
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3
    }
}
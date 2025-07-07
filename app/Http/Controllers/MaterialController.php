<?php

namespace App\Http\Controllers;

use App\Models\Material; // Penting: Pastikan model Material di-import
use App\Models\Course; // Penting: Pastikan model Course di-import
use App\Models\MaterialType; // Penting: Pastikan model MaterialType di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting: Untuk operasi file (simpan/hapus)

class MaterialController extends Controller
{
    /**
     * Menampilkan daftar semua materi.
     */
    public function index()
    {
        // Ambil semua materi beserta relasi course dan file-nya
        // 'files.type' artinya ambil files, dan di dalam files, ambil relasi 'type'
        $materials = Material::with(['course', 'files.type'])->get();
        return view('materials.index', compact('materials'));
    }

    /**
     * Menampilkan form untuk membuat materi baru.
     */
    public function create()
    {
        // Ambil semua mata kuliah dan jenis materi untuk dropdown di form
        $courses = Course::all();
        $materialTypes = MaterialType::all();
        return view('materials.create', compact('courses', 'materialTypes'));
    }

    /**
     * Menyimpan materi baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id', // Pastikan course_id ada di tabel courses
            // Validasi untuk setiap file yang diupload (menggunakan wildcard '*')
            'material_files.*.type_id' => 'required|exists:material_types,id', // Pastikan type_id ada di tabel material_types
            'material_files.*.file' => 'required|file|mimes:pdf,mp4,doc,docx,ppt,pptx,json,txt,png,jpg,jpeg,gif,mp3,wav|max:20480', // Maks 20MB (20480 KB)
        ]);

        // Buat entri materi baru di tabel 'materials'
        $material = Material::create([
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
        ]);

        // Proses upload file jika ada file yang diunggah
        if ($request->hasFile('material_files')) {
            foreach ($request->file('material_files') as $key => $file) {
                // Simpan file ke direktori 'materials' di storage/app/public
                // 'public' adalah disk yang didefinisikan di config/filesystems.php
                $filePath = $file->store('materials', 'public');

                // Simpan path file dan jenisnya ke tabel 'material_files'
                $material->files()->create([
                    'material_type_id' => $request->input('material_files')[$key]['type_id'],
                    'file_path' => $filePath,
                ]);
            }
        }

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('materials.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail materi tertentu.
     * Menggunakan Route Model Binding: Laravel secara otomatis mencari Material berdasarkan ID.
     */
    public function show(Material $material) // Parameter diubah dari string $id menjadi Material $material
    {
        // Load relasi 'course' dan 'files.type' agar data lengkap tersedia di view
        $material->load(['course', 'files.type']);
        return view('materials.show', compact('material'));
    }

    /**
     * Menampilkan form untuk mengedit materi.
     * Menggunakan Route Model Binding.
     */
    public function edit(Material $material) // Parameter diubah dari string $id menjadi Material $material
    {
        $courses = Course::all(); // Ambil semua mata kuliah
        $materialTypes = MaterialType::all(); // Ambil semua jenis materi
        $material->load('files'); // Load file yang sudah ada untuk ditampilkan di form edit
        return view('materials.edit', compact('material', 'courses', 'materialTypes'));
    }

    /**
     * Memperbarui materi di database.
     * Menggunakan Route Model Binding.
     */
    public function update(Request $request, Material $material) // Parameter diubah dari string $id menjadi Material $material
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            // 'sometimes' berarti validasi ini hanya berlaku jika file diupload
            'material_files.*.type_id' => 'sometimes|exists:material_types,id',
            'material_files.*.file' => 'sometimes|file|mimes:pdf,mp4,doc,docx,ppt,pptx,json,txt,png,jpg,jpeg,gif,mp3,wav|max:20480',
        ]);

        // Perbarui data materi utama
        $material->update([
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
        ]);

        // Hapus file lama jika ada yang ditandai untuk dihapus (dari hidden input 'deleted_files' di view)
        if ($request->has('deleted_files')) {
            $deletedFileIds = json_decode($request->input('deleted_files')); // Decode string JSON menjadi array PHP
            if (is_array($deletedFileIds)) {
                foreach ($deletedFileIds as $fileId) {
                    $fileToDelete = $material->files()->find($fileId); // Cari file berdasarkan ID
                    if ($fileToDelete) {
                        Storage::disk('public')->delete($fileToDelete->file_path); // Hapus file fisik dari storage
                        $fileToDelete->delete(); // Hapus entri dari database
                    }
                }
            }
        }

        // Tambahkan file baru jika ada yang diupload
        if ($request->hasFile('material_files')) {
            foreach ($request->file('material_files') as $key => $file) {
                // Pastikan file valid sebelum disimpan
                if ($file && $file->isValid()) {
                    $filePath = $file->store('materials', 'public');
                    $material->files()->create([
                        'material_type_id' => $request->input('material_files')[$key]['type_id'],
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        return redirect()->route('materials.index')->with('success', 'Materi berhasil diperbarui!');
    }

    /**
     * Menghapus materi dari database.
     * Menggunakan Route Model Binding.
     */
    public function destroy(Material $material) // Parameter diubah dari string $id menjadi Material $material
    {
        // Hapus semua file terkait dari storage sebelum menghapus entri materi dari database
        foreach ($material->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }
        // Hapus materi dari database. Karena kita menggunakan onDelete('cascade') di migrasi,
        // semua entri terkait di tabel 'material_files' akan otomatis terhapus juga.
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Materi berhasil dihapus!');
    }
}
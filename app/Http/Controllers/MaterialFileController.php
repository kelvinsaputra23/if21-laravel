<?php

namespace App\Http\Controllers;

use App\Models\MaterialFile;
use App\Models\Material;     // Import model Material
use App\Models\MaterialType;  // Import model MaterialType (Tambahan: agar bisa dipakai di create/edit)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk upload dan manajemen file

class MaterialFileController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua file materi.
     */
    public function index()
    {
        // Mengambil semua file materi beserta relasi 'material' (materi) dan 'materialType' (jenis materi)
        // Ini memastikan data terkait juga diambil untuk ditampilkan di view 'index'.
        $materialFiles = MaterialFile::with(['material', 'material.materialType'])->get(); // Load material dan materialType dari material
        return view('material_files.index', compact('materialFiles'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan formulir untuk mengunggah file materi baru.
     */
    public function create()
    {
        // Mengambil semua data materi untuk dropdown di formulir
        $materials = Material::all();
        // Mengambil semua data jenis materi untuk dropdown di formulir
        $materialTypes = MaterialType::all();

        // Mengirim data materials dan materialTypes ke view 'material_files.create'
        return view('material_files.create', compact('materials', 'materialTypes'));
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan file materi baru ke storage dan database.
     */
    public function store(Request $request)
    {
        // Melakukan validasi data yang dikirim dari formulir
        $request->validate([
            'material_id' => 'required|exists:materials,id', // Harus ada dan ID-nya harus ada di tabel 'materials'
            'material_type_id' => 'required|exists:material_types,id', // Harus ada dan ID-nya harus ada di tabel 'material_types'
            'file' => 'required|file|max:10240', // File harus ada, bertipe file, dan maksimal 10MB (10240 KB)
        ]);

        // Menyimpan file yang diunggah ke direktori 'materials' di dalam disk 'public'
        // dan mendapatkan path relatifnya.
        $filePath = $request->file('file')->store('materials', 'public');
        // Mendapatkan nama asli file yang diunggah oleh pengguna
        $fileName = $request->file('file')->getClientOriginalName();
        // Mendapatkan ukuran file dalam bytes
        $fileSize = $request->file('file')->getSize();
        // Mendapatkan MIME type dari file
        $fileMime = $request->file('file')->getClientMimeType();


        // Membuat record baru di tabel 'material_files' dengan informasi file
        MaterialFile::create([
            'material_id' => $request->material_id,
            'material_type_id' => $request->material_type_id, // Tambahan: simpan material_type_id
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize, // Tambahan: simpan ukuran file
            'file_mime' => $fileMime, // Tambahan: simpan mime type file
        ]);

        // Mengarahkan kembali ke halaman index file materi dengan pesan sukses
        return redirect()->route('material_files.index')->with('success', 'File materi berhasil diunggah.');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail dari satu file materi tertentu.
     */
    public function show(MaterialFile $materialFile)
    {
        // Memuat relasi 'material' dan 'materialType' untuk file materi yang spesifik.
        $materialFile->load(['material', 'materialType']);
        return view('material_files.show', compact('materialFile'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan formulir untuk mengedit file materi yang sudah ada.
     */
    public function edit(MaterialFile $materialFile)
    {
        // Mengambil semua data materi untuk dropdown di formulir edit
        $materials = Material::all();
        // Mengambil semua data jenis materi untuk dropdown di formulir edit
        $materialTypes = MaterialType::all();

        // Mengirim data file materi yang akan diedit, materials, dan materialTypes ke view 'material_files.edit'
        return view('material_files.edit', compact('materialFile', 'materials', 'materialTypes'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui file materi yang sudah ada di storage dan database.
     */
    public function update(Request $request, MaterialFile $materialFile)
    {
        // Melakukan validasi data yang dikirim dari formulir edit
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'material_type_id' => 'required|exists:material_types,id', // Tambahan: validasi material_type_id
            'file' => 'nullable|file|max:10240', // File boleh kosong (jika tidak ingin diganti), jika ada harus bertipe file dan maksimal 10MB
        ]);

        // Mempersiapkan data untuk update
        $dataToUpdate = $request->only(['material_id', 'material_type_id']); // Ambil hanya kolom yang boleh diupdate

        // Jika ada file baru diunggah
        if ($request->hasFile('file')) {
            // Hapus file lama dari storage jika ada
            if ($materialFile->file_path && Storage::disk('public')->exists($materialFile->file_path)) {
                Storage::disk('public')->delete($materialFile->file_path);
            }

            // Simpan file baru ke storage
            $filePath = $request->file('file')->store('materials', 'public');
            $fileName = $request->file('file')->getClientOriginalName();
            $fileSize = $request->file('file')->getSize();
            $fileMime = $request->file('file')->getClientMimeType();

            // Tambahkan informasi file baru ke dataToUpdate
            $dataToUpdate['file_path'] = $filePath;
            $dataToUpdate['file_name'] = $fileName;
            $dataToUpdate['file_size'] = $fileSize;
            $dataToUpdate['file_mime'] = $fileMime;
        }

        // Memperbarui record materialFile di database dengan dataToUpdate
        $materialFile->update($dataToUpdate);

        // Mengarahkan kembali ke halaman index file materi dengan pesan sukses
        return redirect()->route('material_files.index')->with('success', 'File materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus file materi dari storage dan database.
     */
    public function destroy(MaterialFile $materialFile)
    {
        // Hapus file dari storage jika file_path ada dan file tersebut ada di disk 'public'
        if ($materialFile->file_path && Storage::disk('public')->exists($materialFile->file_path)) {
            Storage::disk('public')->delete($materialFile->file_path);
        }

        // Menghapus record materialFile dari database
        $materialFile->delete();

        // Mengarahkan kembali ke halaman index file materi dengan pesan sukses
        return redirect()->route('material_files.index')->with('success', 'File materi berhasil dihapus.');
    }

    /**
     * Metode untuk mengunduh file.
     * Mengirimkan file dari storage ke browser untuk diunduh.
     */
    public function download(MaterialFile $materialFile)
    {
        // Memastikan file ada di storage sebelum mencoba mengunduhnya
        if (Storage::disk('public')->exists($materialFile->file_path)) {
            return Storage::disk('public')->download($materialFile->file_path, $materialFile->file_name);
        }

        // Jika file tidak ditemukan, arahkan kembali dengan pesan error
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
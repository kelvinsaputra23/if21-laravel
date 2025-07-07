<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material; // Penting: Pastikan model Material di-import
use App\Models\MaterialFile; // Penting: Pastikan model MaterialFile di-import
use App\Models\Course; // Penting: Pastikan model Course di-import
use App\Models\MaterialType; // Penting: Pastikan model MaterialType di-import

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Panggil seeder lain yang dibutuhkan agar data relasi tersedia
        // Ini memastikan foreign key yang akan kita gunakan sudah ada.
        $this->call([
            CourseSeeder::class,
            MaterialTypeSeeder::class,
        ]);

        // Ambil data dari seeder Course dan MaterialType yang sudah ada
        // Pastikan nama dan kode/nama tipe sesuai dengan yang Anda definisikan di seeder masing-masing
        $courseAlgo = Course::where('code', 'IF212')->first();
        $courseDB = Course::where('code', 'IF213')->first();
        $courseWeb = Course::where('code', 'IF215')->first();
        $typePDF = MaterialType::where('name', 'PDF')->first();
        $typeVideo = MaterialType::where('name', 'Video')->first();
        $typeQuiz = MaterialType::where('name', 'Quiz')->first();
        $typeDoc = MaterialType::where('name', 'Dokumen')->first();
        $typeImage = MaterialType::where('name', 'Gambar')->first();

        // Lakukan pengecekan sederhana apakah data relasi ditemukan.
        // Jika salah satu null, berarti seeder sebelumnya mungkin belum berjalan atau data tidak sesuai.
        if (!$courseAlgo || !$courseDB || !$courseWeb || !$typePDF || !$typeVideo || !$typeQuiz || !$typeDoc || !$typeImage) {
            echo "Peringatan: Beberapa data Course atau MaterialType tidak ditemukan. MaterialSeeder mungkin tidak dapat membuat semua data contoh.\n";
            return; // Hentikan jika ada data relasi yang tidak ditemukan
        }

        // --- Data Materi Pembelajaran Contoh ---

        // Materi 1: Pengantar Algoritma (Memiliki 1 file PDF)
        $material1 = Material::firstOrCreate(
            ['title' => 'Pengantar Algoritma'], // Kriteria untuk mencari materi yang sudah ada
            [
                'description' => 'Materi pengantar untuk memahami konsep dasar algoritma dan pemecahan masalah dalam ilmu komputer.',
                'course_id' => $courseAlgo->id, // Hubungkan dengan mata kuliah Algoritma
            ]
        );
        // Tambahkan file untuk materi ini
        MaterialFile::firstOrCreate(
            ['material_id' => $material1->id, 'file_path' => 'materials/algoritma/pengantar_algoritma.pdf'],
            ['material_type_id' => $typePDF->id] // Tipe file: PDF
        );

        // Materi 2: Dasar-dasar Database (Memiliki 1 file Video)
        $material2 = Material::firstOrCreate(
            ['title' => 'Dasar-dasar Database'],
            [
                'description' => 'Meliputi konsep-konsep inti dalam sistem manajemen basis data relasional, termasuk normalisasi, DDL, dan DML.',
                'course_id' => $courseDB->id, // Hubungkan dengan mata kuliah Sistem Basis Data
            ]
        );
        MaterialFile::firstOrCreate(
            ['material_id' => $material2->id, 'file_path' => 'materials/database/dasar_database_video.mp4'],
            ['material_type_id' => $typeVideo->id] // Tipe file: Video
        );

        // Materi 3: Struktur Data Lanjut (Memiliki 1 file PDF dan 1 file Quiz)
        $material3 = Material::firstOrCreate(
            ['title' => 'Struktur Data Lanjut'],
            [
                'description' => 'Pembahasan mendalam tentang berbagai jenis struktur data seperti pohon biner, graf, hash table, dan algoritma pengurutan.',
                'course_id' => $courseAlgo->id, // Hubungkan dengan mata kuliah Algoritma
            ]
        );
        MaterialFile::firstOrCreate(
            ['material_id' => $material3->id, 'file_path' => 'materials/strukturdata/struktur_data_lanjut.pdf'],
            ['material_type_id' => $typePDF->id]
        );
        MaterialFile::firstOrCreate(
            ['material_id' => $material3->id, 'file_path' => 'materials/strukturdata/quiz_struktur_data.json'],
            ['material_type_id' => $typeQuiz->id]
        );

        // Materi 4: Pengantar HTML & CSS (Memiliki 1 file Dokumen dan 1 file Gambar)
        $material4 = Material::firstOrCreate(
            ['title' => 'Pengantar HTML & CSS'],
            [
                'description' => 'Materi dasar untuk membangun struktur dan gaya halaman web menggunakan HTML (HyperText Markup Language) dan CSS (Cascading Style Sheets).',
                'course_id' => $courseWeb->id, // Hubungkan dengan mata kuliah Pemrograman Web Lanjut
            ]
        );
        MaterialFile::firstOrCreate(
            ['material_id' => $material4->id, 'file_path' => 'materials/web/pengantar_html_css.doc'],
            ['material_type_id' => $typeDoc->id]
        );
        MaterialFile::firstOrCreate(
            ['material_id' => $material4->id, 'file_path' => 'materials/web/css_cheatsheet.png'],
            ['material_type_id' => $typeImage->id]
        );
    }
}
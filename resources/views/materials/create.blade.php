<<<<<<< HEAD
@extends('layouts.app')

@section('content')
    <h1>Tambah Materi Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materials.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Materi:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="course_id" class="form-label">Mata Kuliah:</label>
            <select class="form-control" id="course_id" name="course_id" required>
                <option value="">Pilih Mata Kuliah</option>
                @foreach($courses as $course) {{-- Asumsi $courses dikirim dari controller --}}
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Materi Baru</h1>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Materi</a>

        <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Judul Materi:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="course_id" class="form-label">Mata Kuliah:</label>
                <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                    <option value="">Pilih Mata Kuliah</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }} ({{ $course->code }})
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <h4>File Materi</h4>
            <div id="material-files-container">
                <div class="row mb-3 material-file-item border p-3 rounded">
                    <div class="col-md-5">
                        <label for="material_files_0_file" class="form-label">Pilih File:</label>
                        <input type="file" class="form-control @error('material_files.0.file') is-invalid @enderror" id="material_files_0_file" name="material_files[0][file]">
                        @error('material_files.0.file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-5">
                        <label for="material_files_0_type_id" class="form-label">Jenis File:</label>
                        <select class="form-select @error('material_files.0.type_id') is-invalid @enderror" id="material_files_0_type_id" name="material_files[0][type_id]">
                            <option value="">Pilih Jenis</option>
                            @foreach ($materialTypes as $type)
                                <option value="{{ $type->id }}" {{ old('material_files.0.type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('material_files.0.type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-file-btn" style="display: none;">Hapus</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mt-2" id="add-file-btn">Tambah File Lain</button>

            <button type="submit" class="btn btn-success mt-4">Simpan Materi</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivrieliver.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let fileCounter = 1;
            const addFileBtn = document.getElementById('add-file-btn');
            const fileContainer = document.getElementById('material-files-container');

            addFileBtn.addEventListener('click', function () {
                const newItem = document.createElement('div');
                newItem.classList.add('row', 'mb-3', 'material-file-item', 'border', 'p-3', 'rounded');
                newItem.innerHTML = `
                    <div class="col-md-5">
                        <label for="material_files_${fileCounter}_file" class="form-label">Pilih File:</label>
                        <input type="file" class="form-control" id="material_files_${fileCounter}_file" name="material_files[${fileCounter}][file]">
                    </div>
                    <div class="col-md-5">
                        <label for="material_files_${fileCounter}_type_id" class="form-label">Jenis File:</label>
                        <select class="form-select" id="material_files_${fileCounter}_type_id" name="material_files[${fileCounter}][type_id]">
                            <option value="">Pilih Jenis</option>
                            @foreach ($materialTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-file-btn">Hapus</button>
                    </div>
                `;
                fileContainer.appendChild(newItem);
                fileCounter++;

                // Tampilkan tombol hapus untuk item yang baru ditambahkan
                newItem.querySelector('.remove-file-btn').style.display = 'block';
                // Tampilkan tombol hapus untuk item pertama jika sebelumnya disembunyikan
                if (fileContainer.children.length > 1 && fileContainer.children[0].querySelector('.remove-file-btn').style.display === 'none') {
                    fileContainer.children[0].querySelector('.remove-file-btn').style.display = 'block';
                }
            });

            fileContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-file-btn')) {
                    e.target.closest('.material-file-item').remove();
                    // Sembunyikan tombol hapus jika hanya tersisa satu item
                    if (fileContainer.children.length === 1) {
                        fileContainer.children[0].querySelector('.remove-file-btn').style.display = 'none';
                    }
                }
            });

            // Sembunyikan tombol hapus jika hanya ada satu item saat halaman dimuat
            if (fileContainer.children.length === 1) {
                fileContainer.children[0].querySelector('.remove-file-btn').style.display = 'none';
            }
        });
    </script>
</body>
</html>
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3

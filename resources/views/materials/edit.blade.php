<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Materi: {{ $material->title }}</h1>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Materi</a>

        <form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting: Gunakan metode PUT untuk update --}}

            <div class="mb-3">
                <label for="title" class="form-label">Judul Materi:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $material->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $material->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="course_id" class="form-label">Mata Kuliah:</label>
                <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                    <option value="">Pilih Mata Kuliah</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $material->course_id) == $course->id ? 'selected' : '' }}>
                            {{ $course->name }} ({{ $course->code }})
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <h4>File Materi Saat Ini</h4>
            <div id="existing-files-container">
                <input type="hidden" name="deleted_files" id="deleted_files" value="[]"> {{-- Input tersembunyi untuk menyimpan ID file yang akan dihapus --}}
                @forelse ($material->files as $file)
                    <div class="row mb-2 existing-file-item border p-2 rounded align-items-center" data-file-id="{{ $file->id }}">
                        <div class="col-md-8">
                            <strong>{{ $file->type->name ?? 'N/A' }}:</strong> {{ basename($file->file_path) }}
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="{{ Storage::url($file->file_path) }}" class="btn btn-info btn-sm" target="_blank">Lihat</a>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn btn-danger btn-sm remove-existing-file-btn">Hapus</button>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Tidak ada file yang terkait dengan materi ini.</p>
                @endforelse
            </div>

            <hr>
            <h4>Tambah File Materi Baru</h4>
            <div id="new-material-files-container">
                {{-- Template untuk file baru (akan ditambahkan via JS) --}}
            </div>
            <button type="button" class="btn btn-secondary mt-2" id="add-new-file-btn">Tambah File Baru</button>

            <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let newFileCounter = 0;
            const addNewFileBtn = document.getElementById('add-new-file-btn');
            const newFileContainer = document.getElementById('new-material-files-container');
            const existingFilesContainer = document.getElementById('existing-files-container');
            const deletedFilesInput = document.getElementById('deleted_files');
            let deletedFileIds = JSON.parse(deletedFilesInput.value);

            // Fungsi untuk menambahkan input file baru
            addNewFileBtn.addEventListener('click', function () {
                const newItem = document.createElement('div');
                newItem.classList.add('row', 'mb-3', 'new-material-file-item', 'border', 'p-3', 'rounded');
                newItem.innerHTML = `
                    <div class="col-md-5">
                        <label for="material_files_${newFileCounter}_file" class="form-label">Pilih File Baru:</label>
                        <input type="file" class="form-control" id="material_files_${newFileCounter}_file" name="material_files[${newFileCounter}][file]">
                    </div>
                    <div class="col-md-5">
                        <label for="material_files_${newFileCounter}_type_id" class="form-label">Jenis File Baru:</label>
                        <select class="form-select" id="material_files_${newFileCounter}_type_id" name="material_files[${newFileCounter}][type_id]">
                            <option value="">Pilih Jenis</option>
                            @foreach ($materialTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-new-file-btn">Hapus</button>
                    </div>
                `;
                newFileContainer.appendChild(newItem);
                newFileCounter++;
            });

            // Event listener untuk menghapus file baru yang baru di tambahkan
            newFileContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-new-file-btn')) {
                    e.target.closest('.new-material-file-item').remove();
                }
            });

            // Event listener untuk menghapus file lama yang sudah ada
            existingFilesContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-existing-file-btn')) {
                    const itemToRemove = e.target.closest('.existing-file-item');
                    const fileId = itemToRemove.dataset.fileId; // Ambil ID file dari data-attribute

                    if (fileId && !deletedFileIds.includes(parseInt(fileId))) {
                        deletedFileIds.push(parseInt(fileId));
                        deletedFilesInput.value = JSON.stringify(deletedFileIds); // Update hidden input
                        itemToRemove.remove(); // Hapus elemen dari DOM
                    }
                }
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Detail Materi: {{ $material->title }}</h1>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary mb-4">Kembali ke Daftar Materi</a>

        <div class="card mb-3">
            <div class="card-header">
                Informasi Materi
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $material->title }}</h5>
                <p class="card-text"><strong>Mata Kuliah:</strong> {{ $material->course->name ?? 'N/A' }} ({{ $material->course->code ?? 'N/A' }})</p>
                <p class="card-text"><strong>Deskripsi:</strong> {{ $material->description ?? '-' }}</p>
                <p class="card-text"><small class="text-muted">Dibuat: {{ $material->created_at->format('d M Y H:i') }}</small></p>
                <p class="card-text"><small class="text-muted">Terakhir Diperbarui: {{ $material->updated_at->format('d M Y H:i') }}</small></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                File Materi
            </div>
            <ul class="list-group list-group-flush">
                @forelse ($material->files as $file)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Tipe:</strong> {{ $file->type->name ?? 'N/A' }} <br>
                            <strong>Nama File:</strong> {{ basename($file->file_path) }}
                        </div>
                        <a href="{{ Storage::url($file->file_path) }}" class="btn btn-success btn-sm" target="_blank">Unduh / Lihat</a>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted">Tidak ada file terkait dengan materi ini.</li>
                @endforelse
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Edit Materi</a>
            <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus Materi</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
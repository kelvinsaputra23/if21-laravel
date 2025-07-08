<<<<<<< HEAD
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Materi</h1>
        <a href="{{ route('materials.create') }}" class="btn btn-primary">Tambah Materi</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Materi</th>
                <th>Deskripsi</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->title }}</td>
                    <td>{{ Str::limit($material->description, 50) }}</td>
                    <td>{{ $material->course->nama ?? 'N/A' }}</td> {{-- Asumsi relasi ke Course --}}
                    <td>
                        <a href="{{ route('materials.show', $material->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('materials.destroy', $material->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Materi</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Tambah Materi Baru</a>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Mata Kuliah</th>
                    <th>Deskripsi</th>
                    <th>Jumlah File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materials as $material)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $material->title }}</td>
                        <td>{{ $material->course->name ?? 'N/A' }}</td>
                        <td>{{ Str::limit($material->description, 50, '...') }}</td>
                        <td>{{ $material->files->count() }}</td>
                        <td>
                            <a href="{{ route('materials.show', $material->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada materi ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> e519eba6a3a4fe01c3862f2883b7f4ccf85217b3

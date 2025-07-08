@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar File Materi</h1>
        <a href="{{ route('material_files.create') }}" class="btn btn-primary">Upload File Materi</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama File</th>
                <th>Ukuran (KB)</th>
                <th>Jenis File</th>
                <th>Materi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materialFiles as $materialFile)
                <tr>
                    <td>{{ $materialFile->id }}</td>
                    <td>{{ $materialFile->filename }}</td>
                    <td>{{ round($materialFile->filesize / 1024, 2) }}</td> {{-- Convert bytes to KB --}}
                    <td>{{ $materialFile->materialType->name ?? 'N/A' }}</td> {{-- Asumsi relasi ke MaterialType --}}
                    <td>{{ $materialFile->material->title ?? 'N/A' }}</td> {{-- Asumsi relasi ke Material --}}
                    <td>
                        <a href="{{ route('material_files.show', $materialFile->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('material_files.edit', $materialFile->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('material_files.download', $materialFile->id) }}" class="btn btn-success btn-sm">Download</a>
                        <form action="{{ route('material_files.destroy', $materialFile->id) }}" method="POST" style="display:inline-block;">
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
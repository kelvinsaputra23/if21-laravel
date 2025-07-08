@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Jenis Materi</h1>
        <a href="{{ route('material_types.create') }}" class="btn btn-primary">Tambah Jenis Materi</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materialTypes as $materialType)
                <tr>
                    <td>{{ $materialType->id }}</td>
                    <td>{{ $materialType->name }}</td>
                    <td>
                        <a href="{{ route('material_types.show', $materialType->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('material_types.edit', $materialType->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('material_types.destroy', $materialType->id) }}" method="POST" style="display:inline-block;">
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
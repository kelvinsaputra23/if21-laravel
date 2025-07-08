@extends('layouts.app')

@section('content')
    <h1>Upload File Materi Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('material_files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="material_id" class="form-label">Pilih Materi:</label>
            <select class="form-control" id="material_id" name="material_id" required>
                <option value="">Pilih Materi</option>
                @foreach($materials as $material) {{-- Asumsi $materials dikirim dari controller --}}
                    <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>{{ $material->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="material_type_id" class="form-label">Jenis File:</label>
            <select class="form-control" id="material_type_id" name="material_type_id" required>
                <option value="">Pilih Jenis File</option>
                @foreach($materialTypes as $materialType) {{-- Asumsi $materialTypes dikirim dari controller --}}
                    <option value="{{ $materialType->id }}" {{ old('material_type_id') == $materialType->id ? 'selected' : '' }}>{{ $materialType->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Pilih File:</label>
            <input type="file" class="form-control" id="file" name="file" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
        <a href="{{ route('material_files.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
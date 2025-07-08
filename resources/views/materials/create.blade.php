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
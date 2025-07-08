@extends('layouts.app')

@section('content')
    <h1>Edit Mata Kuliah</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_mk" class="form-label">Kode Mata Kuliah:</label>
            <input type="text" class="form-control" id="kode_mk" name="kode_mk" value="{{ old('kode_mk', $course->kode_mk) }}" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mata Kuliah:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $course->nama) }}" required>
        </div>
        <div class="mb-3">
            <label for="prodi_id" class="form-label">Prodi ID:</label>
            <input type="number" class="form-control" id="prodi_id" name="prodi_id" value="{{ old('prodi_id', $course->prodi_id) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
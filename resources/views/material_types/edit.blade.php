@extends('layouts.app')

@section('content')
    <h1>Edit Jenis Materi</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('material_types.update', $materialType->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Jenis Materi:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $materialType->name) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('material_types.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
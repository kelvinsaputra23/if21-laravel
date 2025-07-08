@extends('layouts.app')

@section('content')
    <h1>Detail Materi</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $material->title }}</h5>
            <p class="card-text">
                <strong>ID:</strong> {{ $material->id }}<br>
                <strong>Judul:</strong> {{ $material->title }}<br>
                <strong>Deskripsi:</strong> {{ $material->description }}<br>
                <strong>Mata Kuliah:</strong> {{ $material->course->nama ?? 'N/A' }}<br>
                <strong>Dibuat Pada:</strong> {{ $material->created_at->format('d M Y H:i') }}<br>
                <strong>Diperbarui Pada:</strong> {{ $material->updated_at->format('d M Y H:i') }}
            </p>
            <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
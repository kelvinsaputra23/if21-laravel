@extends('layouts.app')

@section('content')
    <h1>Detail Jenis Materi</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $materialType->name }}</h5>
            <p class="card-text">
                <strong>ID:</strong> {{ $materialType->id }}<br>
                <strong>Nama Jenis:</strong> {{ $materialType->name }}<br>
                <strong>Dibuat Pada:</strong> {{ $materialType->created_at->format('d M Y H:i') }}<br>
                <strong>Diperbarui Pada:</strong> {{ $materialType->updated_at->format('d M Y H:i') }}
            </p>
            <a href="{{ route('material_types.edit', $materialType->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('material_types.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
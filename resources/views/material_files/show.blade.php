@extends('layouts.app')

@section('content')
    <h1>Detail File Materi</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $materialFile->filename }}</h5>
            <p class="card-text">
                <strong>ID:</strong> {{ $materialFile->id }}<br>
                <strong>Nama File:</strong> {{ $materialFile->filename }}<br>
                <strong>Path File:</strong> {{ $materialFile->filepath }}<br>
                <strong>Ukuran File:</strong> {{ round($materialFile->filesize / 1024, 2) }} KB<br>
                <strong>Jenis MIME:</strong> {{ $materialFile->filemime }}<br>
                <strong>Jenis Materi:</strong> {{ $materialFile->materialType->name ?? 'N/A' }}<br>
                <strong>Terkait Materi:</strong> {{ $materialFile->material->title ?? 'N/A' }}<br>
                <strong>Dibuat Pada:</strong> {{ $materialFile->created_at->format('d M Y H:i') }}<br>
                <strong>Diperbarui Pada:</strong> {{ $materialFile->updated_at->format('d M Y H:i') }}
            </p>
            <a href="{{ route('material_files.edit', $materialFile->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('material_files.download', $materialFile->id) }}" class="btn btn-success">Download</a>
            <a href="{{ route('material_files.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
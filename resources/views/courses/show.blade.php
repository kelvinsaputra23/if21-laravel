@extends('layouts.app')

@section('content')
    <h1>Detail Mata Kuliah</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $course->nama }} ({{ $course->kode_mk }})</h5>
            <p class="card-text">
                <strong>ID:</strong> {{ $course->id }}<br>
                <strong>Kode MK:</strong> {{ $course->kode_mk }}<br>
                <strong>Nama Mata Kuliah:</strong> {{ $course->nama }}<br>
                <strong>Prodi ID:</strong> {{ $course->prodi_id }}<br>
                <strong>Dibuat Pada:</strong> {{ $course->created_at->format('d M Y H:i') }}<br>
                <strong>Diperbarui Pada:</strong> {{ $course->updated_at->format('d M Y H:i') }}
            </p>
            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
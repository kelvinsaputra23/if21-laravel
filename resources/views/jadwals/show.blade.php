@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Jadwal Perkuliahan</h2>

    <div class="card">
        <div class="card-header">
            Informasi Lengkap Jadwal
        </div>
        <div class="card-body">
            <p><strong>Tahun Akademik:</strong> {{ $jadwal->tahun_akademik }}</p>
            <p><strong>Semester:</strong> {{ $jadwal->kode_smt }}</p>
            <p><strong>Kelas:</strong> {{ $jadwal->kelas }}</p>
            <p><strong>Mata Kuliah:</strong> {{ $jadwal->mataKuliah->nama ?? 'N/A' }} ({{ $jadwal->mataKuliah->kode_mk ?? 'N/A' }})</p>
            <p><strong>Dosen Pengampu:</strong> {{ $jadwal->dosen->name ?? 'N/A' }}</p>
            <p><strong>Sesi Perkuliahan:</strong> {{ $jadwal->sesi->nama ?? 'N/A' }}</p>
            <p><strong>Dibuat Pada:</strong> {{ $jadwal->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Terakhir Diperbarui:</strong> {{ $jadwal->updated_at->format('d M Y, H:i') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('jadwals.index') }}" class="btn btn-primary">Kembali ke Daftar Jadwal</a>
            <a href="{{ route('jadwals.edit', $jadwal->id) }}" class="btn btn-warning">Edit Jadwal</a>
        </div>
    </div>
</div>
@endsection
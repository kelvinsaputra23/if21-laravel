@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Jadwal Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h5>Ada kesalahan input:</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tahun_akademik" class="form-label">Tahun Akademik:</label>
            <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" value="{{ old('tahun_akademik') }}" placeholder="Contoh: 2024/2025" required>
        </div>
        <div class="mb-3">
            <label for="kode_smt" class="form-label">Semester:</label>
            <input type="text" class="form-control" id="kode_smt" name="kode_smt" value="{{ old('kode_smt') }}" placeholder="Contoh: Gasal / Genap" required>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas:</label>
            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: SI-4A" required>
        </div>
        <div class="mb-3">
            <label for="mata_kuliah_id" class="form-label">Mata Kuliah:</label>
            <select class="form-select" id="mata_kuliah_id" name="mata_kuliah_id" required>
                <option value="">Pilih Mata Kuliah</option>
                @foreach ($mataKuliahs as $mk)
                    <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                        {{ $mk->nama }} ({{ $mk->kode_mk }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dosen_id" class="form-label">Dosen Pengampu:</label>
            <select class="form-select" id="dosen_id" name="dosen_id" required>
                <option value="">Pilih Dosen</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sesi_id" class="form-label">Sesi Perkuliahan:</label>
            <select class="form-select" id="sesi_id" name="sesi_id" required>
                <option value="">Pilih Sesi</option>
                @foreach ($sesis as $sesi)
                    <option value="{{ $sesi->id }}" {{ old('sesi_id') == $sesi->id ? 'selected' : '' }}>
                        {{ $sesi->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
        <a href="{{ route('jadwals.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
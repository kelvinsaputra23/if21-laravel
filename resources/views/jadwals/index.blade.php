@extends('layouts.app') {{-- Menggunakan layout utama aplikasi Anda --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Jadwal Perkuliahan</h2>
    <a href="{{ route('jadwals.create') }}" class="btn btn-primary mb-3">Tambah Jadwal Baru</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Tahun Akademik</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Sesi</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->tahun_akademik }}</td>
                        <td>{{ $jadwal->kode_smt }}</td>
                        <td>{{ $jadwal->kelas }}</td>
                        <td>{{ $jadwal->mataKuliah->nama ?? 'N/A' }} ({{ $jadwal->mataKuliah->kode_mk ?? 'N/A' }})</td>
                        <td>{{ $jadwal->dosen->name ?? 'N/A' }}</td>
                        <td>{{ $jadwal->sesi->nama ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('jadwals.show', $jadwal->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('jadwals.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada jadwal yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $jadwals->links() }} {{-- Untuk paginasi --}}
</div>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success-message { color: green; background-color: #e6ffe6; border: 1px solid #b3ffb3; padding: 10px; margin-bottom: 15px; }
        .error-message { color: red; background-color: #ffe6e6; border: 1px solid #ffb3b3; padding: 10px; margin-bottom: 15px; }
        .button { display: inline-block; padding: 8px 15px; text-decoration: none; border-radius: 5px; margin-right: 5px; }
        .button-primary { background-color: #007bff; color: white; }
        .button-info { background-color: #17a2b8; color: white; }
        .button-warning { background-color: #ffc107; color: black; }
        .button-danger { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <h1>Daftar Mata Kuliah</h1>

    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <a href="{{ route('mata_kuliahs.create') }}" class="button button-primary">Tambah Mata Kuliah Baru</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kode MK</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mataKuliahs as $mk)
                <tr>
                    <td>{{ $mk->id }}</td>
                    <td>{{ $mk->nama }}</td>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>
                        <a href="{{ route('mata_kuliahs.show', $mk->id) }}" class="button button-info">Lihat</a>
                        <a href="{{ route('mata_kuliahs.edit', $mk->id) }}" class="button button-warning">Edit</a>
                        <form action="{{ route('mata_kuliahs.destroy', $mk->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')" class="button button-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada mata kuliah yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sesi Perkuliahan</title>
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
    <h1>Daftar Sesi Perkuliahan</h1>

    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <a href="{{ route('sessions.create') }}" class="button button-primary">Buat Sesi Baru</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Sesi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sessions as $session)
                <tr>
                    <td>{{ $session->id }}</td>
                    <td>{{ $session->nama }}</td>
                    <td>
                        <a href="{{ route('sessions.show', $session->id) }}" class="button button-info">Lihat</a>
                        <a href="{{ route('sessions.edit', $session->id) }}" class="button button-warning">Edit</a>
                        <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus sesi ini?')" class="button button-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada sesi yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Sesi Baru</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .error { color: red; font-size: 0.9em; margin-top: 5px; }
        .button { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px; cursor: pointer; }
        .button-success { background-color: #28a745; color: white; border: none; }
        .button-secondary { background-color: #6c757d; color: white; border: none; }
    </style>
</head>
<body>
    <h1>Buat Sesi Baru</h1>

    @if ($errors->any())
        <div style="color: red; background-color: #ffe6e6; border: 1px solid #ffb3b3; padding: 10px; margin-bottom: 15px;">
            <strong>Terjadi Kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sessions.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama">Nama Sesi:</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="button button-success">Simpan Sesi</button>
        <a href="{{ route('sessions.index') }}" class="button button-secondary">Kembali ke Daftar</a>
    </form>
</body>
</html>
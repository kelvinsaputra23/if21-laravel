<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sesi</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .detail-item { margin-bottom: 10px; }
        .detail-item strong { display: inline-block; width: 150px; }
        .button { display: inline-block; padding: 8px 15px; text-decoration: none; border-radius: 5px; margin-right: 5px; }
        .button-warning { background-color: #ffc107; color: black; }
        .button-secondary { background-color: #6c757d; color: white; }
    </style>
</head>
<body>
    <h1>Detail Sesi</h1>

    <div class="detail-item">
        <strong>ID:</strong> {{ $session->id }}
    </div>
    <div class="detail-item">
        <strong>Nama Sesi:</strong> {{ $session->nama }}
    </div>
    <div class="detail-item">
        <strong>Dibuat Pada:</strong> {{ $session->created_at->format('d M Y, H:i') }}
    </div>
    <div class="detail-item">
        <strong>Terakhir Diperbarui:</strong> {{ $session->updated_at->format('d M Y, H:i') }}
    </div>

    <br>
    <a href="{{ route('sessions.edit', $session->id) }}" class="button button-warning">Edit</a>
    <a href="{{ route('sessions.index') }}" class="button button-secondary">Kembali ke Daftar</a>
</body>
</html>
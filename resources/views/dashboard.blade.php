<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .card { border: 1px solid #ccc; padding: 16px; margin-bottom: 16px; border-radius: 8px; }
        .card h2 { margin-top: 0; }
        .actions a { margin-right: 10px; }
    </style>
</head>
<body>
    <h1>Halo, {{ auth()->user()->name }}</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <div class="card">
        <h2>Ringkasan</h2>
        <p>Total Matkul: {{ \App\Models\Matkul::count() }}</p>
        <p>Total Progress: {{ \App\Models\Progress::count() }}</p>
    </div>

    <div class="card actions">
        <h2>Aksi Cepat</h2>
        <a href="{{ route('matkuls.index') }}">📘 Lihat Matkul</a>
        <a href="{{ route('progresses.index') }}">📈 Lihat Progress</a>
        <a href="{{ route('progresses.create') }}">➕ Tambah Progress</a>
    </div>
</body>
</html>

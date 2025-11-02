<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Progress</title>
        <link rel="stylesheet" href="/index.css">
        <link rel="stylesheet" href="/dark-mode.css">
        <script src="/theme-switcher.js"></script>
</head>
<body>
    <header>
  <nav class="nav-bar">
    <div class="nav-left">
      <ul class="nav-list">
        <li><a href="{{ route('matkuls.index') }}">Matkul</a></li>
        <li><a href="{{ route('progresses.index') }}">Progress</a></li>
      </ul>
    </div>

    <div class="nav-right">
      <label class="theme-switch">
        <input type="checkbox" onchange="toggleTheme()" id="theme-toggle">
        <span class="theme-switch-icon">🌓</span>
      </label>

      @guest
        <a class="nav-link" href="{{ route('login') }}">Login</a>
        <a class="nav-link" href="{{ route('register') }}">Register</a>
      @else
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="link-button">Logout</button>
        </form>
      @endguest
    </div>
  </nav>
</header>
    <h1>Daftar Progress</h1>

    <p><a href="{{ route('progresses.create') }}">Tambah Progress</a></p>

    @if(session('success'))
        <div class="flash-success" style="background:#e6ffed;border:1px solid #c6f6d5;padding:8px">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($progresses) && count($progresses))
        <table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%;max-width:1100px;">
            <thead>
                <tr style="background:#f4f4f4;text-align:left;">
                    <th>No</th>
                    <th>Topik</th>
                    <th>Matkul</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Rating Paham</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($progresses as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->topik }}</td>
                        <td>{{ optional($p->matkul)->matkul_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d F Y H:i') }}</td>
                        <td>{{ $p->jenis }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->rating_paham }}</td>
                        <td>
                            <a href="{{ route('progresses.edit', $p->progress_id) }}">Edit</a>
                            <form action="{{ route('progresses.destroy', $p->progress_id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus progress ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada progress.</p>
    @endif
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeneranPaham?</title>
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

    <main>
        <h1>Track your learning progress with BeneranPaham?</h1>

        @if(isset($matkuls) && count($matkuls))
            <table border="1" cellpadding="6" cellspacing="0" style="width:100%; max-width:1100px; margin-top:16px; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f4f4f4; text-align:left;">
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matkuls as $matkul)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $matkul->matkul_name }}</td>
                            <td>{{ $matkul->dosen_name }}</td>
                            <td>{{ $matkul->sks }}</td>
                            <td>{{ $matkul->semester }}</td>
                            <td>{{ $matkul->jadwal_hari }}</td>
                            <td>{{ $matkul->jadwal_jam }}</td>
                            <td>{{ $matkul->matkul_desc }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="margin-top:16px;">Belum ada mata kuliah terdaftar. Cek <a href="{{ route('matkuls.index') }}">halaman Matkul</a> untuk menambah.</p>
        @endif
        
        <!-- Progress list (read) shown on the homepage as requested -->
        <section style="margin-top:32px;">
            <h2>Daftar Progress</h2>

            @if(isset($progresses) && count($progresses))
                <table border="1" cellpadding="6" cellspacing="0" style="width:100%; max-width:1100px; margin-top:8px; border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f4f4f4; text-align:left;">
                            <th>No</th>
                            <th>Topik</th>
                            <th>Mata Kuliah</th>
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
                <p>Belum ada progress. <a href="{{ route('progresses.create') }}">Tambah progress</a></p>
            @endif
        </section>
    </main>

</body>
</html>
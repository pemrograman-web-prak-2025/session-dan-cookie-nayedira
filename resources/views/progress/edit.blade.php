<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Progress</title>
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
                    <input type="checkbox" id="theme-toggle">
                    <span class="theme-switch-icon">🌓</span>
                </label>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1>Edit Progress</h1>

        @if($errors->any())
            <div class="flash-error">
                <ul style="margin:0;padding-left:16px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="page-section">
            <form action="{{ route('progresses.update', $progress->progress_id) }}" method="POST" style="max-width: 500px;margin:0 auto">
        @csrf
        @method('PUT')
        <div class="form-row">
            <label>Topik</label>
            <input type="text" name="topik" value="{{ $progress->topik }}" required>
        </div>
        <div class="form-row">
            <label>Matkul</label>
            <select name="matkul_id" required>
                @foreach($matkuls as $m)
                    <option value="{{ $m->matkul_id }}" @if($m->matkul_id == $progress->matkul_id) selected @endif>{{ $m->matkul_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <label>Jenis</label>
            <select name="jenis">
                <option @if($progress->jenis=='Kelas') selected @endif>Kelas</option>
                <option @if($progress->jenis=='Kuis') selected @endif>Kuis</option>
                <option @if($progress->jenis=='UTS') selected @endif>UTS</option>
                <option @if($progress->jenis=='UAS') selected @endif>UAS</option>
            </select>
        </div>
        <div class="form-row">
            <label>Status</label>
            <select name="status">
                <option @if($progress->status=='Online') selected @endif>Online</option>
                <option @if($progress->status=='Offline') selected @endif>Offline</option>
                <option @if($progress->status=='Asynchronus') selected @endif>Asynchronus</option>
            </select>
        </div>
        <div class="form-row">
            <label>Absensi</label>
            <input type="number" name="absensi" min="0" max="1" value="{{ $progress->absensi }}">
            <span class="muted">0 = Tidak Hadir, 1 = Hadir</span>
        </div>
        <div class="form-row">
            <label>Rating Materi (1-5)</label>
            <input type="number" name="rating_materi" min="1" max="5" value="{{ $progress->rating_materi }}">
        </div>
        <div class="form-row">
            <label>Rating Paham (1-5)</label>
            <input type="number" name="rating_paham" min="1" max="5" value="{{ $progress->rating_paham }}">
        </div>
        <div class="form-row">
            <label>Tugas</label>
            <div class="radio-group">
                <input type="radio" name="tugas" value="Ada" id="tugas_ada" {{ $progress->tugas == 'Ada' ? 'checked' : '' }}> 
                <label for="tugas_ada" class="radio-label">Ada</label>
                <input type="radio" name="tugas" value="Tidak Ada" id="tugas_tidak" {{ $progress->tugas == 'Tidak Ada' ? 'checked' : '' }}> 
                <label for="tugas_tidak" class="radio-label">Tidak Ada</label>
            </div>
        </div>
        <div class="form-row">
            <label>Review</label>
                <div class="radio-group">
                <input type="radio" name="review" value="1" id="perlu_review"> 
                <label for="perlu_review" class="radio-label">Perlu</label>
                <input type="radio" name="review" value="0" id="tidak_review" checked> 
                <label for="tidak_review" class="radio-label">Tidak Perlu</label>
        </div>
        <div class="form-row">
            <label>Notes</label>
            <input type="text" name="notes" value="{{ $progress->notes }}">
        </div>
                <div class="form-actions">
                    <button type="submit" class="button">Update</button>
                    <a href="{{ route('progresses.index') }}" class="button secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/index.css">
    <link rel="stylesheet" href="/dark-mode.css">
    <script src="/theme-switcher.js"></script>
</head>
<body>
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:center">
            <h1>Login</h1>
            <label class="theme-switch" style="margin:0">
                <input type="checkbox" id="theme-toggle">
                <span class="theme-switch-icon">🌓</span>
            </label>
        </div>

        @if(session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="flash-error">
                <ul style="margin:0;padding-left:16px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="page-section" style="max-width:400px;margin:0 auto">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-row">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-row">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="button">Login</button>
                    <a href="{{ route('register') }}" class="button secondary">Daftar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

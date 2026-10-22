<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Admin login · Rose of Sharon</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <style>
        @font-face { font-family: Metropolis; src: url({{ asset('fonts/Metropolis/Metropolis-Regular.woff2') }}) format("woff2"); font-weight: 400; }
        @font-face { font-family: Metropolis; src: url({{ asset('fonts/Metropolis/Metropolis-SemiBold.woff2') }}) format("woff2"); font-weight: 600; }
        body { font-family: Metropolis, system-ui, sans-serif; min-height: 100vh; display: grid; place-items: center; padding: 16px;
               background: radial-gradient(90% 80% at 100% 100%, rgba(168,24,47,.55) 0%, rgba(168,24,47,0) 60%), radial-gradient(120% 120% at 0% 0%, #13573f 0%, #08291f 50%, #051b14 100%); }
        .login-card { width: 100%; max-width: 420px; background: #fff; border-radius: 20px; padding: 2.5rem 2rem; box-shadow: 0 30px 60px -20px rgba(0,0,0,.55); border-top: 3px solid #c9a45c; }
        .btn-go { background: linear-gradient(135deg, #13573f 0%, #0e4a36 50%, #08291f 100%); color: #fff; padding: .75rem; border-radius: 10px; font-weight: 600; box-shadow: inset 0 1px 0 rgba(255,255,255,.14); }
        .btn-go:hover { filter: brightness(1.12); color: #fff; }
        .form-control { padding: .7rem .9rem; border-radius: 10px; }
        .form-control:focus { border-color: #b8924a; box-shadow: 0 0 0 .2rem rgba(184,146,74,.18); }
        .form-check-input:checked { background-color: #0e4a36; border-color: #0e4a36; }
    </style>
</head>
<body>
    <main class="login-card">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Rose of Sharon" style="width: 84px">
            <h1 class="h4 mt-3 mb-1">Admin login</h1>
            <p class="text-muted small mb-0">Rose of Sharon Welfare Organisation</p>
        </div>

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label small fw-semibold">Password</label>
                <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small" for="remember">Keep me signed in</label>
            </div>
            <button class="btn btn-go w-100">Sign in</button>
        </form>

        <p class="text-center small mt-4 mb-0"><a href="{{ route('home') }}" class="text-muted"><i class="bi-arrow-left"></i> Back to website</a></p>
    </main>
</body>
</html>

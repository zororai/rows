<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Dashboard') · Rose of Sharon Admin</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <style>
        @font-face { font-family: Metropolis; src: url({{ asset('fonts/Metropolis/Metropolis-Regular.woff2') }}) format("woff2"); font-weight: 400; }
        @font-face { font-family: Metropolis; src: url({{ asset('fonts/Metropolis/Metropolis-SemiBold.woff2') }}) format("woff2"); font-weight: 600; }
        :root { --green: #0e4a36; --green-dark: #08291f; --rose: #a8182f; --gold: #b8924a; --gold-light: #e2c98f; --line: #e6e3dc; }
        body { font-family: Metropolis, system-ui, sans-serif; background: #f5f6f4; color: #1d2420; }
        .admin-sidebar { border-right: 1px solid rgba(201,164,92,.35); }
        .admin-sidebar { width: 250px; background: radial-gradient(140% 100% at 0% 0%, #13573f 0%, #08291f 55%, #051b14 100%); color: #fff; position: fixed; inset: 0 auto 0 0; padding: 1.25rem 1rem; display: flex; flex-direction: column; z-index: 1040; transition: transform .25s; }
        .admin-sidebar .brand { display: flex; gap: .65rem; align-items: center; color: #fff; text-decoration: none; font-weight: 600; margin-bottom: 2rem; }
        .admin-sidebar .brand img { width: 40px; }
        .admin-sidebar .brand small { display: block; color: var(--gold-light); font-size: .7rem; letter-spacing: .1em; text-transform: uppercase; }
        .admin-sidebar .nav-link { color: rgba(255,255,255,.75); border-radius: 10px; padding: .65rem .85rem; display: flex; gap: .7rem; align-items: center; font-weight: 600; }
        .admin-sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,.08); }
        .admin-sidebar .nav-link.active { color: #fff; background: linear-gradient(135deg, #bd2139, #7c0f22); box-shadow: inset 0 1px 0 rgba(255,255,255,.18); }
        .admin-sidebar .nav-link.active i { color: var(--gold-light); }
        .admin-sidebar .section-label { font-size: .7rem; letter-spacing: .12em; text-transform: uppercase; color: rgba(255,255,255,.45); margin: 1.25rem .85rem .5rem; }
        .admin-main { margin-left: 250px; min-height: 100vh; }
        .admin-topbar { background: #fff; border-bottom: 1px solid var(--line); padding: .85rem 1.5rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 1000; }
        .admin-content { padding: 1.75rem 1.5rem 3rem; max-width: 1200px; }
        .panel { background: #fff; border: 1px solid var(--line); border-radius: 14px; }
        .panel-body { padding: 1.5rem; }
        .btn-primary { --bs-btn-bg: var(--green); --bs-btn-border-color: var(--green); --bs-btn-hover-bg: var(--green-dark); --bs-btn-hover-border-color: var(--green-dark); --bs-btn-active-bg: var(--green-dark); }
        .btn-rose { background: linear-gradient(135deg, #bd2139, #a8182f 45%, #7c0f22); color: #fff; border-color: #7c0f22; }
        .btn-rose:hover { filter: brightness(1.08); color: #fff; }
        .form-control:focus, .form-select:focus { border-color: var(--gold); box-shadow: 0 0 0 .2rem rgba(184,146,74,.18); }
        .form-check-input:checked { background-color: var(--green); border-color: var(--green); }
        .stat-tile { padding: 1.25rem 1.5rem; display: flex; gap: 1rem; align-items: center; }
        .stat-tile .icon { width: 48px; height: 48px; border-radius: 12px; display: grid; place-items: center; font-size: 1.25rem; background: radial-gradient(120% 140% at 0% 0%, #13573f, #08291f); color: var(--gold-light); }
        .stat-tile .num { font-size: 1.75rem; font-weight: 600; line-height: 1; }
        .thumb { width: 64px; height: 48px; object-fit: cover; border-radius: 8px; background: #eee; }
        .table > :not(caption) > * > * { padding: .85rem 1rem; vertical-align: middle; }
        .img-tile { position: relative; border-radius: 12px; overflow: hidden; background: #eee; aspect-ratio: 1; }
        .img-tile img { width: 100%; height: 100%; object-fit: cover; }
        .img-tile .badges { position: absolute; top: 8px; left: 8px; display: flex; gap: 4px; flex-wrap: wrap; }
        .img-tile .actions { position: absolute; inset: auto 0 0 0; padding: .5rem; display: flex; gap: .4rem; justify-content: flex-end; background: linear-gradient(transparent, rgba(0,0,0,.6)); }
        .preview-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: 10px; }
        .preview-grid img { width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 10px; }
        .dropzone { border: 2px dashed #cbd5d0; border-radius: 14px; padding: 2rem; text-align: center; background: #fafbfa; cursor: pointer; }
        .dropzone:hover { border-color: var(--green); }
        @media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: none; box-shadow: 0 0 40px rgba(0,0,0,.3); }
            .admin-main { margin-left: 0; }
        }
    </style>
</head>
<body>
    <aside class="admin-sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <span>Rose of Sharon<small>Admin panel</small></span>
        </a>
        <nav class="nav flex-column gap-1">
            <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}"><i class="bi-speedometer2"></i> Dashboard</a>
            <div class="section-label">Content</div>
            <a class="nav-link @if(request()->routeIs('admin.stories.*')) active @endif" href="{{ route('admin.stories.index') }}"><i class="bi-journal-richtext"></i> Stories</a>
            <a class="nav-link @if(request()->routeIs('admin.gallery.*')) active @endif" href="{{ route('admin.gallery.index') }}"><i class="bi-images"></i> Gallery</a>
            <div class="section-label">Website</div>
            <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="bi-box-arrow-up-right"></i> View site</a>
        </nav>
        <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto">
            @csrf
            <button class="nav-link w-100 border-0 bg-transparent"><i class="bi-box-arrow-left"></i> Log out</button>
        </form>
    </aside>

    <div class="admin-main">
        <div class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" type="button" onclick="document.getElementById('sidebar').classList.toggle('open')" aria-label="Menu"><i class="bi-list"></i></button>
                <h1 class="h5 mb-0">@yield('title', 'Dashboard')</h1>
            </div>
            <div class="d-flex align-items-center gap-2 text-muted small">
                <i class="bi-person-circle fs-5"></i> {{ auth()->user()->name }}
            </div>
        </div>

        <div class="admin-content">
            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show">
                    <i class="bi-check-circle-fill"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>
</html>

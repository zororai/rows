<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Rose of Sharon Welfare Organisation (PVO 3/2004) provides shelter, nutrition, healthcare, education and skills training to orphaned and vulnerable children in Zimbabwe.')">
    <meta name="google-site-verification" content="3taqyp8f67Z1MI6iZCIJXn9zy4_bjEEOeoMOBDlPcJk">
    <title>@hasSection('title')@yield('title') · @endif Rose of Sharon Welfare Organisation</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    @stack('head')
</head>
<body>
    <div class="topbar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <span><i class="bi-geo-alt me-1"></i> 6884 Mt Madecheche, Zimre Park, Ruwa</span>
                <a href="tel:+263772490478"><i class="bi-telephone me-1"></i> +263 772 490 478</a>
                <a href="mailto:fbmaruta@yahoo.com"><i class="bi-envelope me-1"></i> fbmaruta@yahoo.com</a>
            </div>
            <span>Registered PVO 3/2004</span>
        </div>
    </div>

    <header class="site-nav">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Rose of Sharon logo">
                    <span class="brand-name">Rose of Sharon<small>Welfare Organisation</small></span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi-list fs-2 text-green"></i>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if(request()->routeIs('history', 'causes', 'homes', 'school', 'publications', 'profile')) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About us</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item @if(request()->routeIs('history')) active @endif" href="{{ route('history') }}">Our history</a></li>
                                <li><a class="dropdown-item @if(request()->routeIs('profile')) active @endif" href="{{ route('profile') }}">Our founder</a></li>
                                <li><a class="dropdown-item @if(request()->routeIs('causes')) active @endif" href="{{ route('causes') }}">Our causes</a></li>
                                <li><a class="dropdown-item @if(request()->routeIs('homes')) active @endif" href="{{ route('homes') }}">Our homes</a></li>
                                <li><a class="dropdown-item @if(request()->routeIs('school')) active @endif" href="{{ route('school') }}">Our school</a></li>
                                <li><a class="dropdown-item @if(request()->routeIs('publications')) active @endif" href="{{ route('publications') }}">Publications</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('projects')) active @endif" href="{{ route('projects') }}">Projects</a></li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('stories.*')) active @endif" href="{{ route('stories.index') }}">Stories</a></li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('gallery')) active @endif" href="{{ route('gallery') }}">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link @if(request()->routeIs('contact')) active @endif" href="{{ route('contact') }}">Contact</a></li>
                        <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn-rose" href="{{ route('donate') }}"><i class="bi-heart-fill"></i> Donate</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a class="brand mb-3" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                        <span class="brand-name">Rose of Sharon<small>Welfare Organisation</small></span>
                    </a>
                    <p class="mt-3">Mending the broken, the lost and the forgotten, and building them into tomorrow's champions. Caring for orphaned and vulnerable children in Zimbabwe since 2004.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>About</h5>
                    <ul>
                        <li><a href="{{ route('history') }}">Our history</a></li>
                        <li><a href="{{ route('profile') }}">Our founder</a></li>
                        <li><a href="{{ route('homes') }}">Our homes</a></li>
                        <li><a href="{{ route('school') }}">Our school</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h5>Explore</h5>
                    <ul>
                        <li><a href="{{ route('projects') }}">Projects</a></li>
                        <li><a href="{{ route('stories.index') }}">Stories</a></li>
                        <li><a href="{{ route('gallery') }}">Gallery</a></li>
                        <li><a href="{{ route('donate') }}">Donate</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Get in touch</h5>
                    <ul>
                        <li class="d-flex gap-2"><i class="bi-geo-alt"></i> 6884 Mt Madecheche, Zimre Park, Ruwa, Harare</li>
                        <li class="d-flex gap-2"><i class="bi-telephone"></i> <a href="tel:+263772490478">+263 772 490 478</a></li>
                        <li class="d-flex gap-2"><i class="bi-envelope"></i> <a href="mailto:fbmaruta@yahoo.com">fbmaruta@yahoo.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container d-flex flex-wrap justify-content-between gap-2">
                <span>&copy; {{ date('Y') }} Rose of Sharon Welfare Organisation. All rights reserved.</span>
                <span>Design by <a href="https://Lotusdreammaker.co.zw" target="_blank" rel="noopener">Lotus</a></span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>
</html>

@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    <section class="hero">
        <div class="hero-bg" style="background-image: url('{{ asset('images/DSC_0026.jpg') }}')"></div>
        <div class="container">
            <div class="hero-badge"><i class="bi-patch-check-fill"></i> Registered welfare organisation · PVO 3/2004</div>
            <h1>Making <em>champions</em> out of the forgotten.</h1>
            <p>Since 2004, Rose of Sharon has given orphaned, abandoned and neglected children in Zimbabwe a home, a family, an education and a future.</p>
            <div class="d-flex flex-wrap gap-3 mt-4">
                <a href="{{ route('donate') }}" class="btn-rose"><i class="bi-heart-fill"></i> Donate today</a>
                <a href="{{ route('stories.index') }}" class="btn-outline-light-2">Read their stories <i class="bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    {{-- Impact numbers --}}
    <section class="stats">
        <div class="container">
            <div class="stats-card">
                <div class="row g-0">
                    <div class="col-6 col-md-3 stat">
                        <div class="stat-num">2004</div>
                        <div class="stat-label">Founded</div>
                    </div>
                    <div class="col-6 col-md-3 stat">
                        <div class="stat-num">5</div>
                        <div class="stat-label">Children's homes</div>
                    </div>
                    <div class="col-6 col-md-3 stat">
                        <div class="stat-num">250<span>+</span></div>
                        <div class="stat-label">Children supported</div>
                    </div>
                    <div class="col-6 col-md-3 stat">
                        <div class="stat-num">200</div>
                        <div class="stat-label">Acres for our future campus</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our story --}}
    <section class="section">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="img-stack">
                        <div class="img-frame" style="aspect-ratio: 5 / 4">
                            <img src="{{ asset('images/IMG_8020.jpg') }}" alt="Children at Rose of Sharon">
                        </div>
                        <div class="floating-note"><strong>20+ years</strong>of mending the broken and building tomorrow's champions</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="eyebrow">Our story</span>
                    <h2 class="section-title">A home for the broken, the lost and the forgotten.</h2>
                    <p class="lead-2">Rose of Sharon Welfare Organisation was registered in 2004 and is based at 6884 Mt Madecheche, Zimre Park, Ruwa. We provide shelter, nutrition, healthcare, education and skills training to children who are orphaned, abandoned or neglected.</p>
                    <p class="text-muted-2">We run five orphanages, a High School for orphans and a Livelihood Skills Centre. We are not affiliated to any political party, we subscribe to the Word of God, and we do not discriminate against anyone.</p>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <div class="mv-card green">
                                <h5>Our mission</h5>
                                <p>To make orphans and vulnerable children highly employable, self-reliant and competent.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mv-card rose">
                                <h5>Our vision</h5>
                                <p>A household name for basic necessities and life skills for Zimbabwe's orphans.</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('history') }}" class="link-arrow mt-4">Learn our history <i class="bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    {{-- What we provide --}}
    <section class="section bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="eyebrow">What we do</span>
                <h2 class="section-title">Everything a child needs to thrive</h2>
                <p class="lead-2 mx-auto">Every child who comes to us receives the full circle of care: from a safe bed to a school desk to a trade.</p>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble"><i class="bi-house-door"></i></div>
                        <h4>Shelter</h4>
                        <p>Five loving homes caring for children from a day old to young adults.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble rose"><i class="bi-basket"></i></div>
                        <h4>Nutrition &amp; health</h4>
                        <p>Daily meals, much of it grown by the children themselves, plus healthcare.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble"><i class="bi-mortarboard"></i></div>
                        <h4>Education</h4>
                        <p>From home nursery to our award-winning High School for orphans.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble rose"><i class="bi-tools"></i></div>
                        <h4>Life skills</h4>
                        <p>Horticulture, poultry and peanut-butter making at our Livelihood Skills Centre.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our homes --}}
    <section class="section">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
                <div>
                    <span class="eyebrow">Our homes</span>
                    <h2 class="section-title mb-0">Where every child belongs</h2>
                </div>
                <a href="{{ route('homes') }}" class="btn-outline-green">Visit our homes <i class="bi-arrow-right"></i></a>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['images/b.png', 'Bethel Babies', 'Ages 0 to 5', 'Toddlers cared for by an Early Education Officer and child minders.'],
                    ['images/sh.png', 'Shiloh Pre-teens', 'Ages 6 to 10', 'Pre-teens attending a local government primary school in Ruwa.'],
                    ['images/ha.png', 'Salem Youth Centre', 'Teens', 'Skills development that prepares our young people for the real world.'],
                    ['images/hi.png', 'The High School', 'Forms 1 to 6', 'Zimbabwe Business Awards "High School of the Year" 2014.'],
                ] as [$img, $name, $tag, $text])
                    <div class="col-sm-6 col-lg-3">
                        <a href="{{ route('homes') }}" class="home-card">
                            <img src="{{ asset($img) }}" alt="{{ $name }}" loading="lazy">
                            <div class="home-card-body">
                                <span class="tag">{{ $tag }}</span>
                                <h4>{{ $name }}</h4>
                                <p>{{ $text }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Founder --}}
    <section class="section founder">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 text-center">
                    <img src="{{ asset('images/img-8.png') }}" alt="Dr. Fatima Maruta, founder">
                </div>
                <div class="col-lg-7">
                    <span class="eyebrow" style="color:#ffb3c0">A word from our founder</span>
                    <blockquote>"I believe in a helping hand. As a family, we have the passion to see a better future for forgotten, unwanted children and to transform them into tomorrow's champions. This is done by the grace of the Almighty God."</blockquote>
                    <div class="name">Dr. Fatima Maruta</div>
                    <div class="role mb-4">Founding Director</div>
                    <a href="{{ route('profile') }}" class="btn-outline-light-2">Read her profile <i class="bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest stories --}}
    @if ($stories->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
                    <div>
                        <span class="eyebrow">Stories of hope</span>
                        <h2 class="section-title mb-0">Where our children are now</h2>
                    </div>
                    <a href="{{ route('stories.index') }}" class="btn-outline-green">All stories <i class="bi-arrow-right"></i></a>
                </div>
                <div class="row g-4">
                    @foreach ($stories as $story)
                        <div class="col-md-6 col-lg-4">
                            @include('partials.story-card')
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Causes --}}
    <section class="section bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="eyebrow">Our causes</span>
                <h2 class="section-title">Where your gift goes</h2>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['images/IMG_8020.jpg', 'Children\'s education', 'Making orphans and vulnerable children highly employable, self-reliant and competent in applying their knowledge.'],
                    ['images/stru.jpg', 'Infrastructure development', 'Building permanent, safe structures on our 200 acres so every child feels secure and protected.'],
                    ['images/DSC_0110.JPG', 'Skills development', 'Quality basic necessities and life-skills training for orphans and vulnerable children in Zimbabwe.'],
                ] as [$img, $title, $text])
                    <div class="col-md-4">
                        <div class="cause-card">
                            <img src="{{ asset($img) }}" alt="{{ $title }}" loading="lazy">
                            <div class="cause-card-body">
                                <h4>{{ $title }}</h4>
                                <p>{{ $text }}</p>
                                <a href="{{ route('donate') }}" class="link-arrow">Support this cause <i class="bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    @if ($gallery->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
                    <div>
                        <span class="eyebrow">Gallery</span>
                        <h2 class="section-title mb-0">Moments from Rose of Sharon</h2>
                    </div>
                    <a href="{{ route('gallery') }}" class="btn-outline-green">View gallery <i class="bi-arrow-right"></i></a>
                </div>
                <div class="home-gallery">
                    @foreach ($gallery as $image)
                        <a href="{{ route('gallery') }}"><img src="{{ $image->image_url }}" alt="{{ $image->title ?? 'Rose of Sharon gallery photo' }}" loading="lazy"></a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Call to action --}}
    <section class="pb-5 mb-4">
        <div class="container">
            <div class="cta">
                <div class="row g-4 align-items-center position-relative" style="z-index:1">
                    <div class="col-lg-8">
                        <h2 class="section-title">Make an impact. Change a life.</h2>
                        <p class="verse mb-0">"A generous person will prosper; whoever refreshes others will be refreshed." Proverbs 11:25</p>
                    </div>
                    <div class="col-lg-4 text-lg-end d-flex flex-wrap gap-3 justify-content-lg-end">
                        <a href="{{ route('donate') }}" class="btn-light-2"><i class="bi-heart-fill"></i> Donate</a>
                        <a href="{{ route('contact') }}" class="btn-outline-light-2">Volunteer</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

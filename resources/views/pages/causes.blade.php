@extends('layouts.app')

@section('title', 'Our causes')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'About us',
        'title' => 'Our causes',
        'intro' => 'Shelter, nutrition, healthcare, education and skills training for children who are orphaned, abandoned or neglected.',
    ])

    <section class="section">
        <div class="container">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6 prose">
                    <span class="eyebrow">Why we exist</span>
                    <h2 class="section-title">Rescuing children since 2006</h2>
                    <p>Rose of Sharon Welfare Organisation was established in order to provide shelter, nutrition, healthcare, education and skills training to children who are orphaned, abandoned or neglected.</p>
                    <img src="{{ asset('images/org.jpg') }}" class="img-fluid mt-3" style="max-height: 160px" alt="Rose of Sharon motto">
                </div>
                <div class="col-lg-6">
                    <figure class="img-frame m-0">
                        <img src="{{ asset('images/piccoz.png') }}" alt="Some of the children who were rescued in 2006">
                    </figure>
                    <p class="text-muted-2 small mt-2">Some of the children who were rescued in 2006.</p>
                </div>
            </div>

            <div class="row g-4">
                @foreach ([
                    ['images/IMG_8020.jpg', 'Children\'s education', 'Making orphans and vulnerable children highly employable, self-reliant and competent in their knowledge application.'],
                    ['images/stru.jpg', 'Infrastructure development', 'Providing standard infrastructure to restore trust in our orphans, so they feel safe and protected.'],
                    ['images/DSC_0110.JPG', 'Skills development', 'The provision of quality basic necessities and life-skills training for orphans and vulnerable children in Zimbabwe.'],
                ] as [$img, $title, $text])
                    <div class="col-md-4">
                        <div class="cause-card">
                            <img src="{{ asset($img) }}" alt="{{ $title }}" loading="lazy">
                            <div class="cause-card-body">
                                <h4>{{ $title }}</h4>
                                <p>{{ $text }}</p>
                                <a href="{{ route('donate') }}" class="btn-rose align-self-start">Donate now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

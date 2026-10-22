@extends('layouts.app')

@section('title', 'Our homes')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'About us',
        'title' => 'Our homes',
        'intro' => 'From newborns to young adults, every child at Rose of Sharon has a safe place to grow.',
    ])

    <section class="section">
        <div class="container">
            @foreach ([
                ['images/b.png', 'Bethel Babies', 'Ages 0 to 5', 'Bethel Babies is located at 6833 Shamba Hills, Zimre Park. Their ages range from a day old up to five years old. These toddlers attend a home-based Nursery School where they are in the care of an Early Education Officer and child minders.'],
                ['images/sh.png', 'Shiloh Pre-teens', 'Ages 6 to 10', 'Shiloh Pre-teens is located at 2275 Rogers Mangena in Ruwa. It caters for pre-teens with ages ranging from 6 years up to 10 years. They attend a local Government Primary School.'],
                ['images/ha.png', 'Youth Centre (Salem)', 'Teens', 'Salem is a youth centre that focuses on skills development and helps our young people prepare for the real world.'],
                ['images/hi.png', 'The High School', 'Forms 1 to 6', 'The High School gives orphaned and vulnerable children the opportunity to develop literacy and numerous skills at Secondary and High School level (Form 1 to 6) in a uniquely therapeutic environment. Learning takes place at the Zimre Park Campus, approximately 21 km east of Harare City (en route to Mutare). In 2014 the Zimbabwe Business Awards conferred an award to our High School for Orphans as the "High School of the Year".'],
            ] as $i => [$img, $name, $tag, $text])
                <div class="row g-5 align-items-center {{ $loop->last ? '' : 'mb-5 pb-4' }}">
                    <div class="col-lg-6 {{ $i % 2 ? 'order-lg-2' : '' }}">
                        <div class="img-frame" style="aspect-ratio: 4 / 3"><img src="{{ asset($img) }}" alt="{{ $name }}" loading="lazy"></div>
                    </div>
                    <div class="col-lg-6">
                        <span class="eyebrow">{{ $tag }}</span>
                        <h2 class="section-title">{{ $name }}</h2>
                        <p class="lead-2">{{ $text }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

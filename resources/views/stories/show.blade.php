@extends('layouts.app')

@section('title', $story->title)
@section('description', \Illuminate\Support\Str::limit($story->summary, 155))

@section('content')
    <section class="section-sm">
        <div class="container">
            <div class="article">
                <a href="{{ route('stories.index') }}" class="link-arrow mb-4"><i class="bi-arrow-left"></i> All stories</a>
                <span class="eyebrow d-flex">{{ $story->published_at?->format('j F Y') }}</span>
                <h1 class="mb-4" style="font-size: clamp(2rem, 4vw, 3rem)">{{ $story->title }}</h1>
                @if ($story->image)
                    <div @class(['article-cover', 'is-graphic' => $story->image_is_graphic])><img src="{{ $story->image_url }}" alt="{{ $story->title }}"></div>
                @endif
                <div class="article-body">
                    @foreach ($story->paragraphs as $paragraph)
                        <p>{!! nl2br(e($paragraph)) !!}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if ($more->isNotEmpty())
        <section class="section bg-white">
            <div class="container">
                <h2 class="section-title text-center mb-5">More stories</h2>
                <div class="row g-4">
                    @foreach ($more as $story)
                        <div class="col-md-6 col-lg-4">
                            @include('partials.story-card')
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

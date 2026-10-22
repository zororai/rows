@extends('layouts.app')

@section('title', 'Publications')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'About us',
        'title' => 'Publications',
        'intro' => 'Books and newspaper features about Dr. Fatima Maruta and the work of Rose of Sharon.',
    ])

    <section class="section">
        <div class="container">
            <h2 class="section-title mb-4">Books featuring Dr. Fatima Maruta</h2>
            <div class="row g-4 mb-5">
                @foreach (['images/book1.png', 'images/book2.png', 'images/book3.jpg'] as $img)
                    <div class="col-sm-6 col-lg-4">
                        <div class="img-frame bg-white"><img src="{{ asset($img) }}" alt="Book" loading="lazy" style="object-fit: contain"></div>
                    </div>
                @endforeach
            </div>

            <h2 class="section-title mb-4">Newspaper publications</h2>
            <div class="gallery-grid">
                @foreach (['images/news1.png', 'images/news2.png', 'images/news3.png', 'images/news4.png'] as $img)
                    <figure class="gallery-item m-0 mb-3" style="cursor: default"><img src="{{ asset($img) }}" alt="Newspaper article" loading="lazy"></figure>
                @endforeach
            </div>
        </div>
    </section>
@endsection

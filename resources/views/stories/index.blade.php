@extends('layouts.app')

@section('title', 'Stories')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'Stories of hope',
        'title' => 'Our stories',
        'intro' => 'Children who came to us orphaned and living in poverty are now graduates, teachers, lawyers, pastors and leaders. These are some of their stories.',
    ])

    <section class="section">
        <div class="container">
            @if (auth()->user()?->is_admin)
                <div class="admin-cta mb-5">
                    <div>
                        <strong>Share a new story</strong>
                        <span class="d-block text-muted-2 small">Only administrators can see this.</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.stories.index') }}" class="btn-outline-green">Manage stories</a>
                        <a href="{{ route('admin.stories.create') }}" class="btn-rose"><i class="bi-plus-lg"></i> Add a story</a>
                    </div>
                </div>
            @endif

            @if ($stories->isEmpty())
                <p class="text-center text-muted-2">No stories have been published yet. Please check back soon.</p>
            @else
                <div class="row g-4">
                    @foreach ($stories as $story)
                        <div class="col-md-6 col-lg-4">
                            @include('partials.story-card')
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $stories->links('pagination::bootstrap-5') }}
                </div>
            @endif

            <div class="row g-4 mt-4">
                <div class="col-md-6"><div class="quote-card">"And so you will bear testimony to me."<cite>Luke 21:13</cite></div></div>
                <div class="col-md-6"><div class="quote-card">"You are witnesses of these things."<cite>Luke 24:48</cite></div></div>
            </div>
        </div>
    </section>
@endsection

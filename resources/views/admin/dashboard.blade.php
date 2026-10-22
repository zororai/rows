@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="h4 mb-1">Welcome back, {{ auth()->user()->name }}</h2>
            <p class="text-muted mb-0">Share news and photos with your supporters.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.stories.create') }}" class="btn btn-primary"><i class="bi-plus-lg"></i> New story</a>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-rose"><i class="bi-cloud-arrow-up"></i> Upload photos</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="panel stat-tile">
                <div class="icon"><i class="bi-journal-richtext"></i></div>
                <div><div class="num">{{ $storyCount }}</div><div class="text-muted small">Stories in total</div></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel stat-tile">
                <div class="icon"><i class="bi-eye"></i></div>
                <div><div class="num">{{ $publishedCount }}</div><div class="text-muted small">Published stories</div></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel stat-tile">
                <div class="icon"><i class="bi-images"></i></div>
                <div><div class="num">{{ $imageCount }}</div><div class="text-muted small">Gallery photos</div></div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="panel h-100">
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h3 class="h6 mb-0">Recent stories</h3>
                    <a href="{{ route('admin.stories.index') }}" class="small">View all</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($recentStories as $story)
                        <a href="{{ route('admin.stories.edit', $story) }}" class="list-group-item list-group-item-action d-flex gap-3 align-items-center py-3">
                            <img src="{{ $story->image_url }}" class="thumb" alt="">
                            <div class="flex-grow-1 min-w-0">
                                <div class="fw-semibold text-truncate">{{ $story->title }}</div>
                                <div class="small text-muted">{{ $story->published_at?->format('j M Y') }}</div>
                            </div>
                            @unless ($story->is_published)<span class="badge text-bg-secondary">Draft</span>@endunless
                        </a>
                    @empty
                        <div class="p-4 text-muted text-center">No stories yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel h-100">
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h3 class="h6 mb-0">Latest photos</h3>
                    <a href="{{ route('admin.gallery.index') }}" class="small">View all</a>
                </div>
                <div class="panel-body">
                    <div class="row g-2">
                        @forelse ($recentImages as $image)
                            <div class="col-4">
                                <a href="{{ route('admin.gallery.edit', $image) }}" class="img-tile d-block"><img src="{{ $image->image_url }}" alt=""></a>
                            </div>
                        @empty
                            <div class="text-muted text-center py-3">No photos yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

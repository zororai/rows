@extends('admin.layout')

@section('title', 'Home banner')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <p class="text-muted mb-0">
            The large photo at the top of the home page. With more than one active slide, the banner fades between them every 7 seconds.
        </p>
        <div class="d-flex gap-2">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-light"><i class="bi-eye"></i> View home page</a>
            <a href="{{ route('admin.hero.create') }}" class="btn btn-rose"><i class="bi-plus-lg"></i> Add slide</a>
        </div>
    </div>

    @if ($slides->isEmpty())
        <div class="panel panel-body text-center text-muted py-5">
            No banner slides yet, so the home page shows the default banner. <a href="{{ route('admin.hero.create') }}">Add your first slide</a>.
        </div>
    @else
        <div class="d-flex flex-column gap-3">
            @foreach ($slides as $slide)
                <div class="panel d-flex flex-wrap flex-md-nowrap align-items-center gap-3 p-3">
                    <div class="position-relative flex-shrink-0" style="width: 220px; max-width: 100%">
                        <img src="{{ $slide->image_url }}" alt="" class="rounded w-100" style="aspect-ratio: 16 / 9; object-fit: cover">
                        <span class="badge text-bg-dark position-absolute top-0 start-0 m-2">#{{ $slide->sort_order }}</span>
                    </div>
                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            @if ($slide->is_active)
                                <span class="badge text-bg-success">Showing</span>
                            @else
                                <span class="badge text-bg-secondary">Hidden</span>
                            @endif
                        </div>
                        <div class="fw-semibold fs-5">{{ str_replace('*', '', $slide->title) }}</div>
                        @if ($slide->subtitle)
                            <div class="text-muted small">{{ \Illuminate\Support\Str::limit($slide->subtitle, 140) }}</div>
                        @endif
                    </div>
                    <div class="d-flex gap-2 flex-shrink-0">
                        <a href="{{ route('admin.hero.edit', $slide) }}" class="btn btn-sm btn-outline-primary"><i class="bi-pencil"></i> Edit</a>
                        <form method="POST" action="{{ route('admin.hero.destroy', $slide) }}" onsubmit="return confirm('Delete this banner slide?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

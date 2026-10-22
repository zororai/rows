@extends('admin.layout')

@section('title', 'Stories')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <form method="GET" class="d-flex gap-2" role="search">
            <input type="search" name="q" value="{{ $search }}" class="form-control" placeholder="Search stories…" style="min-width: 240px">
            <button class="btn btn-outline-secondary"><i class="bi-search"></i></button>
        </form>
        <a href="{{ route('admin.stories.create') }}" class="btn btn-primary"><i class="bi-plus-lg"></i> New story</a>
    </div>

    <div class="panel">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Story</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stories as $story)
                        <tr>
                            <td>
                                <div class="d-flex gap-3 align-items-center">
                                    <img src="{{ $story->image_url }}" class="thumb" alt="">
                                    <div>
                                        <div class="fw-semibold">{{ $story->title }}</div>
                                        <div class="small text-muted">/stories/{{ $story->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($story->is_published)
                                    <span class="badge text-bg-success">Published</span>
                                @else
                                    <span class="badge text-bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td class="text-nowrap small">{{ $story->published_at?->format('j M Y') }}</td>
                            <td class="text-end text-nowrap">
                                @if ($story->is_published)
                                    <a href="{{ route('stories.show', $story) }}" target="_blank" class="btn btn-sm btn-light" title="View on site"><i class="bi-eye"></i></a>
                                @endif
                                <a href="{{ route('admin.stories.edit', $story) }}" class="btn btn-sm btn-outline-primary"><i class="bi-pencil"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.stories.destroy', $story) }}" class="d-inline" onsubmit="return confirm('Delete this story? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-5">No stories found. <a href="{{ route('admin.stories.create') }}">Write the first one</a>.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $stories->links('pagination::bootstrap-5') }}</div>
@endsection

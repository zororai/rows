@extends('admin.layout')

@section('title', 'Gallery')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <p class="text-muted mb-0">Photos marked <span class="badge text-bg-success">Home</span> also appear on the home page.</p>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-rose"><i class="bi-cloud-arrow-up"></i> Upload photos</a>
    </div>

    @if ($images->isEmpty())
        <div class="panel panel-body text-center text-muted py-5">
            No photos yet. <a href="{{ route('admin.gallery.create') }}">Upload some</a>.
        </div>
    @else
        <div class="row g-3">
            @foreach ($images as $image)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="img-tile">
                        <img src="{{ $image->image_url }}" alt="{{ $image->title }}" loading="lazy">
                        <div class="badges">
                            @if ($image->category)<span class="badge text-bg-light">{{ $image->category }}</span>@endif
                            @if ($image->show_on_home)<span class="badge text-bg-success">Home</span>@endif
                        </div>
                        <div class="actions">
                            <a href="{{ route('admin.gallery.edit', $image) }}" class="btn btn-sm btn-light"><i class="bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Delete this photo?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @if ($image->title)<div class="small fw-semibold mt-1 text-truncate">{{ $image->title }}</div>@endif
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $images->links('pagination::bootstrap-5') }}</div>
    @endif
@endsection

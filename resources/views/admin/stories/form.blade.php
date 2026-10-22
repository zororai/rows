@extends('admin.layout')

@section('title', $story->exists ? 'Edit story' : 'New story')

@section('content')
    <form method="POST" enctype="multipart/form-data"
          action="{{ $story->exists ? route('admin.stories.update', $story) : route('admin.stories.store') }}">
        @csrf
        @if ($story->exists) @method('PUT') @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="panel panel-body">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input id="title" name="title" value="{{ old('title', $story->title) }}" class="form-control form-control-lg @error('title') is-invalid @enderror" required maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="excerpt" class="form-label fw-semibold">Short summary <span class="text-muted fw-normal">(optional)</span></label>
                        <textarea id="excerpt" name="excerpt" rows="2" maxlength="500" class="form-control @error('excerpt') is-invalid @enderror" placeholder="One or two sentences shown on story cards">{{ old('excerpt', $story->excerpt) }}</textarea>
                    </div>
                    <div>
                        <label for="body" class="form-label fw-semibold">Story</label>
                        <textarea id="body" name="body" rows="16" class="form-control @error('body') is-invalid @enderror" required>{{ old('body', $story->body) }}</textarea>
                        <div class="form-text">Leave a blank line between paragraphs.</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel panel-body mb-4">
                    <h3 class="h6 mb-3">Publishing</h3>
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="is_published" value="0">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" value="1" @checked(old('is_published', $story->is_published))>
                        <label class="form-check-label" for="is_published">Published (visible on the website)</label>
                    </div>
                    <label for="published_at" class="form-label small fw-semibold">Publish date</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="form-control"
                           value="{{ old('published_at', $story->published_at?->format('Y-m-d\TH:i')) }}">
                    <div class="form-text">Set a future date to schedule the story.</div>
                </div>

                <div class="panel panel-body mb-4">
                    <h3 class="h6 mb-3">Cover image</h3>
                    <img id="preview" src="{{ $story->image ? $story->image_url : '' }}" class="img-fluid rounded mb-3 {{ $story->image ? '' : 'd-none' }}" alt="">
                    <input type="file" name="image" id="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                    <div class="form-text">JPG, PNG, WEBP or GIF, up to 5 MB.</div>
                    @if ($story->image)
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                            <label class="form-check-label small" for="remove_image">Remove current image</label>
                        </div>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg"><i class="bi-check-lg"></i> {{ $story->exists ? 'Save changes' : 'Save story' }}</button>
                    <a href="{{ route('admin.stories.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');
        if (!file) return;
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    });
</script>
@endpush

@extends('admin.layout')

@section('title', 'Upload photos')

@section('content')
    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="panel panel-body">
                    <label class="dropzone d-block" for="images">
                        <i class="bi-cloud-arrow-up display-5 text-success"></i>
                        <div class="fw-semibold mt-2">Click to choose photos</div>
                        <div class="small text-muted">Up to 20 at once · JPG, PNG, WEBP or GIF · max 5 MB each</div>
                    </label>
                    <input type="file" name="images[]" id="images" accept="image/*" multiple required class="d-none">
                    <div id="previews" class="preview-grid mt-3"></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="panel panel-body mb-4">
                    <p class="small text-muted">These details apply to every photo in this upload. You can edit each photo afterwards.</p>
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title <span class="text-muted fw-normal">(optional)</span></label>
                        <input id="title" name="title" value="{{ old('title') }}" class="form-control" maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="caption" class="form-label fw-semibold">Caption <span class="text-muted fw-normal">(optional)</span></label>
                        <textarea id="caption" name="caption" rows="2" class="form-control" maxlength="500">{{ old('caption') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">Album / category</label>
                        <input id="category" name="category" value="{{ old('category') }}" class="form-control" list="category-list" placeholder="e.g. Awards, Our children, Events" maxlength="100">
                        <datalist id="category-list">
                            @foreach ($categories as $cat)<option value="{{ $cat }}">@endforeach
                        </datalist>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="show_on_home" value="1" id="show_on_home" @checked(old('show_on_home', true))>
                        <label class="form-check-label" for="show_on_home">Show on the home page</label>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-rose btn-lg"><i class="bi-cloud-arrow-up"></i> Upload</button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.getElementById('images').addEventListener('change', function (e) {
        const box = document.getElementById('previews');
        box.innerHTML = '';
        Array.from(e.target.files).forEach(function (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = file.name;
            box.appendChild(img);
        });
    });
</script>
@endpush

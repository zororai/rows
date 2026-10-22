@extends('admin.layout')

@section('title', 'Edit photo')

@section('content')
    <form method="POST" action="{{ route('admin.gallery.update', $image) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($return)<input type="hidden" name="return" value="{{ $return }}">@endif
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="panel panel-body">
                    <img id="preview" src="{{ $image->image_url }}" class="img-fluid rounded mb-3 w-100" alt="">
                    <label for="image" class="form-label fw-semibold">Replace photo <span class="text-muted fw-normal">(optional)</span></label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-body mb-4">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input id="title" name="title" value="{{ old('title', $image->title) }}" class="form-control" maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="caption" class="form-label fw-semibold">Caption</label>
                        <textarea id="caption" name="caption" rows="3" class="form-control" maxlength="500">{{ old('caption', $image->caption) }}</textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-8">
                            <label for="category" class="form-label fw-semibold">Album / category</label>
                            <input id="category" name="category" value="{{ old('category', $image->category) }}" class="form-control" list="category-list" maxlength="100">
                            <datalist id="category-list">
                                @foreach ($categories as $cat)<option value="{{ $cat }}">@endforeach
                            </datalist>
                        </div>
                        <div class="col-4">
                            <label for="sort_order" class="form-label fw-semibold">Order</label>
                            <input type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $image->sort_order) }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="show_on_home" value="1" id="show_on_home" @checked(old('show_on_home', $image->show_on_home))>
                        <label class="form-check-label" for="show_on_home">Show on the home page</label>
                    </div>
                    <div class="form-text">Lower order numbers appear first.</div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg"><i class="bi-check-lg"></i> Save changes</button>
                    <a href="{{ $return ?? route('admin.gallery.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function (e) {
        if (e.target.files[0]) document.getElementById('preview').src = URL.createObjectURL(e.target.files[0]);
    });
</script>
@endpush

@extends('admin.layout')

@section('title', $slide->exists ? 'Edit banner slide' : 'Add banner slide')

@push('scripts')
<script>
    (function () {
        const title = document.getElementById('title');
        const subtitle = document.getElementById('subtitle');
        const file = document.getElementById('image');
        const pTitle = document.getElementById('preview-title');
        const pSub = document.getElementById('preview-subtitle');
        const pBg = document.getElementById('preview-bg');

        function escape(s) { const d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
        function render() {
            pTitle.innerHTML = escape(title.value || 'Your headline').replace(/\*(.+?)\*/g, '<em>$1</em>');
            pSub.textContent = subtitle.value;
        }
        title.addEventListener('input', render);
        subtitle.addEventListener('input', render);
        file.addEventListener('change', function (e) {
            if (e.target.files[0]) pBg.style.backgroundImage = 'url(' + URL.createObjectURL(e.target.files[0]) + ')';
        });
        render();
    })();
</script>
@endpush

@section('content')
    <style>
        .hero-preview { position: relative; border-radius: 14px; overflow: hidden; aspect-ratio: 16 / 8; color: #fff; display: flex; align-items: center; background: #051b14; }
        .hero-preview .bg { position: absolute; inset: 0; background-size: cover; background-position: center 30%; }
        .hero-preview::after { content: ""; position: absolute; inset: 0; background: linear-gradient(100deg, rgba(5,27,20,.94) 0%, rgba(8,41,31,.78) 42%, rgba(8,41,31,.2) 100%); }
        .hero-preview .copy { position: relative; z-index: 1; padding: 1.5rem 2rem; max-width: 70%; }
        .hero-preview h2 { font-family: Georgia, serif; font-size: clamp(1.3rem, 2.6vw, 2rem); line-height: 1.15; margin-bottom: .5rem; }
        .hero-preview h2 em { color: #e2c98f; }
        .hero-preview p { font-size: .85rem; opacity: .85; margin: 0; }
    </style>

    <form method="POST" enctype="multipart/form-data"
          action="{{ $slide->exists ? route('admin.hero.update', $slide) : route('admin.hero.store') }}">
        @csrf
        @if ($slide->exists) @method('PUT') @endif
        @if ($return)<input type="hidden" name="return" value="{{ $return }}">@endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="panel panel-body mb-4">
                    <h3 class="h6 mb-3">Preview</h3>
                    <div class="hero-preview">
                        <div class="bg" id="preview-bg" style="{{ $slide->image ? "background-image: url('".$slide->image_url."')" : '' }}"></div>
                        <div class="copy">
                            <h2 id="preview-title"></h2>
                            <p id="preview-subtitle"></p>
                        </div>
                    </div>
                </div>

                <div class="panel panel-body">
                    <label for="image" class="form-label fw-semibold">Photo {{ $slide->exists ? '(leave empty to keep the current one)' : '' }}</label>
                    <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" class="form-control @error('image') is-invalid @enderror" @unless ($slide->exists) required @endunless>
                    <div class="form-text">Use a wide landscape photo, ideally at least 1920 × 1080 pixels. JPG, PNG or WEBP, up to 5 MB. The left side is darkened so the text stays readable, so photos where the main subject is on the right work best.</div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="panel panel-body mb-4">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Headline</label>
                        <input id="title" name="title" value="{{ old('title', $slide->title) }}" class="form-control @error('title') is-invalid @enderror" required maxlength="120">
                        <div class="form-text">Put *stars* around a word to highlight it in gold, e.g. <code>Making *champions* out of the forgotten.</code></div>
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label fw-semibold">Text under the headline <span class="text-muted fw-normal">(optional)</span></label>
                        <textarea id="subtitle" name="subtitle" rows="3" maxlength="300" class="form-control @error('subtitle') is-invalid @enderror">{{ old('subtitle', $slide->subtitle) }}</textarea>
                    </div>
                    <div class="row g-3 align-items-end">
                        <div class="col-5">
                            <label for="sort_order" class="form-label fw-semibold">Order</label>
                            <input type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $slide->sort_order) }}" class="form-control">
                        </div>
                        <div class="col-7">
                            <div class="form-check form-switch mb-2">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" @checked(old('is_active', $slide->is_active))>
                                <label class="form-check-label" for="is_active">Show on home page</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-text">Lower numbers show first. The "Donate today" and "Read their stories" buttons are added automatically.</div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg"><i class="bi-check-lg"></i> {{ $slide->exists ? 'Save changes' : 'Add slide' }}</button>
                    <a href="{{ $return ?? route('admin.hero.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection

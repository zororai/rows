@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'Gallery',
        'title' => 'Moments & milestones',
        'intro' => 'By the grace of the Almighty we have achieved wonderful things. Praise be given to His power, which is shown through us.',
    ])

    @php($isAdmin = (bool) auth()->user()?->is_admin)
    @php($here = request()->getRequestUri())

    <section class="section">
        <div class="container">
            @if ($isAdmin)
                @if (session('status'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4"><i class="bi-check-circle-fill"></i> {{ session('status') }}</div>
                @endif
                <div class="admin-cta mb-5">
                    <div>
                        <strong>Manage the gallery</strong>
                        <span class="d-block text-muted-2 small">Use the buttons on each photo to edit or delete it. Only administrators can see this.</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.gallery.index') }}" class="btn-outline-green">Manage gallery</a>
                        <a href="{{ route('admin.gallery.create', ['return' => $here]) }}" class="btn-rose"><i class="bi-cloud-arrow-up"></i> Upload photos</a>
                    </div>
                </div>
            @endif

            @if ($categories->isNotEmpty())
                <div class="filter-pills mb-5">
                    <a href="{{ route('gallery') }}" @class(['active' => ! $category])>All</a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('gallery', ['category' => $cat]) }}" @class(['active' => $category === $cat])>{{ $cat }}</a>
                    @endforeach
                </div>
            @endif

            @if ($images->isEmpty())
                <p class="text-center text-muted-2">No photos yet.</p>
            @else
                <div class="gallery-grid">
                    @foreach ($images as $image)
                        <figure class="gallery-item m-0 mb-3" data-src="{{ $image->image_url }}" data-caption="{{ trim($image->title.' '.($image->caption ? '· '.$image->caption : '')) }}">
                            <img src="{{ $image->image_url }}" alt="{{ $image->title ?? 'Gallery photo' }}" loading="lazy">
                            @if ($image->title || $image->caption)
                                <figcaption><strong>{{ $image->title }}</strong> {{ $image->caption }}</figcaption>
                            @endif
                            @if ($isAdmin)
                                <div class="admin-tools">
                                    <a href="{{ route('admin.gallery.edit', ['gallery' => $image, 'return' => $here]) }}" title="Edit photo"><i class="bi-pencil"></i> Edit</a>
                                    <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Delete this photo? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="danger" title="Delete photo"><i class="bi-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        </figure>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $images->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Photo viewer">
        <button type="button" aria-label="Close">&times;</button>
        <img src="" alt="">
        <p></p>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        const box = document.getElementById('lightbox');
        const img = box.querySelector('img');
        const cap = box.querySelector('p');
        const close = () => box.classList.remove('open');

        document.querySelectorAll('.gallery-item').forEach(function (item) {
            item.addEventListener('click', function (e) {
                if (e.target.closest('.admin-tools')) return;
                img.src = item.dataset.src;
                cap.textContent = item.dataset.caption || '';
                box.classList.add('open');
            });
        });
        box.addEventListener('click', function (e) { if (e.target !== img) close(); });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
    })();
</script>
@endpush

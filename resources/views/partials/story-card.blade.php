<article class="story-card">
    <a href="{{ route('stories.show', $story) }}" @class(['story-card-img', 'is-graphic' => $story->image_is_graphic])>
        <img src="{{ $story->image_url }}" alt="{{ $story->title }}" loading="lazy">
    </a>
    <div class="story-card-body">
        <span class="date">{{ $story->published_at?->format('j M Y') }}</span>
        <h3><a href="{{ route('stories.show', $story) }}">{{ $story->title }}</a></h3>
        <p>{{ \Illuminate\Support\Str::limit($story->summary, 140) }}</p>
        <a href="{{ route('stories.show', $story) }}" class="link-arrow">Read story <i class="bi-arrow-right"></i></a>
    </div>
</article>

<section class="page-header">
    <div class="container">
        @isset($eyebrow)<span class="eyebrow">{{ $eyebrow }}</span>@endisset
        <h1>{{ $title }}</h1>
        @isset($intro)<p>{{ $intro }}</p>@endisset
    </div>
</section>

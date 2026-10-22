<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Story extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'image', 'is_published', 'published_at'];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset($this->image) : asset('images/DSC_0026.jpg');
    }

    /** The imported before/after graphics are wide artwork on white, so show them uncropped. */
    public function getImageIsGraphicAttribute(): bool
    {
        return str_starts_with((string) $this->image, 'images/news/');
    }

    /** Short summary for cards: the excerpt, or the start of the body. */
    public function getSummaryAttribute(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags($this->body), 160);
    }

    /** Body split into paragraphs on blank lines, for safe rendering. */
    public function getParagraphsAttribute(): array
    {
        return array_values(array_filter(array_map('trim', preg_split("/\R\s*\R/", $this->body))));
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'story';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}

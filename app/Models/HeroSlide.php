<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = ['image', 'title', 'subtitle', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /** The original banner, used for seeding and whenever no slide is active. */
    public static function fallback(): self
    {
        return new self([
            'image' => 'images/DSC_0026.jpg',
            'title' => 'Making *champions* out of the forgotten.',
            'subtitle' => 'Since 2004, Rose of Sharon has given orphaned, abandoned and neglected children in Zimbabwe a home, a family, an education and a future.',
            'is_active' => true,
            'sort_order' => 0,
        ]);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->ordered();
    }

    public function getImageUrlAttribute(): string
    {
        return asset($this->image);
    }

    /** Escaped headline where *word* becomes a highlighted <em>word</em>. */
    public function getTitleHtmlAttribute(): string
    {
        return preg_replace('/\*(.+?)\*/', '<em>$1</em>', e($this->title));
    }
}

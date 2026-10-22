<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\HeroSlide;
use App\Models\Story;

class PageController extends Controller
{
    public function home()
    {
        return view('home', [
            'slides' => HeroSlide::active()->get()->whenEmpty(fn ($slides) => $slides->push(HeroSlide::fallback())),
            'stories' => Story::published()->take(3)->get(),
            'gallery' => GalleryImage::where('show_on_home', true)->ordered()->take(8)->get(),
        ]);
    }
}

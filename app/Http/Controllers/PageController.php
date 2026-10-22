<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Story;

class PageController extends Controller
{
    public function home()
    {
        return view('home', [
            'stories' => Story::published()->take(3)->get(),
            'gallery' => GalleryImage::where('show_on_home', true)->ordered()->take(8)->get(),
        ]);
    }
}

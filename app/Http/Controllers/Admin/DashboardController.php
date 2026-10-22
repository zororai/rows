<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\Story;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'storyCount' => Story::count(),
            'publishedCount' => Story::where('is_published', true)->count(),
            'imageCount' => GalleryImage::count(),
            'recentStories' => Story::latest()->take(5)->get(),
            'recentImages' => GalleryImage::latest()->take(6)->get(),
        ]);
    }
}

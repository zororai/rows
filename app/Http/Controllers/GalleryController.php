<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        return view('gallery', [
            'images' => GalleryImage::ordered()
                ->when($category, fn ($q) => $q->where('category', $category))
                ->paginate(24)
                ->withQueryString(),
            'categories' => GalleryImage::whereNotNull('category')->distinct()->orderBy('category')->pluck('category'),
            'category' => $category,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Support\ImageUpload;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index', [
            'images' => GalleryImage::ordered()->paginate(24),
        ]);
    }

    public function create()
    {
        return view('admin.gallery.create', [
            'categories' => $this->categories(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'images' => ['required', 'array', 'max:20'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'title' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:500'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        $files = $request->file('images');

        foreach ($files as $file) {
            GalleryImage::create([
                'image' => ImageUpload::store($file, 'gallery'),
                'title' => $data['title'] ?? null,
                'caption' => $data['caption'] ?? null,
                'category' => $data['category'] ?? null,
                'show_on_home' => $request->boolean('show_on_home'),
            ]);
        }

        $message = count($files) === 1 ? 'Image uploaded.' : count($files).' images uploaded.';

        return redirect()->route('admin.gallery.index')->with('status', $message);
    }

    public function edit(GalleryImage $gallery)
    {
        return view('admin.gallery.edit', [
            'image' => $gallery,
            'categories' => $this->categories(),
        ]);
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'title' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:500'],
            'category' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        unset($data['image']);
        $data['sort_order'] ??= 0;
        $data['show_on_home'] = $request->boolean('show_on_home');

        if ($request->hasFile('image')) {
            ImageUpload::delete($gallery->image);
            $data['image'] = ImageUpload::store($request->file('image'), 'gallery');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('status', 'Image updated.');
    }

    public function destroy(GalleryImage $gallery)
    {
        ImageUpload::delete($gallery->image);
        $gallery->delete();

        return back()->with('status', 'Image deleted.');
    }

    private function categories()
    {
        return GalleryImage::whereNotNull('category')->distinct()->orderBy('category')->pluck('category');
    }
}

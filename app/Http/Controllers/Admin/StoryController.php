<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Support\ImageUpload;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');

        return view('admin.stories.index', [
            'stories' => Story::when($search, fn ($q) => $q->where('title', 'like', "%{$search}%"))
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->paginate(15)
                ->withQueryString(),
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('admin.stories.form', [
            'story' => new Story(['is_published' => true, 'published_at' => now()]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Story::uniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = ImageUpload::store($request->file('image'), 'stories');
        }

        Story::create($data);

        return redirect()->route('admin.stories.index')->with('status', 'Story saved.');
    }

    public function edit(Story $story)
    {
        return view('admin.stories.form', ['story' => $story]);
    }

    public function update(Request $request, Story $story)
    {
        $data = $this->validated($request);

        if ($data['title'] !== $story->title) {
            $data['slug'] = Story::uniqueSlug($data['title'], $story->id);
        }

        if ($request->hasFile('image')) {
            ImageUpload::delete($story->image);
            $data['image'] = ImageUpload::store($request->file('image'), 'stories');
        } elseif ($request->boolean('remove_image')) {
            ImageUpload::delete($story->image);
            $data['image'] = null;
        }

        $story->update($data);

        return redirect()->route('admin.stories.index')->with('status', 'Story updated.');
    }

    public function destroy(Story $story)
    {
        ImageUpload::delete($story->image);
        $story->delete();

        return back()->with('status', 'Story deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'published_at' => ['nullable', 'date'],
        ]);

        unset($data['image']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] ??= now();

        return $data;
    }
}

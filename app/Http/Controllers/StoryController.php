<?php

namespace App\Http\Controllers;

use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        return view('stories.index', [
            'stories' => Story::published()->paginate(9),
        ]);
    }

    public function show(Story $story)
    {
        abort_unless($story->is_published && (! $story->published_at || $story->published_at->isPast()), 404);

        return view('stories.show', [
            'story' => $story,
            'more' => Story::published()->where('id', '!=', $story->id)->take(3)->get(),
        ]);
    }
}

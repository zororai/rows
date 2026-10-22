<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HeroSlideController extends Controller
{
    public function index()
    {
        return view('admin.hero.index', [
            'slides' => HeroSlide::ordered()->get(),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.hero.form', [
            'slide' => new HeroSlide(['is_active' => true, 'sort_order' => HeroSlide::max('sort_order') + 1]),
            'return' => $this->returnPath($request),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, imageRequired: true);
        $data['image'] = ImageUpload::store($request->file('image'), 'hero');

        HeroSlide::create($data);

        return redirect($this->returnPath($request) ?? route('admin.hero.index'))->with('status', 'Banner slide added.');
    }

    public function edit(Request $request, HeroSlide $hero)
    {
        return view('admin.hero.form', [
            'slide' => $hero,
            'return' => $this->returnPath($request),
        ]);
    }

    public function update(Request $request, HeroSlide $hero)
    {
        $data = $this->validated($request, imageRequired: false);

        if ($request->hasFile('image')) {
            ImageUpload::delete($hero->image);
            $data['image'] = ImageUpload::store($request->file('image'), 'hero');
        }

        $hero->update($data);

        return redirect($this->returnPath($request) ?? route('admin.hero.index'))->with('status', 'Banner slide updated.');
    }

    public function destroy(HeroSlide $hero)
    {
        ImageUpload::delete($hero->image);
        $hero->delete();

        return back()->with('status', 'Banner slide deleted.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'title' => ['required', 'string', 'max:120'],
            'subtitle' => ['nullable', 'string', 'max:300'],
            'transition' => ['nullable', Rule::in(array_keys(HeroSlide::TRANSITIONS))],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        unset($data['image']);
        $data['sort_order'] ??= 0;
        $data['transition'] ??= 'fade';
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}

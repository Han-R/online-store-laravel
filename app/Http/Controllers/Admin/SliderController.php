<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SliderImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);
    }

    public function index(Request $request)
    {
        $items = Slider::query();
        if ($request->has('title')) {
            if ($request->get('title') != null)
                $items->whereHas('translations', function ($query) use ($request) {
                    $query->where('locale', app()->getLocale())
                        ->where('title', 'like', '%' . $request->get('title') . '%');
                });
        }
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.slider.home', [
            'items' => $items,
        ]);

    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $roles = [
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ];
        foreach ($this->locales as $locale) {
            $roles['title_' . $locale->lang] = 'required';
        }
        $this->validate($request, $roles);
        $image = $request->file('image')->store('uploads/sliders');

        $item = New Slider;
        $item->image =$image;
        foreach ($this->locales as $locale) {
            $item->translateOrNew($locale->lang)->title = ucwords($request->get('title_' . $locale->lang));
        }
        if ($request->hasFile('image')) {
            $icon = $request->file('image');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".png";
            Image::make($icon)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/sliders/$name");
            $item->image = $name;
        }
        $item->save();
        return redirect()->back()->with('status', __('common.create'));
    }

    public function show($id)
    {
        return Slider::query()->findOrFail($id);
    }

    public function edit($id)
    {
        $item = $this->show($id);
        return view('admin.slider.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $roles = [
            'image' => 'image|mimes:jpeg,jpg,png',
        ];
        foreach ($this->locales as $locale) {
            $roles['title_' . $locale->lang] = 'required';
        }
        $this->validate($request, $roles);
        $item = Slider::findOrFail($id);
        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".png";
            Image::make($avatar)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/sliders/$name");
            $item->image = $name;
        }

        foreach ($this->locales as $locale) {
            $item->translateOrNew($locale->lang)->title = ucwords($request->get('title_' . $locale->lang));
        }

        $item->save();
        return redirect()->back()->with('status', __('common.update'));


    }

    public function destroy($id)
    {
        $item = Slider::query()->findOrFail($id);
        if ($item) {
            Slider::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function changeStatus(Request $request)
    {
        if ($request->event == 'delete') {
            Slider::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Slider::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }


}

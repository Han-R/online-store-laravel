<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\DepartmentTranslation;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
class DepartmentController extends Controller
{
    protected $settings = '';
    protected $locales = '';

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::orderBy('id','desc')->first();
        view()->share('locales', $this->locales);
        view()->share('setting', $this->settings);
    }

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp');

    }

    public function index(Request $request)
    {
        $items = Department::query();

        if ($request->has('name')) {
            if ($request->get('name') != null)
                $items->whereHas('translations', function ($query) use ($request) {
                    $query->where('locale', app()->getLocale())
                        ->where('name', 'like', '%' . $request->get('title') . '%');
                });
        }

        $items = $items->orderBy('id', 'desc')->get();
        //return $items;
        return view('admin.departments.home', [
            'items' => $items,
        ]);

    }

    public function create()
    {
        // return $specializations;
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {

        $roles = [
            'icon' => 'mimes:jpeg,bmp,png,gif',
        ];
        foreach ($this->locales as $locale) {
            $roles['name_' . $locale->lang] = 'required';
            $roles['details_' . $locale->lang] = 'required';
        }
        $this->validate($request, $roles);

        $new = New Department();
        foreach ($this->locales as $locale) {
            $new->translateOrNew($locale->lang)->name = ucwords($request->get('name_' . $locale->lang));
            $new->translateOrNew($locale->lang)->details = $request->get('details_' . $locale->lang);
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".png";
            Image::make($icon)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/departments/$name");
            $new->icon = $name;
        }
        $new->save();
        return redirect()->back()->with('status', __('common.create'));
    }

    public function show($id)
    {
        return Department::query()->findOrFail($id);
    }

    public function edit($id)
    {
        $item = $this->show($id);
        return view('admin.departments.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $roles = [
            'icon' => 'mimes:jpeg,bmp,png,gif',
        ];
        foreach ($this->locales as $locale) {
            $roles['name_' . $locale->lang] = 'required';
            $roles['details_' . $locale->lang] = 'required';
        }
        $this->validate($request, $roles);

        $one = Department::findOrFail($id);
        foreach ($this->locales as $locale) {
            $one->translateOrNew($locale->lang)->name = ucwords($request->get('name_' . $locale->lang));
            $one->translateOrNew($locale->lang)->details = $request->get('details_' . $locale->lang);
        }
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".png";
            Image::make($icon)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/departments/$name");
            $one->icon = $name;
        }
        $one->save();
        return redirect()->back()->with('status', __('common.update'));


    }

    public function destroy($id)
    {
        $item = Department::query()->findOrFail($id);
        if ($item) {
            Department::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function changeStatus(Request $request)
    {
        if ($request->event == 'delete') {
            Department::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Department::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }
}

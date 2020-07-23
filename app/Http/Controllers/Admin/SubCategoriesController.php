<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
class SubCategoriesController extends Controller
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
        $items = Category::query()->where('parent_id','>',0);
        if ($request->has('name')) {
            if ($request->get('name') != null)
                $items->whereHas('translations', function ($query) use ($request) {
                    $query->where('locale', app()->getLocale())
                        ->where('name', 'like', '%' . $request->get('title') . '%');
                });
        }
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.subCategories.home', [
            'items' => $items,
        ]);
    }

    public function create()
    {
        $departments = Department::orderBy('id', 'desc')->get();
        return view('admin.subCategories.create', [
            'departments' => $departments,
        ]);
    }

    public function edit($id)
    {
        $item = Category::query()->findOrFail($id);
        $departments = Department::orderBy('id', 'desc')->get();
        $categories = Category::where('department_id',$item->department_id)->orderBy('id', 'desc')->get();
        return view('admin.subCategories.edit', [
            'item' => $item,
            'departments' => $departments,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $roles = [
            'icon' => 'mimes:jpeg,bmp,png,gif',
            'parent_id' => 'required',
        ];
        foreach ($this->locales as $locale) {
            $roles['name_' . $locale->lang] = 'required';
            $roles['details_' . $locale->lang] = 'required';
        }
        $this->validate($request, $roles);

        $new = New Category();
        foreach ($this->locales as $locale) {
            $new->translateOrNew($locale->lang)->name = ucwords($request->get('name_' . $locale->lang));
            $new->translateOrNew($locale->lang)->details = $request->get('details_' . $locale->lang);
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".png";
            Image::make($icon)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/categories/$name");
            $new->icon = $name;
        }
        $new->department_id = $request->get('department_id');
        $new->parent_id = $request->get('parent_id');
        $new->save();
        return redirect()->back()->with('status', __('common.create'));
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

        $one = Category::findOrFail($id);
        foreach ($this->locales as $locale) {
            $one->translateOrNew($locale->lang)->name = ucwords($request->get('name_' . $locale->lang));
            $one->translateOrNew($locale->lang)->details = $request->get('details_' . $locale->lang);
        }
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".png";
            Image::make($icon)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/categories/$name");
            $one->icon = $name;
        }
        $one->department_id = $request->get('department_id');
        $one->parent_id = $request->get('parent_id');
        $one->save();
        return redirect()->back()->with('status', __('common.update'));


    }

    public function destroy($id)
    {
        $item = Category::query()->findOrFail($id);
        if ($item) {
            Category::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function changeStatus(Request $request)
    {
        if ($request->event == 'delete') {
            Category::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Category::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }

    public function getSubCategories($id)
    {
        $categories =  Category::where('parent_id',$id)->get();
        return ['status'=>'success','categories'=>$categories];
    }

}

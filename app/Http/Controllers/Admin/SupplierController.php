<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Supplier;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
class SupplierController extends Controller
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
        $items = Supplier::query();

        if ($request->has('name')) {
            if ($request->get('name') != null)
                $items->whereHas('translations', function ($query) use ($request) {
                    $query->where('locale', app()->getLocale())
                        ->where('name', 'like', '%' . $request->get('title') . '%');
                });
        }

        $items = $items->orderBy('id', 'desc')->get();
        //return $items;
        return view('admin.suppliers.home', [
            'items' => $items,
        ]);

    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {


        foreach ($this->locales as $locale) {
            $roles['name_' . $locale->lang] = 'required';
//            $roles['details_' . $locale->lang] = 'required';
        }
        $this->validate($request, $roles);

        $new = New Supplier();
        foreach ($this->locales as $locale) {
            $new->translateOrNew($locale->lang)->name = ucwords($request->get('name_' . $locale->lang));
//            $new->translateOrNew($locale->lang)->details = $request->get('details_' . $locale->lang);
        }
        $new->save();
        return redirect()->back()->with('status', __('common.create'));
    }

    public function edit($id)
    {
        $item = Supplier::query()->findOrFail($id);
        return view('admin.suppliers.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        foreach ($this->locales as $locale) {
            $roles['name_' . $locale->lang] = 'required';
//            $roles['details_' . $locale->lang] = 'required';
        }
        $this->validate($request, $roles);

        $one = Supplier::findOrFail($id);
        foreach ($this->locales as $locale) {
            $one->translateOrNew($locale->lang)->name = ucwords($request->get('name_' . $locale->lang));
//            $one->translateOrNew($locale->lang)->details = $request->get('details_' . $locale->lang);
        }
        $one->save();
        return redirect()->back()->with('status', __('common.update'));


    }

    public function destroy($id)
    {
        $item = Supplier::query()->findOrFail($id);
        if ($item) {
            Supplier::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function changeStatus(Request $request)
    {
        if ($request->event == 'delete') {
            Supplier::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Supplier::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }



}

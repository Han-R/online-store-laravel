<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Language;
use App\Models\Land;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Cookie;

class LandController extends Controller
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
        $items = Land::query();
        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status', $request->get('status'));
        }
        $items = $items->orderBy('id', 'desc')->get();
        //return $items;
        return view('admin.land.home', [
            'items' => $items,
        ]);

    }

    public function create()
    {
        $locales = Language::all();
        //return $locales;
        return view('admin.land.create',['locales'=>$locales]);
    }

    public function store(Request $request)
    {
        //return $request->method();
        //return $request->all();
        $roles = [
            
        ];
       

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        $this->validate($request, $roles);


        $item= New Land() ;

        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $item->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        $item->save();
        return redirect()->back()->with('status', __('common.create'));
        //return redirect()->back()->withCookie(Cookie::with);
    }



    public function show($id)
    {
        return Land::query()->findOrFail($id);
    }

    public function edit($id)
    {
        $item = $this->show($id);
        return view('admin.land.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        //return $request->all();


        $roles = [
            
        ];


       

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        $this->validate($request, $roles);


        $item = Land::query()->where('id', $id)->firstOrFail();

        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $item->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

       

        $item->save();
        return redirect()->back()->with('status', __('common.update'));


    }

    public function destroy($id)
    {
       // return $id;
        $item = Land::query()->findOrFail($id);
        if ($item) {
            Land::query()->where('id', $id)->delete();
            LandTranslation::query()->where('land_id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function changeStatus(Request $request)
    {
        //return $request->all();
        if ($request->event == 'delete') {
            Land::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Land::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }
}

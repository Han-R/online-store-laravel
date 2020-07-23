<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Ads;
use App\Models\AdsTranslation;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AdsController extends Controller
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

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp');

    }



    public function index(Request $request)
    {
        $items = Ads::query();
        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status', $request->get('status'));
        }
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.ads.home', [
            'items' => $items,
        ]);

    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $roles = [
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ];

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['descriptions_' . $locale] = 'required';
        }


        $this->validate($request, $roles);

        $item = New Ads();

        if(Input::file("image")&&Input::file("image")!=NULL)
        {
            if (Input::file("image")->isValid())
            {
                $destinationPath=public_path('uploads/ads');

                $extension=strtolower(Input::file("image")->getClientOriginalExtension());
                //dd($extension);
                $array= $this->image_extensions();
                if(in_array($extension,$array))
                {
                    $fileName=uniqid().'.'.$extension;
                    Input::file("image")->move($destinationPath, $fileName);
                }
            }
        }

        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->descriptions = $request->get('descriptions_' . $locale);
        }

        if(isset($fileName)){$item->image='uploads/ads/'.$fileName;}


        $item->order_by = $request->order;
        $item->save();
        return redirect()->back()->with('status', __('common.create'));
    }

    public function show($id)
    {
        return Ads::query()->findOrFail($id);
    }

    public function edit($id)
    {
        $item = $this->show($id);
        return view('admin.ads.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $roles = [
            'image' => 'image|mimes:jpeg,jpg,png',
        ];

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['descriptions_' . $locale] = 'required';
        }


        $this->validate($request, $roles);

        $item = Ads::query()->findOrFail($id);

        if(Input::file("image")&&Input::file("image")!=NULL)
        {
            if (Input::file("image")->isValid())
            {
                $destinationPath=public_path('uploads/ads');

                $extension=strtolower(Input::file("image")->getClientOriginalExtension());
                //dd($extension);
                $array= $this->image_extensions();
                if(in_array($extension,$array))
                {
                    $fileName=uniqid().'.'.$extension;
                    Input::file("image")->move($destinationPath, $fileName);
                }
            }
        }

        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->descriptions = $request->get('descriptions_' . $locale);
        }

        if(isset($fileName)){$item->image='uploads/ads/'.$fileName;}
$item->order_by = $request->order;
        $item->save();
        return redirect()->back()->with('status', __('common.update'));


    }

    public function destroy($id)
    {
        $item = Ads::query()->findOrFail($id);
        if ($item) {
            Ads::query()->where('id', $id)->delete();
            AdsTranslation::query()->where('ads_id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function changeStatus(Request $request)
    {
        //return $request->all();
        if ($request->event == 'delete') {
            Ads::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Ads::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class SettingController extends Controller
{
    private $locales = '';

    public function __construct()
    {
        $this->locales = Language::all();
        view()->share([
            'locales' => $this->locales,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf','txt','docx','doc','ppt','xls','zip','rar');

    }


    public function index()
    {

        $settings = Setting::query()->first();
         //return $setting->translate('en')->title;
        return view('admin.settings.edit', ['setting' => $settings]);
    }

    public function update(Request $request)
    {
       //dd($request->all());
        $locales = Language::all()->pluck('lang');
        $roles = [
            'url' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|integer',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
        ];
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['address_' . $locale] = 'required';
            $roles['keywords_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }
        $this->validate($request, $roles);
        $setting = Setting::query()->findOrFail(1);
        $setting->url = trim($request->get('url'));
        $setting->email = trim($request->get('email'));
        $setting->mobile = trim($request->get('mobile'));
        $setting->facebook = trim($request->get('facebook'));
        $setting->twitter = trim($request->get('twitter'));
        $setting->instagram = trim($request->get('instagram'));


        if(Input::file("logo")&&Input::file("logo")!=NULL)
        {
            if (Input::file("logo")->isValid())
            {
                $destinationPath='uploads/settings';

                $extension=strtolower(Input::file("logo")->getClientOriginalExtension());
                //dd($extension);
                $array= $this->image_extensions();
                if(in_array($extension,$array))
                {
                    $fileName_logo=uniqid().'.'.$extension;
                    Input::file("logo")->move($destinationPath, $fileName_logo);
                }
            }
        }



        foreach ($locales as $locale) {
            $setting->translate($locale)->name = trim(ucwords($request->get('name_' . $locale)));
            $setting->translate($locale)->address = trim(ucwords($request->get('address_' . $locale)));
            $setting->translate($locale)->keywords = trim(ucwords($request->get('keywords_' . $locale)));
            $setting->translate($locale)->description = ucwords($request->get('description_' . $locale));
        }
        if(isset($fileName_logo)){$setting->logo= $fileName_logo;}
        $setting->save();
        return redirect()->back()->with('status', 'setting updated successfully');
    }
}

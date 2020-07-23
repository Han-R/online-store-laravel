<?php

namespace App\Http\Controllers\admin;


use App\Models\City;
use App\Models\Setting;
use App\Admin;
use App\User;
use Image;
use App\Models\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;

use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf');

    }

    protected $settings = '';
    protected $locales = '';

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::orderBy('id','desc')->first();
        view()->share('locales', $this->locales);
        view()->share('setting', $this->settings);
    }

    public function index(Request $request)
    {
        $items = Admin::query();
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', 'like', '%' . $request->get('mobile') . '%');
        }
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.managers.home', [
            'items' => $items,
        ]);

    }

    public function destroy($id)
    {
        $item = Admin::query()->findOrFail($id);
        if ($item) {
            Admin::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function create()
    {
        return view('admin.managers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:admins',
            'mobile'=>'required|min:10|max:14|unique:admins',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin= New Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->password = bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
                $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                Image::make($avatar)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/managers/$name");
            $admin->avatar = $name;
        }
        $admin->save();
        return redirect()->back()->with('status', __('common.create'));
    }

    public function edit($id)
    {
        //dd($id);
        $item = Admin::findOrFail($id);
        //return $item;

        return view('admin.managers.edit',['item'=>$item]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:admins,id,'.$id,
            'mobile'=>'required|min:10|max:14|unique:admins,id,'.$id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin= Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
            Image::make($avatar)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/managers/$name");
            $admin->avatar = $name;
        }
        $admin->save();
        return redirect()->back()->with('status', __('common.update'));
    }

    public function edit_password(Request $request, $id)
    {
        //dd($id);
        $item = Admin::findOrFail($id);
        return view('admin.managers.edit_password',['item'=>$item]);
    }

    public function update_password(Request $request, $id)
    {
        //dd($request->all());
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = Admin::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect()->back()->with('status', __('common.update'));
    }



}

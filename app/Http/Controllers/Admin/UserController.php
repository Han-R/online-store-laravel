<?php

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Setting;
use App\Models\Language;
use App\User;
use Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;

use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $items = User::query();
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', 'like', '%' . $request->get('mobile') . '%');
        }
        $items = $items->orderBy('id', 'desc')->get();
        //return $items;
        return view('admin.users.home', [
            'items' => $items,
        ]);

    }

    public function destroy($id)
    {
        $item = User::query()->findOrFail($id);
        if ($item) {
            User::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function create()
    {
        $users = User::all();
        return view('admin.users.create',['users'=>$users]);
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

        $user= New User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
            Image::make($avatar)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/users/$name");
            $user->avatar = $name;
        }
        $user->save();
        return redirect()->back()->with('status', __('common.create'));
    }

    public function edit($id)
    {
        //dd($id);
        $item = User::findOrFail($id);

        return view('admin.users.edit',['item'=>$item]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,id,'.$id,
            'mobile'=>'required|min:10|max:14|unique:users,id,'.$id,
            'status'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user= User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->status = $request->status;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
            Image::make($avatar)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/users/$name");
            $user->avatar = $name;
        }
        $user->save();
        return redirect()->back()->with('status', __('common.update'));
    }

    public function edit_password(Request $request, $id)
    {
        $item = User::findOrFail($id);
        return view('admin.users.edit_password',['item'=>$item]);
    }

    public function update_password (Request $request, $id)
    {
       $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
         return redirect()->back()->with('status', __('common.update'));
    }

    public function changeStatus(Request $request)
    {
        //return $request->all();
        if ($request->event == 'delete') {
            User::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            if($request->event=='not_active'){
                User::query()->whereIn('id', $request->IDsArray)->update(['status' => 0]);

            }else if($request->event=='active'){
                User::query()->whereIn('id', $request->IDsArray)->update(['status' => 1]);

            }else{
                User::query()->whereIn('id', $request->IDsArray)->update(['status' => 2]);
            }

        }
        return $request->event;
    }

}

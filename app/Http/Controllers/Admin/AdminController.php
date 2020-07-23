<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Models\City;
use App\Models\Setting;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;

use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf');

    }


    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
    }

    public function index_owner(Request $request)
    {
        $items = Admin::query()->where('id','!=',1);
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email', 'like', '%' . $request->get('email') . '%');
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', 'like', '%' . $request->get('mobile') . '%');
        }
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.admin.home', [
            'items' => $items,
        ]);

    }

    public function destroy_owner($id)
    {
if($id == 1){return "fail";}
        $item = Admin::query()->findOrFail($id);
        if ($item) {
            Admin::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }





    public function create_owner()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_owner(Request $request)
    {
        //dd($request->all());
        $users_rules=array(
            'name'=>'required|string|max:255|unique:admins',
            'email'=>'required|email|unique:admins',
            'mobile'=>'required|integer|min:8|unique:admins',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
            //'location'=>'required|string',
            //'lat'=>'required',
            //'lan'=>'required',
        );
        if(app()->getLOcale() == 'en'){
        $customMessages = [
        'email' => 'The email must be a valid email address.',
        'integer' => 'The mobile must be a valid integer number.'
    ];
        }else{
            $customMessages = [
        'email' => 'عنوان البريد الالكتروني يجب ان يكون صحيحا',
        'integer' => 'الموبايل يجب ان يكون عددا صحيحا',
    ]; 
            
        }

        $users_validation=Validator::make($request->all(), $users_rules,$customMessages);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }



        $user='';


        $confirmation_code = str_random(20);
        $user= New Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
//        $user->location = $request->location;
//        $user->lat = $request->lat;
//        $user->lan = $request->lan;

        $user->password = Hash::make($request->password);

        if(Input::file("profile_image")&&Input::file("profile_image")!=NULL)
        {
            if (Input::file("profile_image")->isValid())
            {
                $destinationPath=public_path('uploads/users');

                $extension=strtolower(Input::file("profile_image")->getClientOriginalExtension());
                //dd($extension);
                $array= $this->image_extensions();
                if(in_array($extension,$array))
                {
                    $fileName_person=uniqid().'.'.$extension;
                    Input::file("profile_image")->move($destinationPath, $fileName_person);
                }
            }
        }


        if(isset($fileName_person)){$user->image='uploads/users/'.$fileName_person;}
        $user->save();

        // $email = $request->email;
        // $username = $request->name;



        //   $data22 = array(
        //      'confirmation_code' => $confirmation_code,
        //      'name' => $request->name,
        //      //'code'=>$confirmation_code,
        //      'email' => $request->email,
        //      'password' => $request->password,
        //  );


        //   Mail::send('email.email', $data22, function ($message) {
        //     //dd($this->user->name);
        //     $message->to('mohamed.alijla@gmail.com', 'mohamed')
        //         ->subject('تطبيق المحامي محمد جميل')
        //         ->replyTo('a@gmail.com', $name = null)
        //         ->from('a@gmail.com', 'a@gmail.com');

        // });



        return redirect()->back()->with('status', __('common.create'));
    }






    public function edit_owner($id)
    {
        //dd($id);
        $item = Admin::findOrFail($id);
        //return $item;

        return view('admin.admin.edit',['item'=>$item]);
    }

    public function update_owner(Request $request, $id)
    {


        //dd($request->all());
        
        $users_rules=array(
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:admins,id,'.$id,
            'mobile'=>'required|integer|min:8',
//            'lat'=>'required',
//            'lan'=>'required',
//            'location'=>'required',
        );
        
         if(app()->getLOcale() == 'en'){
        $customMessages = [
        'email' => 'The email must be a valid email address. ',
        'integer' => 'The mobile must be a valid integer number.'
    ];
        }else{
            $customMessages = [
        'email' => 'عنوان البريد الالكتروني يجب ان يكون صحيحا',
        'integer' => 'الموبايل يجب ان يكون عددا صحيحا',
    ]; 
            
        }
        
        
        $users_validation = Validator::make($request->all(), $users_rules,$customMessages);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }



        $user='';


        $user= Admin::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if(Input::file("profile_image")&&Input::file("profile_image")!=NULL)
        {
            if (Input::file("profile_image")->isValid())
            {
                $destinationPath=public_path('uploads/users');

                $extension=strtolower(Input::file("profile_image")->getClientOriginalExtension());
                //dd($extension);
                $array= $this->image_extensions();
                if(in_array($extension,$array))
                {
                    $fileName_person=uniqid().'.'.$extension;
                    Input::file("profile_image")->move($destinationPath, $fileName_person);
                }
            }
        }


        if(isset($fileName_person)){$user->image='uploads/users/'.$fileName_person;}
        $user->save();


        return redirect()->back()->with('status', __('common.update'));
    }



    public function edit_password_owner(Request $request, $id)
    {
        //dd($id);

        $item = Admin::findOrFail($id);
        return view('admin.owner.edit_password',['item'=>$item]);
    }


    public function update_password_owner(Request $request, $id)
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

<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Models\Setting;
use App\Models\Category;
use App\Models\DepartmentUsers;
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

class AnotherStatusUserController extends Controller
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

        if($request->get('category') and $request->get('category') != ''){
           
        $ides_users = DepartmentUsers::whereIn('category_id',$request->get('category'))->pluck('user_id')->toArray();

        $items->whereIn('id',$ides_users);
        }




        $items = $items->where('admin', 1)->orderBy('id', 'desc')->get();

        $departments = Category::all();


        return view('admin.anotherstatususer.home', [
            'items' => $items,
'categories'=>$departments,
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
        $departments = Category::all();
        return view('admin.anotherstatususer.create',[
            'users'=>$users,
            'categories'=>$departments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $users_rules=array(
            'name'=>'required|string|max:255|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'mobile'=>'nullable|integer',
            'confirm_password'=>'required|same:password|min:6',
            'category'=>'required',
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
        $user= New User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->code = 1111;
        $user->verification = 1;
        $user->admin = 1;
        // 'code' => $confirmation_code,
        // 'activate' => '0',
        // 'active_phon'=>'0',
        $user->save();


         if($request->get('category') and $request->get('category') != ''){
            foreach ($request->get('category') as $value) {
                # code...
                $new = New DepartmentUsers();
                $new->user_id = $user->id;
                $new->category_id = $value;
                $new->save();
            }

        }

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



    public function edit($id)
    {
        //dd($id);
        $item = User::findOrFail($id);
        $categories = Category::all();
        $departments = DepartmentUsers::where('user_id',$id)->get();
        //return $item;

        return view('admin.anotherstatususer.edit',[
            'item'=>$item,
            'departments'=>$departments,
            'categories'=>$categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $users_rules=array(
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,id,'.$id,
            'location'=>'required|string|max:255',
            'mobile'=>'nullable|integer',
            'lat'=>'required',
            'lan'=>'required',
            'category'=>'required',
            'verification'=>'required',
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
        $user= User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->location = $request->location;
        $user->verification = $request->verification;
        if($request->lat != null){$user->lat = $request->lat;}
        if($request->lan != null){$user->lan = $request->lan;}

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


        if(isset($fileName_person)){$user->profile_image='uploads/users/'.$fileName_person;}




        // 'code' => $confirmation_code,
        // 'activate' => '0',
        // 'active_phon'=>'0',
        $user->save();


        if($request->get('category') and $request->get('category') != ''){
            //return $request->all();

            DepartmentUsers::where('user_id',$id)->delete();

            foreach ($request->get('category') as $value) {
                # code...
                $new = New DepartmentUsers();
                $new->user_id = $id;
                $new->category_id = $value;
                $new->save();
            }

        }


        // $this->user=$user;

        //       $data22 = array(
        //     'confirmation_code' => $confirmation_code,
        //     'name'= $request->name;
        //     //'code'=>$confirmation_code,
        //     'email'= $request->email;
        //     'password'= $request->password;
        // );


        //     Mail::send('email.email', $data22, function($message) {
        //      //dd($this->user->name);
        //     $message->to($this->user->email, $this->user->name)
        //             ->subject('تطبيق المحامي محمد جميل')
        //     ->replyTo('a@gmail.com', $name = null)
        //     ->from('a@gmail.com', 'a@gmail.com');

        //     });
        //      $email =$this->user->email;
        //      $username =$this->user->name;
        //      $user_id =$this->user->id;


        return redirect()->back()->with('status', __('common.update'));

    }
    
    
    
      public function edit_password(Request $request, $id)
    {
       //dd($id);
        $item = User::findOrFail($id);
        return view('admin.anotherstatususer.edit_password',['item'=>$item]);
    }


    public function update_password (Request $request, $id)
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
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        // $this->user=$user;

    //       $data22 = array(
    //     'confirmation_code' => $confirmation_code,
    //     'name'= $request->name;
    //     //'code'=>$confirmation_code,
    //     'email'= $request->email;
    //     'password'= $request->password;
    // );
         

    //     Mail::send('email.email', $data22, function($message) {
    //      //dd($this->user->name);    
    //     $message->to($this->user->email, $this->user->name)
    //             ->subject('تطبيق المحامي محمد جميل')
    //     ->replyTo('a@gmail.com', $name = null)
    //     ->from('a@gmail.com', 'a@gmail.com');
                
    //     });
    //      $email =$this->user->email;
    //      $username =$this->user->name;
    //      $user_id =$this->user->id;
        
         return redirect()->back()->with('status', __('common.update'));
    }

}

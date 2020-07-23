<?php

namespace App\Http\Controllers\Site;

use App\Models\City;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Review;
use App\Models\Language;
use App\User;
use DB;
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
use Auth;



class UserController extends Controller
{
    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf');

    }


    public function __construct()
    {
        //$this->middleware('auth');
        view()->share([
            'locales' => Language::all(),
            'setting' => Setting::query()->first(),
            // 'lands' => Land::query()->where('status','active')->get(),
            // 'companies' => Company::query()->where('status','active')->get(),
        ]);

    }

//    public function showProfile($id){
//        $user=User::where('id',$id)->first();
//        return view('website.profile',['user'=>$user]);
//    }

    public function showProfile(){
        $user=User::where('id',Auth::user()->id)->first();
       // $orders =Order::where('user_id', Auth::user()->id)->get();
        $orders =Order::with('products')->where('user_id', Auth::user()->id)->get();
        $reviews=\DB::table("reviews")->where('user_id', Auth::user()->id)->get();


        return view('website.profile',
            [   'user'=>$user,
                'orders'=>$orders,
                'reviews'=>$reviews,
                ]);
    }

    public function addRate(Request $request){

        $review = new Review;
        $reviews_count  =Review::where('product_id',$request->product_id)
            ->where('user_id',Auth::user()->id)->count();

        if($reviews_count>0){

            return ['status'=>'error'];
        }
        else{
            $review->storeReviewForProduct($request->product_id, $request->comment, $request->rating);
            return ['status'=>'done'];
        }


    }

    public function showLoginForm(){
        return view('website.sign_in');
    }

    public function showEditProfileForm(){
        $user=User::where('id',Auth::user()->id)->first();
        return view('website.edit_profile',[
            'user' => $user,
        ]);
    }

    public function register(){
        return view('website.sign_up');
    }
    public function forgetPassword(){
        return view('website.forget_password');
    }
    public function changePassword(){
        return view('website.changePassword');
    }

    public function showResetForm(Request $request, $token = null)
    {
        //  return $token;
        return view('website.verifyed_password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input('email')]);

        if (Auth::guard('web')->attempt($request->only($field, 'password')))
        {
            return redirect('/');
        }

        return redirect('/login')->withErrors([
            'error' => 'These credentials do not match our records.',
        ])->withInput($request->only('email','remember'));
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/login');
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'mobile'=>'required|min:10|max:14|unique:users',
            'address'=>'required',
            'password'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $fileName = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
            $password = $request->get('password');
            if (!empty($password)) {
                $password = bcrypt($password);
            }
            $validatorImage = Validator::make($request->all(), [
                'profile_image' => 'mimes:jpeg,bmp,png,gif',
            ]);
            if ($validatorImage->fails()) {
                return redirect()->back()->withErrors($validatorImage)->withInput();
            }
                $newUser = new User();
                $newUser->email = $request->email;
                $newUser->name = $request->name;
                $newUser->password = $password;
                $newUser->mobile = $request->mobile;
                $newUser->address = $request->address;
                $newUser->status=1;
                if ($request->hasFile('profile_image')) {
                    $profile_image = $request->file('profile_image');
                    Image::make($profile_image)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/users/$fileName");
                    $newUser->profile_image=$fileName;
                }
                $add=$newUser->save();

                if($add){
                    //Auth::guard()->login($newUser);
                    return redirect('/');
                }
                return redirect()->back()->with('msg', __('website.input_error'))->withInput();
            }

    



    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,id,'.Auth::user()->id,
            'mobile'=>'required|min:10|max:14|unique:users,id,'.Auth::user()->id,
            'address'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user= User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;

        if ($request->hasFile('avatar')) {
            $logo = $request->file('avatar');
            $extention = $logo->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($logo)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/users/".$file_name);
            $user->avatar = $file_name;
        }
        $user->save();

        return redirect()->back()->with('status', __('common.update'));


    }

    function changePasswordPost(Request $request){
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail(Auth::user()->id);
        if (!Hash::check($request->get('old_password'), $user->password)) {
            return redirect()->back()->with('error', __('api.old_password'))->withInput();
        }

        $user->password = bcrypt($request->get('password'));
        if ($user->save()) {
            $user->refresh();
            $message = __('api.ok');
            return redirect()->back()->with('success', __('api.ok'));
        }
        $message = __('api.whoops');
        return redirect()->back()->with('errorMsg', __('api.whoops'))->withInput();


    }


}

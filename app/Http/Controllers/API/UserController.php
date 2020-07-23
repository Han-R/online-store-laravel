<?php

namespace App\Http\Controllers\API;

use App\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'mobile' => 'required|min:6|max:15|unique:users,mobile,',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails())
        {
            return mainResponse(false, '', [], $validator);
        }
        User::query()->create([
            'name' => $request->get('name'),
            'gender' => $request->get('gender'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
        ]);
        return $this->login($request);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails())
        {
            return mainResponse(false, '', [], $validator);
        }
        $user = User::query()->where('email', $request->get('email'))->first();
        if (!$user)
        {
            return mainResponse(false, 'api.wrong_email_password', [],[]);
        }
        if($user->status == 'active')
        {
            if (Hash::check($request->get('password'), $user->password))
            {
                $c = $user->toArray();
                $c['access_token'] = 'Bearer ' . $user->createToken('access_token')->accessToken;
                return mainResponse(true, 'api.ok', $c,[]);
            }
            return mainResponse(false, 'api.wrong_password', [], []);
        }
        else
        {
            return mainResponse(false, 'api.banned_account', [],[]);
        }
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required |min:6 ',
            'cpassword' => 'required | same:password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return mainResponse(false, '', [], $validator);
        }
        $user = auth('api')->user();
        if (!Hash::check($request->get('old_password'), $user->password))
        {
            return mainResponse(true, 'api.old_password',[],[]);
        }

        $user->password = bcrypt($request->get('password'));
        if ($user->save())
        {
            return mainResponse(true, 'api.ok',[],[]);
        }
        $tmp = ["fieldname" => 'password', "message" => __('api.whoops')];
        return mainResponse(false, 'api.whoops', [], $tmp,1);
    }

    public function logOut()
    {
        auth('api')->user()->token()->revoke();
        return mainResponse(true, 'api.logout', [],[]);
    }

    public function editUser(Request $request)
    {
        $user = Auth::user();
        $validator1 = Validator::make($request->all(), [
            'email' => 'email|unique:users,email,' . $user->id,
        ]);

        $validator2 = Validator::make($request->all(), [
            'mobile' => 'min:6|max:15|unique:users,mobile,' .$user->id,
        ]);

        if ($validator1->fails())
        {
            return mainResponse(false, 'api.wrong_email',[],[]);
        }
        elseif ($validator2->fails())
        {
            return mainResponse(false, 'api.wrong_mobile', [],[]);
        }

        $newUser = User::query()->where('id', $user->id)->first();
        if ($request->hasFile('image'))
        {
            $image = $request->file('image')->store('uploads/images/users');
            $newUser->image = $image;
        }
        $email = ($request->has('email')) ? $request->get('email') : $user->email;
        $name = ($request->has('name')) ? $request->get('name') : $user->name;
        $mobile = ($request->has('mobile')) ? $request->get('mobile') : $user->mobile;
        $latitude = ($request->has('latitude')) ? $request->get('latitude') : $user->latitude;
        $longitude = ($request->has('longitude')) ? $request->get('longitude') : $user->longitude;
        $newUser->email = $email;
        $newUser->name = $name;
        $newUser->mobile = $mobile;
        $newUser->latitude = $latitude;
        $newUser->longitude = $longitude;
        $done = $newUser->save();
        if ($done)
        {
            return mainResponse(true, 'api.ok', $newUser,[]);
        }
        else
        {
            $tmp = ["fieldname" => 'email', "message" => __('api.whoops')];
            return mainResponse(false, 'api.whoops',[] ,$tmp,1);
        }
    }
}
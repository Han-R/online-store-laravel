<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Session;
use App;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getResetToken(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $user = User::query()->where('email', $request->input('email'))->firstOrFail();
        if($user){
            $token = $this->broker()->createToken($user);
            //$url = url($token);
            //$user->notify(new ResetPassword($url));
            $user->notify(new ResetPassword($token));

            return redirect(route("home"));
        }
        else{
            
            return redirect(route("forget_password_user"));
        }

        $message_ar = 'تم إرسال رابط تعيين كلمة المرور للبريد الإلكتروني المدخل';
        $message_en = 'Reset password link have been sent to your email address';
        if ($request->wantsJson()) {
            //if ($user->notify(new ResetPassword($url))) {
            return mainResponse(true, __('api.reset_password'), null, null);
//            }
//            $message_ar = 'حدث خطأ، لم يتم إرسال رابط تعيين كلمة المرور';
//            $message_en = 'Error, Reset password link have Not been sent. Please try again later';
//            return $this->constant->mainResponse(false, $message_ar, $message_en, null, 202);
            //return response()->json(['token' => $token]);
        }
    }
}
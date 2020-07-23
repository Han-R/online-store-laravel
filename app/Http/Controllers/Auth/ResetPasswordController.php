<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\PasswordReset;
use App\User;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {

//        $this->validate($request, $this->rules(), $this->validationErrorMessages());
//        $response = $this->broker()->reset(
//            $this->credentials($request), function ($user, $password) {
//            $this->resetPassword($user, $password);
//
//        }
//        );
//
//        if ($response == Password::PASSWORD_RESET) {
//            auth()->logout();
//            return redirect()->back()->with('status', 'تم اعادة تعيين كلمة المرور بنجاح، قم بإعادة تسجيل الدخول من التطبيق');
//        } else {
//            auth()->logout();
//            return redirect()->back()->withErrors(['errors' => trans($response)]);
//        }

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset){
            return redirect(route("forget_password_user"));
        }
//            return response()->json([
//                'message' => 'This password reset token is invalid.'
//            ], 404);

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user){
                        return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        }
//            return response()->json([
//                'message' => 'We cant find a user with that e-mail address.'
//            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        //$user->notify(new PasswordResetSuccess($passwordReset));
        //return response()->json($user);
        return redirect(route("userLogin"));
        
        
    }
}

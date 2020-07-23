<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	
	<title>{{__('website.password_verification')}}</title>
	
	<link href="{{asset('website/css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/all.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('website/css/owl.theme.default.min.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('website/css/responsive.css')}}" rel="stylesheet">
	
	
	<script src="{{asset('website/js/jquery-1.12.2.min.js')}}"></script>
</head>
<body>

    <!--Start verifyed password-->
    
        <section class="section_body_site" id="signUp">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="box_sign">
                            <div class="row">
                                <div id="left-side" class="col-sm-6">
                                    <div class="sign_right">
                                        <div class="content_bg_sign">

                                            <div id="information" v-show="left" class="information">
                                              <img src="{{asset('website/images/forget.png')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="right-side-login" class="col-sm-6">
                                    <div class="sign_left">
                                         <div class="sign_head">
                                             <div class="lock">
                                                <div class="iconLock">
                                                    <img src="{{asset('website/images/laptop.svg')}}" class="imglock">
                                                </div>
                                                <div class="forget">
                                                  <img src="{{asset('website/images/message.svg')}}" class="imgMess">
                                                </div>
                                            </div>
                                             
                                            <p class="enterEmail">{{__('website.reset_password')}}</p>
                                             <form class="form-horizontal" method="POST" action="{{url(getLocal().'/password/reset')}}">

                                                 {{ csrf_field() }}

                                                 <input type="hidden" name="token" value="{{ $token }}">

                                                 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                     <label for="email" class="col-md-4 control-label">{{__('website.email')}}</label>

                                                     <div class="col-md-6">
                                                         <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                                         @if ($errors->has('email'))
                                                             <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                         @endif
                                                     </div>
                                                 </div>

                                                 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                     <label for="password" class="col-md-4 control-label"> {{__('common.password')}}</label>

                                                     <div class="col-md-6">
                                                         <input id="password" type="password" class="form-control" name="password" required>

                                                         @if ($errors->has('password'))
                                                             <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                         @endif
                                                     </div>
                                                 </div>

                                                 <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                     <label for="password-confirm" class="col-md-4 control-label">{{__('common.confirm_password')}}</label>
                                                     <div class="col-md-6">
                                                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                                         @if ($errors->has('password_confirmation'))
                                                             <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                                         @endif
                                                     </div>
                                                 </div>

                                                 <div class="form-group">
                                                     <div>
                                                         <button type="submit" class="resetPass">
                                                             {{__('website.reset_password')}}
                                                         </button>
                                                     </div>
                                                 </div>
                                             </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <!--End verifyed password-->
    
	<script src="{{asset('website/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('website/js/script.js')}}"></script>

</body>
</html>	
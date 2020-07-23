<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	
	<title>{{__('website.forgotPassword')}}</title>
	
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

    
    <!--Start forget password-->
    
        <section class="section_body_site">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="box_sign">
                        <div class="row">
                            <div id="left-side" class="col-sm-6">
                            <div class="sign_right">

                                <div class="sign_head">
                                    <div class="lock">
                                        <div class="iconLock">
                                            <i class="ti-lock"></i>
                                        </div>
                                        <div class="forget">
                                          <i class="fas fa-question"></i>
                                        </div>
                                    </div>
                                        <h3 class="forgetPassword">{{__('website.forgotPassword')}}</h3>
                                        <p class="addEmail">{{__('website.forgotPasswordText')}}</p>
                                        <form id="form_st1" class="form_st1" method="POST" action="{{url(getLocal().'/password/email')}}" novalidate="novalidate">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="input_pass">
                                                    <input required="" value="{{ old('email') }}" name="email" type="email" class="form-control" placeholder="{{__('website.enter_email')}}" id="email" aria-required="true">
                                                </div>
                                            </div>
                                            <button id="send_email" type="submit" class="resetPass">{{__('website.reset_password')}}</button>
                                        </form>
                                </div>


                            </div>
                            </div>

                            <div id="right-side-login" class="col-sm-6">
                                <div class="sign_left">
                                     <div class="content_bg_sign">

                                    <div id="information" v-show="left" class="information">
                                      <img src="{{asset('website/images/forget.png')}}">
                                    </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



            </div>
            </div>
    
        </div>
    </section>
    
    <!--End forget password-->
    
	<script src="{{asset('website/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('website/js/script.js')}}"></script>
</body>
</html>	
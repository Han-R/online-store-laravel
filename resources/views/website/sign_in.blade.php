<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	
	<title>{{__('website.login')}}</title>
	
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

    
    <!--Start Sign In-->
    
        <section class="section_body_site">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="box_sign">
                        <div class="row">
                            <div id="left-side" class="col-sm-6">
                            <div class="sign_right">

                                <div class="sign_head">
                                        <h2>{{__('website.welcom back!')}}</h2>
                                        <p>{{__('website.Signintoyouraccount')}}</p>
                                        <form id="form_st1" method="post" action="{{url(getLocal().'/login')}}" novalidate="novalidate">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input required="" name="email" type="text" class="form-control" placeholder="{{__('website.email')}}" aria-required="true">
                                            </div>
                                            <div class="form-group">
                                                <div class="input_pass">
                                                    <input required="" name="password" type="password" class="form-control" placeholder="{{__('website.password')}}" id="password_login" aria-required="true">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn_submit_red">{{__('website.login')}}</button>
                                        </form>
                                           <a href="{{url(getLocal().'/forgotPassword')}}" class="forgetPass">{{__('website.forgotYourPassword')}}</a>

                                </div>


                            </div>
                            </div>

                            <div id="right-side-login" class="col-sm-6">
                                <div class="sign_left">
                                     <div class="content_bg_sign">

                                    <div id="information" v-show="left" class="information">
                                        <h2>{{__('website.signup')}}</h2>
                                       <a href="{{url(getLocal().'/register')}}">{{__('website.createNewAccount')}}<i class="fas fa-arrow-right"></i></a>
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
    
    <!--End Sign In-->
    
	<script src="{{asset('website/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('website/js/script.js')}}"></script>

</body>
</html>	
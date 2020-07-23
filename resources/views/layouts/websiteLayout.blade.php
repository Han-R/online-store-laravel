<!DOCTYPE html>
    @if(app()->getLocale() == "ar")
         <html lang="ar">
    @else
    @endif
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <link href="{{asset('website/css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/themify-icons.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/all.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/material-design-iconic-font.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/simple-line-icons.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/owl.theme.default.min.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('website/css/responsive.css')}}" rel="stylesheet">


        <script src="{{asset('website/js/jquery-1.12.2.min.js')}}"></script>

        @yield('head')
    </head>
    <body>

    <!--Start Mobile-menu-->

    <div class="mobile-menu">
        <div class="menu-mobile">
            <div class="brand-area">
                <a href="">
                    <img src="{{asset('website/images/logo.svg')}}" alt="logo" class="img-responsive">
                </a>
            </div>
            <div class="mmenu">
                <ul>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All</a>
                        <div class="dropdown-menu dropdown-menu_st3">
                            <div class="drop_button">
                                <a href="#">Electronic</a>
                                <a href="#">Electronic</a>
                                <a href="#">Electronic</a>
                            </div>
                        </div>
                    </li>
                    <li><a href="electronic.html">Electronic</a></li>
                    <li><a href="fashion.html">Fashion</a></li>
                    <li><a href="homeKitchen.html">Home & Kitchen</a></li>
                    <li><a href="beautyFragrance.html">Beauty & Fragrance</a></li>
                    <li><a href="babyKids.html">Baby & Kids</a></li>
                </ul>
            </div>
        </div>
        <div class="m-overlay"></div>
    </div>

    <!--End Mobile-menu-->



    <div class="main-wrapper">

        <!--Start header-->

        <header id="header">
            <div class="header-top">
                <div class="container">
                    <ul class="topHmenu-left clearfix">
                        <li><a href="{{url(getLocal().'/contact-us')}}"><i class="zmdi zmdi-email" aria-hidden="true"></i>{{$setting->email}}</a></li>
                        <li><i class="zmdi zmdi-smartphone" aria-hidden="true"></i>{{$setting->mobile}}</li>
                    </ul>
                    @if(Auth::check())
                         <ul class="topHmenu-right clearfix">
                        <li>
                            <a href="{{url(getLocal().'/profile')}}"><i class="ti-user"></i></a>
                        </li>
                        <li>
                            <a href="{{route('userLogout')}}"><i class="icon-login"></i>{{__('website.logout')}}</a>
                        </li>
                        <li>
                            @if(app()->getLocale() == 'en')
                                <?php
                                $lang = LaravelLocalization::getSupportedLocales()['ar']
                                ?>
                                <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="">
                                    <i class="icon-globe"></i>{{ $lang['native'] }}
                                </a>
                            @else
                                <?php
                                $lang = LaravelLocalization::getSupportedLocales()['en']
                                ?>
                                <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="">
                                    <i class="icon-globe"></i>{{ $lang['native'] }}
                                </a>
                            @endif
                        </li>
                    </ul>
                    @else
                        <ul class="topHmenu-right clearfix">
                            <li>
                                <a href="{{url(getLocal().'/register')}}"><i class="icon-user-follow"></i>{{__('website.signup')}}</a>
                            </li>
                            <li>
                                <a href="{{route('userLogin')}}"><i class="icon-login"></i>{{__('website.login')}}</a>
                            </li>
                            <li>
                                @if(app()->getLocale() == 'en')
                                    <?php
                                    $lang = LaravelLocalization::getSupportedLocales()['ar']
                                    ?>
                                    <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="">
                                        <i class="icon-globe"></i>{{ $lang['native'] }}
                                    </a>
                                @else
                                    <?php
                                    $lang = LaravelLocalization::getSupportedLocales()['en']
                                    ?>
                                    <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="">
                                        <i class="icon-globe"></i>{{ $lang['native'] }}
                                    </a>
                                @endif
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <a href="{{route('home')}}" class="logo-site"><img src="{{asset('website/images/logo.svg')}}" alt="logo" class="img-responsive"></a>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <form class="form-search-head" action="{{route('submitSearch')}}">
                                {{csrf_field()}}
                                <input type="text" name="search" class="form-controlSearch" placeholder="{{__('website.search')}}">
                                <button type="submit" class="btn btn-submit-search"><i class="icon-magnifier icons" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="clearfix">
                                <ul class="menu-purches clearfix">
                                    <li class="favorite-btn">
                                        <a href="{{route('showWishlist')}}"><i class="icon-heart"></i><span id="showWishlist">{{$wishlist}}</span></a>
                                    </li>
                                    <li class="cart-purches-btn">
                                        <a href="{{route('showCart')}}"><i class="icon-basket"></i><span id="showCart">{{$cart}}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="hbLeft">
                        <ul class="main_menu clearfix">
                            <li class="dropdown mega-dropdown">
                                <a href="{{route('home')}}"  role="button" aria-haspopup="true" aria-expanded="false">{{__('website.home')}}</a>
                            </li>
                            @foreach($departments as $department)
                                @if($department->categories->count()>0)
                                    <li class="dropdown mega-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$department->name}}</a>
                                        <ul class="dropdown-menu mega-dropdown-menu">
                                            @foreach($department->categories as $category)
                                                @if($category->subCategories->count()>0)
                                                    <li class="col-sm-3">
                                                        <ul>
                                                            <li class="dropdown-header"><a href="{{url(getLocal().'/page/'.$category->id)}}">{{$category->name}}</a></li>
                                                            @foreach($category->subCategories as $subCategory)
                                                                <li><a href="{{url(getLocal().'/products/'.$subCategory->id)}}">{{$subCategory->name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="hbRight">
                        <div class="offers">
                            <a href="{{url(getLocal().'/offers')}}">{{__('website.offers')}}</a>
                        </div>
                        <button type="button" class="hamburger is-closed">
                            <span class="hamb-top"></span>
                            <span class="hamb-middle"></span>
                            <span class="hamb-bottom"></span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!--End header-->


    @yield('body')


    <!--Start Footer-->

        <footer id="footer">
            <div class="topFooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="footerRight">
                                <div class="imgFotter">
                                    <img src="{{asset('website/images/imgFooter.png')}}" />
                                </div>
                                <h3>{{__('website.We’reAlwaysHereToHelp')}}</h3>
                                <span>{{__('website.Reachouttousthroughanyofthesesupportchannels')}}</span>
                                <a href="{{url(getLocal().'/contact-us')}}" class="btnContact">{{__('website.contact')}}</a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="f-box">
                                <ul class="footerContact">
                                    <li class="li_phone">
                                        <i class="ti-email"></i>
                                        <p>{{$setting->email}}</p>
                                    </li>
                                    <li class="li_email">
                                        <i class="ti-mobile"></i>
                                        <p>{{$setting->mobile}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="footerSocial">
                                <div class="iconSocial">
                                    <a href="{{$setting->facebook}}"><i class="ti-facebook"></i></a>
                                    <a href="{{$setting->twitter}}"> <i class="ti-twitter"></i></a>
                                    <a href="{{$setting->instagram}}"><i class="ti-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottomFooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-xs-4 col-sm-4">
                            <p class="text-left copyright">
                                © {{date("Y")}} {{__('website.b1Store.AllRightsReserved.')}}
                            </p>
                        </div>
                        <div class="col-md-4 col-xs-4 col-sm-4">
                            <div class="infoFooter">
                                <a href="{{url(getLocal().'/about-us')}}" class="aboutfooter">{{__('website.about_us')}}</a>
                                <a href="{{url(getLocal().'/terms-of-use')}}" class="aboutfooter">{{__('website.terms')}}</a>
                                <a href="{{url(getLocal().'/privacy-policy')}}" class="aboutfooter">{{__('website.privacy')}}</a>
                            </div>

                        </div>
                        <div class="col-md-4 col-xs-4 col-sm-4">
                            <p class="text-left power">
                                {{__('website.PowerBy')}} <a target="_blank" href="http://hexacit.com/"><img src="{{asset('website/images/powerbyhexa.png')}}" /></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!--End Footer-->


        <!--Modals-->

        <div class="modal fade" id="modalsearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-person" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">search</h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-details">
                            <input type="search" placeholder="Search Now.." class="input-search">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!--main-wrapper-->


    <script src="{{asset('website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('website/js/script.js')}}"></script>

    @yield('script')



    </body>
    </html>
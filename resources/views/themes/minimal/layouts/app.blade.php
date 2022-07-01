<!DOCTYPE html >
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    @include('partials.seo')

    {{--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&family=Poppins:wght@500;600;700&display=swap">--}}
    {{--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/magnific-popup.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    {{--@stack('extra-style')--}}
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/flaticon.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/aos.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/odometer.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/default.css')}}"/>
    {{--@if(session()->get('rtl') == 1)--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/style_ar.css')}}"/>--}}
    {{--@else--}}
        <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/style.css')}}"/>
    {{--@endif--}}
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/style.scss')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/vin/responsive.css')}}"/>

    {{--<link rel="stylesheet" href="{{asset($themeTrue.'css/color.php')}}?primaryColor={{config('color.primaryColor')}}&subheading={{config('color.subheading')}}&bggrdleft={{config('color.bggrdleft')}}&bggrdright={{config('color.bggrdright')}}&bggrdleft2={{config('color.bggrdleft2')}}&btngrdleft={{config('color.btngrdleft')}}&copyrights={{config('color.copyrights')}}">--}}

    {{--@stack('style')--}}

    <script src="{{asset('assets/global/js/modernizr.custom.js')}}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Scroll-top -->
<button class="scroll-top scroll-to-target" data-target="html">
    <i class="fas fa-angle-up"></i>
</button>
<!-- Scroll-top-end-->
<header class="header-bg">
    <div class="header-top-wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-top-social">
                        <ul>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-vimeo-v"></i></a></li>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="header-top-login">
                        <ul>
                            @guest
                                <li><a href="{{route('register')}}"><i class="far fa-edit"></i>@lang('Sign up')</a></li>
                                <li class="or">@lang('OR')</li>
                                <li><a href="{{route('login')}}"><i class="far fa-edit"></i>@lang('Login')</a></li>
{{--                                <li class="or">@lang('OR')</li>--}}
{{--                                <li><a href="{{route('registerAsAgent')}}"><i class="far fa-edit"></i>@lang('Sign up As Agent')</a></li>--}}
                            @endguest
                            @auth
                                <li class="nav-item mr-5">
                                    <a class="{{menuActive('user.home')}} nav-link"
                                       href="{{route('user.home')}}"><i
                                                class="far fa-edit"></i><span>@lang('Dashboard')</span></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                                class="far fa-edit"></i><span>@lang('Logout')</span></a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-header" class="main-header menu-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="menu-wrap">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <nav class="menu-nav show" style="@if(session()->get('rtl') == 1) justify-content: end; @endif">
                            <div class="logo"><a href="{{route('home')}}"><img
                                            src="{{ getFile(config('location.logoIcon.path').'logo.png')}}"
                                            alt="SYRIA MARKET"></a></div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li class="@if(Request::is('/')) active @endif"
                                     ><a href="{{route('home')}}">@lang('Home')</a></li>
                                    <li class="@if(Request::is('shop')) active @endif"  class="dropdown">
                                        <a href="{{route('shop')}}">@lang('Shop')</a>
                                    </li>
                                    <li class="@if(Request::is('about')) active @endif" class="dropdown">
                                        <a href="{{route('about')}}">@lang('About')</a>
                                    </li>
                                    <!-- <li><a href="{{route('contact')}}">@lang('Contact')</a></li> -->
                                    <li class="@if(Request::is('blog')) active @endif"><a href="{{route('blog')}}">@lang('Guide')</a></li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    <li class="header-shop-cart"><a href="#"><i class="fa fa-globe"></i></a>
                                        <ul class="minicart">
                                            @foreach(getLanguges() as $language)
                                                <li class="d-flex align-items-start">
                                                    <a class="nav-link"
                                                       href="{{route('language',[$language->short_name])}}">{{$language->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <ul class="minicart">
                                            <li class="d-flex align-items-start">
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header-search"><a style="display: grid;place-content: center;" href="#" data-toggle="modal"
                                                                 data-target="#search-modal"><i
                                                    class="fas fa-search"></i></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- Modal Search -->
                    <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form>
                                    <input type="text" placeholder="Search here...">
                                    <button><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Search-End -->
                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <div class="menu-backdrop"></div>
                        <div class="close-btn"><i class="fas fa-times"></i></div>

                        <nav class="menu-box">
                            <div class="nav-logo"><a href="{{route('home')}}"><img src="{{ getFile(config('location.logoIcon.path').'logo.png')}}"
                                                                            alt="" title=""></a>
                            </div>
                            <div class="menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->

                            </div>
                            <div class="social-links">
                                @foreach(getLanguges() as $language)
                                    <li class="clearfix">
                                        <a
                                           href="{{route('language',[$language->short_name])}}">{{$language->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>

</header>


{{--<!-- HERO -->--}}
{{--<header id="hero">--}}
{{--<nav id="navbar">--}}
{{--<div class="container-fluid px-md-5">--}}
{{--<div class="navbar navbar-expand-lg mx-lg-5">--}}

{{--<a class="navbar-brand" href="{{route('home')}}">--}}
{{--<img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="Logo">--}}
{{--</a>--}}

{{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smmnavbar">--}}
{{--<div class="menu-icon">--}}
{{--<span></span>--}}
{{--<span></span>--}}
{{--<span></span>--}}
{{--</div>--}}
{{--</button>--}}
{{--<div class="collapse navbar-collapse" id="smmnavbar">--}}
{{--<ul class="navbar-nav">--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{menuActive('home')}}" href="{{route('home')}}">@lang('Home')</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{menuActive('about')}}" href="{{route('about')}}">@lang('About Us')</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{menuActive('services')}}" href="{{route('services')}}">@lang('Services')</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{menuActive('blog')}}" href="{{route('blog')}}">@lang('Blog')</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{menuActive('contact')}}" href="{{route('contact')}}">@lang('Contact')</a>--}}
{{--</li>--}}
{{--</ul>--}}

{{--<ul class="navbar-nav nav-registration">--}}
{{--@guest--}}
{{--<li class="nav-item mr-5">--}}
{{--<a class="{{menuActive('login')}} nav-link"--}}
{{--href="{{route('login')}}"><span>@lang('Login')</span></a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="{{menuActive('register')}} nav-link active"--}}
{{--href="{{route('register')}}"><span>@lang('Sign up')</span></a>--}}
{{--</li>--}}
{{--@endguest--}}
{{--@auth--}}
{{--<li class="nav-item mr-5">--}}
{{--<a class="{{menuActive('user.home')}} nav-link"--}}
{{--href="{{route('user.home')}}"><span>@lang('Dashboard')</span></a>--}}
{{--</li>--}}

{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{ route('logout') }}"--}}
{{--onclick="event.preventDefault();--}}
{{--document.getElementById('logout-form').submit();"><span>@lang('Logout')</span></a>--}}

{{--<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--@csrf--}}
{{--</form>--}}
{{--</li>--}}
{{--@endauth--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</nav>--}}


{{--@if(\Request::routeIs('home'))--}}
{{--@stack('banner')--}}
{{--@else--}}
{{--@include($theme.'partials.banner')--}}
{{--@endif--}}
{{--</header>--}}
{{--<!-- /HERO -->--}}

@yield('content')


@stack('extra-content')


@include($theme.'partials.footer')


{{--<script src="{{asset('assets/global/js/jquery.min.js') }}"></script>--}}
{{--<script src="{{asset('assets/global/js/jquery-ui.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/global/js/popper-1.12.9.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/global/js/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/global/js/fontawesome.min.js')}}"></script>--}}
{{--@stack('extra-js')--}}
{{--<script src="{{asset('assets/global/js/wow.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/global/js/owl.carousel.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/global/js/multi-animated-counter.js')}}"></script>--}}
{{--<script data-cfasync="false" src="https://cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/vendor/jquery-3.5.0.min.js"></script>--}}
<script src="{{asset($themeTrue.'js/pages/popper.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/bootstrap.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/aos.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/isotope.pkgd.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/owl.carousel.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/jquery.odometer.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/jquery.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/jquery.appear.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/slick.min.js')}}"></script>
    @if(session()->get('rtl') == 1)
    <script src="{{asset($themeTrue.'js/pages/slick.min2.js')}}"></script>
    @else
    <script src="{{asset($themeTrue.'js/pages/slick.min.js')}}"></script>
    @endif
<script src="{{asset($themeTrue.'js/pages/ajax-form.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/wow.min.js')}}"></script>
<script src="{{asset($themeTrue.'js/pages/plugins.js')}}"></script>
<script src="{{asset($themeTrue.'js/main.js')}}"></script>
@stack('script')
@if (session()->has('success'))
    <script>
        Notiflix.Notify.Success("@lang(session('success'))");
    </script>
@endif

@if (session()->has('error'))
    <script>
        Notiflix.Notify.Failure("@lang(session('error'))");
    </script>
@endif

@if (session()->has('warning'))
    <script>
        Notiflix.Notify.Warning("@lang(session('warning'))");
    </script>
@endif
</body>
</html>

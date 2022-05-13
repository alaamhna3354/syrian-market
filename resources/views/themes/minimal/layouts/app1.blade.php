<!DOCTYPE html >
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
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

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&family=Poppins:wght@500;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/jquery-ui.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/all.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/icofont.min.css')}}"/>
    @stack('extra-style')
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/animate.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/owl.theme.default.min.css')}}"/>

    <link rel="stylesheet" href="{{asset($themeTrue.'css/color.php')}}?primaryColor={{config('color.primaryColor')}}&subheading={{config('color.subheading')}}&bggrdleft={{config('color.bggrdleft')}}&bggrdright={{config('color.bggrdright')}}&bggrdleft2={{config('color.bggrdleft2')}}&btngrdleft={{config('color.btngrdleft')}}&copyrights={{config('color.copyrights')}}">

    @stack('style')

    <script src="{{asset('assets/global/js/modernizr.custom.js')}}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- HERO -->
<header id="hero">
    <nav id="navbar">
        <div class="container-fluid px-md-5">
            <div class="navbar navbar-expand-lg mx-lg-5">

                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="Logo">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smmnavbar">
                    <div class="menu-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="smmnavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('home')}}" href="{{route('home')}}">@lang('Home')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('about')}}" href="{{route('about')}}">@lang('About Us')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('services')}}" href="{{route('services')}}">@lang('Services')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('blog')}}" href="{{route('blog')}}">@lang('Blog')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{menuActive('contact')}}" href="{{route('contact')}}">@lang('Contact')</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav nav-registration">
                        @guest
                            <li class="nav-item mr-5">
                                <a class="{{menuActive('login')}} nav-link"
                                   href="{{route('login')}}"><span>@lang('Login')</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="{{menuActive('register')}} nav-link active"
                                   href="{{route('register')}}"><span>@lang('Sign up')</span></a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item mr-5">
                                <a class="{{menuActive('user.home')}} nav-link"
                                   href="{{route('user.home')}}"><span>@lang('Dashboard')</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span>@lang('Logout')</span></a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    @if(\Request::routeIs('home'))
        @stack('banner')
    @else
        @include($theme.'partials.banner')
    @endif
</header>
<!-- /HERO -->

@yield('content')


@stack('extra-content')


@include($theme.'partials.footer')


<script src="{{asset('assets/global/js/jquery.min.js') }}"></script>
<script src="{{asset('assets/global/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/global/js/popper-1.12.9.min.js')}}"></script>
<script src="{{asset('assets/global/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/global/js/fontawesome.min.js')}}"></script>
@stack('extra-js')
<script src="{{asset('assets/global/js/wow.min.js')}}"></script>
<script src="{{asset('assets/global/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/multi-animated-counter.js')}}"></script>
<script src="{{asset($themeTrue.'js/script.js')}}"></script>

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

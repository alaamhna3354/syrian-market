     <style>
         #page-banner {
             margin-bottom: 75px;
             background-image:  linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url({{getFile(config('location.logo.path').'banner.jpg')}});
             background-position: top left;
             background-size: 100% 499px;
             background-repeat: no-repeat;
             background-color: #ffffff;
         }
     </style>
<!-- PAGE-BANNER -->
<section id="page-banner" class="login-signup-page">
    <div class="container">
        <div class="page-header">
            <h2 class="h2 mb-20">@yield('title')</h2>
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('login')}}">@yield('title')</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE-BANNER -->

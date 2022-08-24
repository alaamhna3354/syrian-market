<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@include('partials.seo')

@stack('style-lib')

    @if(session()->get('rtl') == 1)
        <link href="{{asset('assets/themes/user/css/style_ar.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('assets/themes/user/css/style.css')}}" rel="stylesheet">
    @endif

<link rel="stylesheet" href="{{asset('assets/themes/user/css/color.php')}}?primaryColor={{config('color.primaryColor')}}&subheading={{config('color.subheading')}}&bggrdleft={{config('color.bggrdleft')}}&bggrdright={{config('color.bggrdright')}}&bggrdleft2={{config('color.bggrdleft2')}}&btngrdleft={{config('color.btngrdleft')}}&copyrights={{config('color.copyrights')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stack('style')

@stack('extra-style')

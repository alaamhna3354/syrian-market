<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@include('partials.seo')

@stack('style-lib')
    @if(session()->get('rtl') == 1)
        <link href="{{asset('assets/themes/user/css/style.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('assets/themes/user/css/style_ar.css')}}" rel="stylesheet">
    @endif
<link rel="stylesheet" href="{{asset('assets/themes/user/css/color.php')}}?primaryColor={{config('color.primaryColor')}}&subheading={{config('color.subheading')}}&bggrdleft={{config('color.bggrdleft')}}&bggrdright={{config('color.bggrdright')}}&bggrdleft2={{config('color.bggrdleft2')}}&btngrdleft={{config('color.btngrdleft')}}&copyrights={{config('color.copyrights')}}">

@stack('style')

@stack('extra-style')

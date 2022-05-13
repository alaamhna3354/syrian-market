<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Success</title>
    <link href='//fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="{{asset($themeTrue.'css/fontawesome.min.css')}}"/>
    <link href="{{asset($themeTrue.'css/success-failed.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<header class="site-header" id="header">
    <h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
</header>

<div class="main-content">
    <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
    <p class="main-content__body" data-lead-id="main-content-body">Thanks a bunch for filling that out. It means a lot
        to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being
        with us.</p>
</div>

<footer class="site-footer" id="footer">
    <a href="{{ url('/') }}">Go back to Home</a>
    <p class="site-footer__fineprint" id="fineprint">Copyright ©{{ date('Y') }} | All Rights
        Reserved <a href="{{ url('/') }}" class="site_title">{{ $basic->site_title ?? 'Binary Operations' }}</a></p>
</footer>
</body>
</html>


<!-- FOOTER -->
<footer id="footer">
    <div class="copyright-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-sm-6 mb-4">
                    <div class="copyright-text">
                        <p>Copyright © 2022 <a href="#">Syria Market</a> All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-xl-3  col-md-6 d-none d-md-block mb-4">
                    <div class="payment-method-img text-right">
                        <img src="{{asset($themeTrue.'imgs/card_img.png')}}" alt="img">
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-6 d-flex justify-content-center mb-4">
                    <div class="header-top-social">
                        <ul>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-vimeo-v"></i></a></li>
                            <li><a style="display: grid;place-content: center;" href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-md-6 top-social ">
                    <div class="download">
                   <a href="" target="_blank"> 
                    <i class="fab fa-android"></i>
                       <span>
                       @lang('Download App')
                       </span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<figure class="footer-shape">--}}
        {{--<svg class="shape-fill" enable-background="new 0 0 1504 110" viewBox="0 0 1504 110"--}}
             {{--xmlns="http://www.w3.org/2000/svg">--}}
            {{--<path--}}
                {{--d="m877.8 85c139.5 24.4 348 33.5 632.2-48.2-.2 32.5-.3 65-.5 97.4-505.9 0-1011.6 0-1517.5 0 0-33.3 0-66.7 0-100.1 54.2-11.4 129.5-23.9 220-28.2 91-4.3 173.6 1 307.4 18.6 183.2 24.2 295.2 49.4 358.4 60.5z"></path>--}}
        {{--</svg>--}}
    {{--</figure>--}}

    {{--<div class="container">--}}
        {{--<div class="row pt-50">--}}
            {{--@if( isset($templates['contact-us'][0])  && $contactUs = $templates['contact-us'][0])--}}
            {{--<div class="col-lg-6">--}}
                {{--<div class="row footer-address">--}}
                    {{--<div class="col-lg-6">--}}
                        {{--<ul class="icofont-ul">--}}
                            {{--<li class="mb-15"><i class="icofont-iphone"></i> <span>@lang(@$contactUs->description->phone)</span></li>--}}
                            {{--<li><i class="icofont-envelope-open"></i> <span>@lang(@$contactUs->description->email)</span></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-6">--}}
                        {{--<div class="media">--}}
                            {{--<div class="media-icon">--}}
                                {{--<i class="icofont-google-map"></i>--}}
                            {{--</div>--}}
                            {{--<div class="media-body">--}}
                                {{--<p class="media-text">@lang(@$contactUs->description->address)</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@endif--}}

            {{--<div class="col-lg-6">--}}
                {{--<div class="subscribe" id="subscribe">--}}
                    {{--<form class="subscribe-form" action="{{route('subscribe')}}" method="post">--}}
                        {{--@csrf--}}
                        {{--<input class="form-control" name="email" type="email" placeholder="{{trans('Email Address')}}">--}}

                        {{--@error('email')--}}
                        {{--<span class="text-danger">{{$message}}</span>--}}
                        {{--@enderror--}}
                        {{--<button class="btn" type="submit">{{trans('Subscribe Now')}}</button>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<hr>--}}

        {{--<div class="row responsive-footer">--}}
            {{--<div class="col-md-6 col-lg-3">--}}
                {{--<div class="footer-brand">--}}
                    {{--<img src="{{getFile(config('location.logoIcon.path').'footer-logo.png')}}" alt="Image Missing">--}}
                    {{--<p>--}}
                        {{--@lang(@$contactUs->description->footer_short_details)--}}
                    {{--</p>--}}
                {{--</div>--}}

                {{--@if(isset($contentDetails['social']))--}}
                {{--<div class="footer-social">--}}
                    {{--@foreach($contentDetails['social'] as $data)--}}
                    {{--<a class="social-icon" target="_blank" href="{{@$data->content->contentMedia->description->link}}" title="{{$data->description->name}}"><i class="{{@$data->content->contentMedia->description->icon}}"></i></a>--}}
                    {{--@endforeach--}}
                {{--</div>--}}

                {{--@endif--}}
            {{--</div>--}}

            {{--<div class="col-md-6 col-lg-3">--}}
                {{--<div class="footer-links">--}}
                    {{--<h5>{{trans('Quick Links')}}</h5>--}}
                    {{--<ul class="nav flex-column mt-40">--}}
                        {{--<li class="nav-item mb-10">--}}
                            {{--<a class="nav-link" href="{{route('home')}}">@lang('Home')</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item mb-10">--}}
                            {{--<a class="nav-link" href="{{route('about')}}">@lang('About Us')</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item mb-10">--}}
                            {{--<a class="nav-link" href="{{route('blog')}}">@lang('Blog')</a>--}}
                        {{--</li>--}}

                        {{--<li class="nav-item mb-10">--}}
                            {{--<a class="nav-link" href="{{route('faq')}}">@lang('FAQ')</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="{{route('contact')}}">@lang('Contact')</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 col-lg-3">--}}
                {{--<div class="footer-links">--}}
                    {{--<h5>{{trans('Support')}}</h5>--}}
                    {{--<ul class="nav flex-column mt-40">--}}

                        {{--<li class="nav-item mb-10">--}}
                            {{--<a class="nav-link" href="{{route('apiDocs')}}">@lang('API DOCS')</a>--}}
                        {{--</li>--}}
                        {{--@isset($contentDetails['support'])--}}
                        {{--@foreach($contentDetails['support'] as $data)--}}
                            {{--<li class="nav-item mb-10">--}}
                                {{--<a class="nav-link" href="{{route('getLink', [slug($data->description->title), $data->content_id])}}">@lang($data->description->title)</a>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                            {{--@endisset--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-6 col-lg-3">--}}
                {{--<div class="footer-links">--}}
                    {{--<h5>@lang('Language')</h5>--}}
                    {{--<ul class="nav flex-column mt-40">--}}
                        {{--@foreach($languages as $language)--}}
                        {{--<li class="nav-item mb-10">--}}
                            {{--<a class="nav-link" href="{{route('language',[$language->short_name])}}">{{$language->name}}</a>--}}
                        {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="copy-rights">--}}
        {{--<div class="container">--}}
            {{--<p>{{trans('Copyright')}} &copy; {{date('Y')}} {{trans(config('basic.site_title'))}}. {{trans('All Rights Reserved')}}</p>--}}
        {{--</div>--}}
    {{--</div>--}}
</footer>
@push('js')
    <script>
    

    </script>
   
@endpush

<!-- /FOOTER -->

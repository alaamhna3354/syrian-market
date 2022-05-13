@if(isset($templates['hero'][0]) && $hero = $templates['hero'][0])
    <div id="hero-banner">
        <div class="shape-rectangle wow fadeIn">
            <div class="rectangle-lg"></div>
            <div class="rectangle-sm"></div>
        </div>
        <div class="hero-fig">
            <img class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s"
                 src="{{asset($themeTrue.'images/welcome_bg.jpg')}}" alt="First Layer">
            <div class="hero-fig-overlay wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
            </div>
            <div class="hero-fig-img wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.7s">
                <img src="{{getFile(config('location.content.path').@$hero->templateMedia()->image)}}" alt="Hero Img">
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="h1 wow fadeInUp" data-wow-duration="1s"
                            data-wow-delay="0.1s">@lang($hero->description->title)</h1>
                        <p class="p mt-30 mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                            @lang($hero->description->short_description)
                        </p>
                        <a class="btn btn-hero wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s"
                           href="{{@$hero->templateMedia()->button_link}}"> @lang($hero->description->button_name)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

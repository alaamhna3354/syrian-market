@if(isset($templates['call-to-action'][0]) && $callToAction = $templates['call-to-action'][0])

    <!-- BANNER-WRAP -->
    <section id="banner-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="content wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.35s">
                        <h3 class="h3">@lang(@$callToAction->description->title)</h3>
                        <p>@lang(@$callToAction->description->sub_title)</p>
                        <a class="btn" href="{{@$callToAction->templateMedia()->button_link}}">@lang(@$callToAction->description->button_name)</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="img-container wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
                        <img src="{{getFile(config('location.content.path').@$callToAction->templateMedia()->image)}}"
                             alt="Image Missing">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /BANNER-WRAP -->
    @push('style')
        <style>
            #banner-wrap {
                background-image: linear-gradient(109deg, var(--bggrdleft3) 0%, var(--bggrdright3) 100%), url({{getFile($themeTrue.'/images/customer_banner.jpg')}});
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
            }
        </style>
    @endpush


@endif

@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])

    <!-- ABOUT-US -->
    <section id="about-us">
        <div class="shape-circle wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
            <div class="circle"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="wrapper wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.35s">
                        <img class="img-br-6 img-w"
                             src="{{getFile(config('location.content.path').@$aboutUs->templateMedia()->image)}}"
                             alt="Image Missing">
                        <div class="youtube-wrapper">
                            <div class="btn-container">
                                <div class="btn-play grow-play">
                                    <i class="icofont-ui-play"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="text-wrapper wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
                        <h1 class="heading heading-left">@lang($aboutUs->description->title) <span
                                class="sub-heading">@lang($aboutUs->description->sub_title)</span></h1>
                        <div class="text-block">
                            <h3 class="h3 mb-30">@lang($aboutUs->description->short_title)</h3>
                            <p class="text">
                                @lang($aboutUs->description->short_description)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /ABOUT-US -->



    @push('extra-content')
        @if($aboutUs->templateMedia()->youtube_link)
            <!-- MODAL-VIDEO -->
            <div id="modal-video">
                <div class="modal-wrapper">
                    <div class="modal-content">
                        <div class="btn-close">&times;</div>
                        <div class="modal-container">
                            <iframe width="100%" height="100%" src="{{@$aboutUs->templateMedia()->youtube_link}}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /MODAL-VIDEO -->
        @endif
    @endpush

@endif

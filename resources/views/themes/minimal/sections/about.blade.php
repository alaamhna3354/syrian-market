@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])

    <!-- ABOUT-US -->
    <section id="about-us" data-background="{{asset($themeTrue.'imgs/shop_bg.jpg')}}">
        <!-- <div class="shape-circle wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
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
        </div> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-12 text-center">
                   <img class="logo" src="{{ getFile(config('location.logoIcon.path').'logo.png')}}" alt="">
                </div>
                <div class="col-lg-6 col-sm-12 col-12 gr-inf">
                    <h2>متجر سيريا ماركيت للبطاقات الرقمية</h2>
                    <h4>
                        <ul>
                            <li><i class="fas fa-check"></i><span>أفضل متجر لشراء البطاقات للألعاب</span></li>
                            <li><i class="fas fa-check"></i><span>جميع الألعاب والتحديثات</span></li>
                            <li><i class="fas fa-check"></i><span>قم بشحن جميع ألعابك بطريقة سريعة وسهلة</span></li>
                            <li><i class="fas fa-check"></i><span>ضمانة وجودة</span></li>
                        </ul>
                         
                        
                    </h4>
                </div>
                </div>
            </div>
        </div>
    </section>
<style>
#about-us{
    text-align: start;
    color:#fff;
    min-height:300px;
    padding: 20px;
}
#about-us .logo{
    max-width: 90%;
    margin-bottom:50px;
}
#about-us ul li{
    line-height: 2;
}
#about-us ul li i{
    margin-inline-end: 10px;
    color: #f1632c;
}
#about-us .gr-inf{
    display: grid;
    place-content: center;
}
@media (max-width:568px) {
#about-us{
    padding: 20px 10px;
}
h2{
  font-size: 20px;
}
h4{
  font-size: 16px;
}
}
</style>

<!-- 
    @push('extra-content')
        @if($aboutUs->templateMedia()->youtube_link)
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
        @endif
    @endpush -->

@endif

<section>
<!-- section-wrap -->
<div class="section-bg-wrap">
    <div class="section-bg-img"></div>

    <!-- slider-area -->
    <section class="slider-area">
        <div class="container">
            <div class="slider-active">
                <div class="single-slider slider-bg-1">
                    <div class="row justify-content-end">
                        <div class="col-xl-6 col-lg-7">
                            <div class="slider-content">
                                <h6 data-animation="fadeInUp" data-delay=".3s">CREATE AND <span>game</span></h6>
                                <h2 data-animation="fadeInUp" data-delay=".6s">online Matches</h2>
                                <p data-animation="fadeInUp" data-delay=".9s">Largest and most trusted top-up websites for games and online entertainment in Asia and beyond.</p>
                                <a href="uc-overview.html" class="btn" data-animation="fadeInUp" data-delay="1.2s">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-slider slider-bg-1">
                    <div class="row justify-content-end">
                        <div class="col-xl-6 col-lg-7">
                            <div class="slider-content">
                                <h6 data-animation="fadeInUp" data-delay=".3s">CREATE AND <span>game</span></h6>
                                <h2 data-animation="fadeInUp" data-delay=".6s">online Matches</h2>
                                <p data-animation="fadeInUp" data-delay=".9s">Largest and most trusted top-up websites for games and online entertainment in Asia and beyond.</p>
                                <a href="uc-overview.html" class="btn" data-animation="fadeInUp" data-delay="1.2s">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider-area-end -->

    {{--<!-- game-boost-area -->--}}
    {{--<section class="game-boost-area">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-12">--}}
                    {{--<div class="side-title mb-15">--}}
                        {{--<h3><i class="fas fa-play"></i>OTHER GAMES <span>BOOST</span></h3>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-12">--}}
                    {{--<div class="game-boost-wrap">--}}
                        {{--<div class="game-boost-item">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="flaticon-video-game"></i>--}}
                            {{--</div>--}}
                            {{--<div class="content">--}}
                                {{--<h4>ps4 slim</h4>--}}
                                {{--<span>generations of Xbox</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="game-boost-item">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="flaticon-nintendo-switch"></i>--}}
                            {{--</div>--}}
                            {{--<div class="content">--}}
                                {{--<h4>nintendo switch</h4>--}}
                                {{--<span>system plays library</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="game-boost-item">--}}
                            {{--<div class="icon">--}}
                                {{--<i class="flaticon-xbox"></i>--}}
                            {{--</div>--}}
                            {{--<div class="content">--}}
                                {{--<h4>xbox series</h4>--}}
                                {{--<span>generations of Xbox</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--<!-- game-boost-area-end -->--}}

    {{--<!-- offer-product-area -->--}}
    {{--<section class="offer-product-area pb-50">--}}
        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="col-lg-6 col-md-9">--}}
                    {{--<div class="offer-product-item mb-30">--}}
                        {{--<div class="offer-product-thumb" data-background="{{asset($themeTrue.'imgs/offer_product01.jpg')}}"></div>--}}
                        {{--<div class="offer-product-content">--}}
                            {{--<h6>limited <span>offer</span></h6>--}}
                            {{--<h3><a href="shop.html"><span>vr</span> Virtual pro</a></h3>--}}
                            {{--<p>VR headset transparent png Teddy Rawpixel.publisn graphic.</p>--}}
                            {{--<a href="shop.html" class="btn">Read more</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-6 col-md-9">--}}
                    {{--<div class="offer-product-item mb-30">--}}
                        {{--<div class="offer-product-thumb" data-background="{{asset($themeTrue.'/imgs/offer_product02.jpg')}}"></div>--}}
                        {{--<div class="offer-product-content">--}}
                            {{--<h6>limited <span>o5% off</span></h6>--}}
                            {{--<h3><a href="shop.html"><span>xbox</span> series pro</a></h3>--}}
                            {{--<p>VR headset transparent png Teddy Rawpixel.publisn graphic.</p>--}}
                            {{--<a href="shop.html" class="btn">Read more</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="offer-product-line"></div>--}}
        {{--<div class="offer-product-line line2"></div>--}}
    {{--</section>--}}
    <!-- offer-product-area-end -->

    <!-- popular-game -->
    <section class="popular-game-area pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="side-title mb-45">
                        <h3><i class="fas fa-play"></i>POPULAR GAME <span>TOP UP</span></h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($categories as $category)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                    <div class="popular-game-item mb-40">
                        <div class="popular-game-thumb">
                            <a href="{{route("user.services.show",$category->id)}}"><img src="{{ getFile(config('location.category.path').$category->image) }}" alt=""></a>
                        </div>
                        <div class="shop-item-bottom">
                            <div class="content">
                                <h4><a href="{{route("user.services.show",$category->id)}}">{{$category->category_title}}</a></h4>
                                {{--<a href="#" class="cat">{{$category->category_title}}</a>--}}
                            </div>
                            {{--<div class="price">{{count($category->service)}} @lang('Services')</div>--}}
                        </div>
                        <a href="{{route("user.services.show",$category->id)}}">
                        <div class="popular-game-overlay">
                            <h6><span>{{$category->category_title}}</span></h6>
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        </div>
                        </a>
                    </div>
                </div>
                @endforeach
                {{--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">--}}
                    {{--<div class="popular-game-item mb-40">--}}
                        {{--<div class="popular-game-thumb">--}}
                            {{--<a href="uc-details.html"><img src="{{asset($themeTrue.'imgs/popular_games02.jpg')}}" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-content">--}}
                            {{--<h5><i class="fas fa-star"></i>klck <span>eSports</span></h5>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-overlay">--}}
                            {{--<h6><a href="uc-details.html">judge <span>600 U.C</span></a></h6>--}}
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">--}}
                    {{--<div class="popular-game-item mb-40">--}}
                        {{--<div class="popular-game-thumb">--}}
                            {{--<a href="uc-details.html"><img src="{{asset($themeTrue.'imgs/popular_games03.jpg')}}" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-content">--}}
                            {{--<h5><i class="fas fa-star"></i>Battleg <span>pubg</span></h5>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-overlay">--}}
                            {{--<h6><a href="uc-details.html">judge <span>600 U.C</span></a></h6>--}}
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">--}}
                    {{--<div class="popular-game-item mb-40">--}}
                        {{--<div class="popular-game-thumb">--}}
                            {{--<a href="uc-details.html"><img src="{{asset($themeTrue.'imgs/popular_games04.jpg')}}" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-content">--}}
                            {{--<h5><i class="fas fa-star"></i>judge <span>destiny</span></h5>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-overlay">--}}
                            {{--<h6><a href="uc-details.html">judge <span>600 U.C</span></a></h6>--}}
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">--}}
                    {{--<div class="popular-game-item mb-40">--}}
                        {{--<div class="popular-game-thumb">--}}
                            {{--<a href="uc-details.html"><img src="{{asset($themeTrue.'imgs/popular_games05.jpg')}}" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-content">--}}
                            {{--<h5><i class="fas fa-star"></i>Call of <span>Duty</span></h5>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-overlay">--}}
                            {{--<h6><a href="uc-details.html">judge <span>600 U.C</span></a></h6>--}}
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">--}}
                    {{--<div class="popular-game-item mb-40">--}}
                        {{--<div class="popular-game-thumb">--}}
                            {{--<a href="uc-details.html"><img src="{{asset($themeTrue.'imgs/popular_games06.jpg')}}" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-content">--}}
                            {{--<h5><i class="fas fa-star"></i>valorant <span>ii</span></h5>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-overlay">--}}
                            {{--<h6><a href="uc-details.html">judge <span>600 U.C</span></a></h6>--}}
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">--}}
                    {{--<div class="popular-game-item mb-40">--}}
                        {{--<div class="popular-game-thumb">--}}
                            {{--<a href="uc-details.html"><img src="{{asset($themeTrue.'imgs/popular_games07.jpg')}}" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-content">--}}
                            {{--<h5><i class="fas fa-star"></i>clash of <span>clans</span></h5>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-overlay">--}}
                            {{--<h6><a href="uc-details.html">judge <span>600 U.C</span></a></h6>--}}
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">--}}
                    {{--<div class="popular-game-item mb-40">--}}
                        {{--<div class="popular-game-thumb">--}}
                            {{--<a href="uc-details.html"><img src="{{asset($themeTrue.'imgs/popular_games08.jpg')}}" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-content">--}}
                            {{--<h5><i class="fas fa-star"></i>pubg <span>mobile</span></h5>--}}
                        {{--</div>--}}
                        {{--<div class="popular-game-overlay">--}}
                            {{--<h6><a href="uc-details.html">judge <span>600 U.C</span></a></h6>--}}
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </section>
    <!-- <section class="rings-contain">
    <div class="container">
  <div class="ring">
    <button>
      <div class="buttonShadow">
        <svg id="flameIcon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="-50 -50 152 152" xml:space="preserve">
          <path id="st0" d="M43.334 41.697c-3.51 6.78-12.12 8.23-12.49 8.29-.05.01-.11.01-.16.01-.06 0-.12-.01-.18-.02-.04 0-.08-.01-.12-.03a.403.403 0 0 1-.2-.09c-.05-.03-.1-.06-.14-.1a.314.314 0 0 1-.11-.09c-.01-.01-.02-.02-.02-.03-.11-.14-.18-.3-.21-.46-.01-.01-.01-.01-.01-.02-.01-.05-.01-.1-.01-.15 0-.06.01-.12.02-.18 0-.04.02-.09.03-.14.01-.02.01-.03.01-.04.03-.05.05-.1.08-.14.03-.05.06-.1.1-.14.02-.04.06-.08.1-.11l.03-.03c6.82-6.08 5.24-11.77 5.17-12.01-.03-.07-.04-.15-.05-.22-.32-5.02-4.26-10.62-6.74-13.67-.47 4.74-3.4 11.87-4.14 13.6-.19.45-.68.69-1.14.59a1 1 0 0 1-.78-1.02c.06-1.57-1.21-3.66-2.33-5.15-.5 1.26-1.46 3.21-3.28 6.3-.81 1.38-1.28 2.79-1.39 4.17-.39 4.97 2.81 6.8 3.61 7.17.11.05.17.07.18.07.15.06.28.14.38.26.04.03.07.07.1.11.05.09.1.18.12.27.06.15.07.31.04.47-.01.06-.03.12-.05.18-.11.3-.35.52-.64.6-.05.02-.1.03-.15.04-.05.01-.1.01-.15.01-.11 0-.23-.02-.34-.06h-.02c-5.28-2.05-8.75-5.16-10.3-9.24-2.38-6.25.47-12.99 1.8-15.6.67-1.3 1.53-2.62 2.71-4.16 6.51-8.49 8.29-18.02 8.31-18.11.06-.37.33-.67.69-.78.35-.11.74-.01 1.01.25 5.57 5.7 9.92 10.26 12.91 13.56 2.64 2.91 4.77 5.99 6.33 9.18 3.24 6.61 3.72 12.21 1.42 16.66z" /></svg>
      </div>
    </button>
  </div>

  <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="100px" y="0px" width="900px" height="450px" viewBox="-100 -100 900 450" xml:space="preserve">
    <circle fill="none" cx="350" cy="125" r="120" transform="rotate(-90 350 125)" stroke="#070100" stroke-width="46" />
  </svg>
</div>
    </section> -->
    <!-- popular-game-end -->

</div>
<!-- section-wrap-end -->
</section>
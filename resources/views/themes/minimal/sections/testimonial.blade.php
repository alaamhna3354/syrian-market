@if(isset($contentDetails['testimonial']))
<!-- TESTIMONIAL -->
<section id="testimonial">
    <div class="container">
        <div class="testimonial-slider carousel slide" data-ride="testimonial-slider" data-interval="false" data-pause="hover">
            <div class="row">

                <div class="col-xl-6">
                    <div class="circle-layout wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.35s">
                        <ul class="circle-indicators carousel-indicators">
                            @php  $i = 1; @endphp
                            @foreach($contentDetails['testimonial'] as $key=>$data)
                            <li class="{{($key == 0) ? 'active' : ''}} nav-place-{{$i}}" data-target=".testimonial-slider" data-slide-to="{{$key}}">
                                <img src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" @if($key == 0) class="testimonial-img-150"  @endif alt="Nav Img Missing">
                            </li>
                                @php  $i++; @endphp
                            @endforeach

                        </ul>
                    </div>
                </div>


                <div class="col-xl-6">
                    <div class="text-wrapper pl-0 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">

                        @if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
                            <h1 class="heading heading-left">@lang($testimonial->description->title) <span class="sub-heading">@lang($testimonial->description->sub_title)</span></h1>
                        @endif
                        <div class="text-block">
                            @if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
                            <h3 class="h3 mb-30">@lang($testimonial->description->short_title)</h3>
                            @endif


                            <div class="carousel-inner">

                                @foreach($contentDetails['testimonial'] as $key=>$data)
                                <div class="carousel-item {{($key == 0) ? 'active' : ''}}">
                                    <div class="item-icon"><i class="icofont-quote-left"></i></div>
                                    <p class="text mb-30">
                                        @lang(@$data->description->description)
                                    </p>
                                    <div class="clients-title">
                                        <h6>@lang(@$data->description->designation)</h6>
                                        <p>@lang(@$data->description->name)</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="carousel-control">
                                <a class="carousel-control-prev" href=".testimonial-slider" data-slide="prev">
                                    <i class="icofont-long-arrow-left"></i>
                                </a>
                                <a class="carousel-control-next" href=".testimonial-slider" data-slide="next">
                                    <i class="icofont-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /TESTIMONIAL -->
@endif

@if(isset($contentDetails['service']))
<!-- SERVICES -->
<section id="services">
    <div class="container">

        @if(isset($templates['service'][0]) && $service = $templates['service'][0])
            <div class="heading-container">
                <h1 class="heading">@lang(@$service->description->title) <span
                        class="sub-heading">@lang(@$service->description->sub_title)</span></h1>
                <h3 class="slogan">@lang(@$service->description->short_title)</h3>
            </div>
        @endif


        <div class="row">
            @foreach($contentDetails['service'] as $data)
            <div class="col-lg-4">
                <div class="card-type-1 card wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.35s">
                    <div class="card-icon">
                        <img class="card-img-top" src="{{getFile(config('location.content.path').@$data->content->contentMedia->description->image)}}" alt="Icon Missing">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang(@$data->description->title)</h4>
                        <p class="card-text">@lang(@$data->description->short_description)</p>
                        <a class="btn-readmore" href="{{@$data->content->contentMedia->description->button_link}}"><i class="icofont-long-arrow-right"></i>@lang(@$data->description->button_name)</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /SERVICES -->
@endif

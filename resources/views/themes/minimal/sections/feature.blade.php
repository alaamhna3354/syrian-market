
@if(isset($contentDetails['feature']))
<!-- FEATURE -->
<section id="feature">
    <div class="container">
        <div class="row">
            @foreach($contentDetails['feature'] as $feature)
            <div class="col-lg-4">
                <div class="card-type-1 card wow fadeInUp" data-wow-duration="1s" data-wow-dealy="0.1s">
                    <div class="card-icon">
                        <img class="card-img-top" src="{{getFile(config('location.content.path').@$feature->content->contentMedia->description->image)}}" alt="Icon Missing">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">@lang($feature->description->title)</h4>
                        <p class="card-text">
                            @lang($feature->description->short_description)
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- /FEATURE -->
@endif

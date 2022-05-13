<!-- FAQ -->
<section id="faq">
    <div class="container">
        @if(isset($templates['faq'][0]) && $faq = $templates['faq'][0])
            <h4 class="h4 wow fadeInUp" data-wow-duration="1s"
                data-wow-delay="0.1s">@lang(@$faq->description->title)</h4>
            <p class="p mt-30 mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                @lang(@$faq->description->short_details)
            </p>
        @endif

        <div id="faq-wrapper mt-3">

            @if(isset($contentDetails['faq']))
                @foreach($contentDetails['faq'] as $k => $data)

                    <div class="faq-card card mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.35s">
                        <div class="card-header" id="heading{{$k}}">
                            <h5 class="mb-0">
                                <button class="btn-faq" data-toggle="collapse" data-target="#collapse{{$k}}"
                                        aria-expanded="true" aria-controls="collapse{{$k}}">
                                    @lang(@$data->description->title)
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{$k}}" class="collapse" aria-labelledby="heading{{$k}}"
                             data-parent="#faq-wrapper">
                            <div class="card-body">
                                @lang(@$data->description->description)
                            </div>
                        </div>
                    </div>

                    @php
                        $increment++;
                    @endphp
                @endforeach
            @endif

        </div>
    </div>
</section>
<!-- /FAQ -->

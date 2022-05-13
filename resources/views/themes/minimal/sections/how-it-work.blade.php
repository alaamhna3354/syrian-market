@if(isset($contentDetails['how-it-work']))
    <!-- HOW-IT-WORKS -->
    <section id="how-it-works">
        <div class="container">
            @if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
                <div class="heading-container">
                    <h1 class="heading">@lang(@$howItWork->description->title) <span
                            class="sub-heading">@lang(@$howItWork->description->sub_title)</span></h1>
                    <h3 class="slogan">@lang(@$howItWork->description->short_title)</h3>
                </div>
            @endif

            <div class="how-it-works">
                @foreach($contentDetails['how-it-work'] as $data)
                    <div class="content-wrapper">
                        <div class="icon">
                            <i class="{{@$data->content->contentMedia->description->icon}}"></i>
                        </div>
                        <h6 class="h6 mt-20 mb-20">@lang(@$data->description->title)</h6>
                        <p>@lang(@$data->description->short_description)</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /HOW-IT-WORKS -->
@endif

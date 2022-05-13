@if(isset($contentDetails['blog']))
    <!-- BLOG -->
    <section id="blog">
        <div class="shape-circle wow fadeIn" data-wow-duration="1s" data-wow-delay="0..5s">
            <div class="circle"></div>
        </div>
        <div class="container">
            @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
                <div class="heading-container">
                    <h1 class="heading">@lang($blog->description->title) <span
                            class="sub-heading">@lang($blog->description->sub_title)</span></h1>
                    <h3 class="slogan">@lang($blog->description->short_title)</h3>
                </div>
            @endif

            <div class="row">

                @foreach($contentDetails['blog']->take(3)->sortDesc() as $data)
                    <div class="col-lg-4">
                        <div class="card-blog card wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
                            <div class="fig-container">
                                <img
                                    src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                    alt="{{@$data->description->title}}">
                                <div class="published-date">
                                    <span>{{dateTime($data->created_at,'d')}}</span>
                                    <span>{{dateTime($data->created_at,'M')}}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{Str::limit($data->description->title,40)}}</h5>
                                <a class="btn-readmore"
                                   href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}"><i
                                        class="icofont-long-arrow-right"></i> @lang('Read More')</a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>


        </div>
    </section>
    <!-- /BLOG -->
@endif

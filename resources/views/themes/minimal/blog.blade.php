@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')

    @if(isset($contentDetails['blog']))
    <!-- BLOG -->
    <section id="blog">
        <div class="container">

            <div class="row">

                @foreach($contentDetails['blog']->sortDesc() as $data)
                <div class="col-lg-4">
                    <div class="card-blog card mb-30 blog-shadow wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
                        <div class="fig-container">
                            <img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"  alt="{{@$data->description->title}}">
                            <div class="published-date">
                                <span>{{dateTime($data->created_at,'d')}}</span>
                                <span>{{dateTime($data->created_at,'M')}}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{\Str::limit($data->description->title,40)}}</h5>
                            <a class="btn-readmore" href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}"><i class="icofont-long-arrow-right"></i> @lang('Read More')</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>
    <!-- /BLOG -->
    @endif

@endsection

@extends($theme.'layouts.app')
@section('title','Blog Details')

@section('content')



    <!-- BLOG -->
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card-blog card mb-30 shadow-none wow fadeInUp" data-wow-duration="1s"
                         data-wow-delay="0.35s">
                        <div class="fig-container">
                            <img src="{{$singleItem['image']}}" alt="{{$singleItem['title']}}">
                            <div class="published-date">
                                <span>{{$singleItem['d']}}</span>
                                <span>{{$singleItem['M']}}</span>
                            </div>
                        </div>
                        <div class="card-body mt-30 p-0">
                            <h5 class="card-title">{{$singleItem['title']}}</h5>

                            <p class="p mb-0 lineheight-30 text-justify">
                                @lang($singleItem['description'])
                            </p>
                        </div>
                    </div>


                </div>


                @if(isset($popularContentDetails['blog']))
                    <div class="col-lg-4">
                        <div class="blog-sidebar wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.35s">

                            <h5 class="h5 mt-40">{{trans('Popular Post')}}</h5>

                            <hr class="mt-20 mb-20 border">

                            <div class="popular-post">

                                @foreach($popularContentDetails['blog']->sortDesc() as $data)
                                    <div class="media align-items-center">
                                        <div class="media-img">
                                            <img class="br-4 popular-post-img"
                                                 src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"
                                                 alt="{{@$data->description->title}}">
                                        </div>
                                        <div class="media-body ml-20">
                                            <p class="post-date mb-5">{{dateTime($data->created_at,'d M, Y')}}</p>
                                            <h6 class="h6">
                                                <a  href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}">{{\Str::limit($data->description->title,40)}}</a>
                                            </h6>

                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- /BLOG -->
@endsection

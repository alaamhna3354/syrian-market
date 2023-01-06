@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')

    {{--@if(isset($contentDetails['blog']))--}}
    <!-- BLOG -->
    <section id="blog" data-background="{{asset($themeTrue.'imgs/shop_bg.jpg')}}">
        <!-- <div class="container">

            <div class="row">

                {{--@foreach($contentDetails['blog']->sortDesc() as $data)--}}
                {{--<div class="col-lg-4">--}}
                    {{--<div class="card-blog card mb-30 blog-shadow wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">--}}
                        {{--<div class="fig-container">--}}
                            {{--<img src="{{getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)}}"  alt="{{@$data->description->title}}">--}}
                            {{--<div class="published-date">--}}
                                {{--<span>{{dateTime($data->created_at,'d')}}</span>--}}
                                {{--<span>{{dateTime($data->created_at,'M')}}</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="card-body">--}}
                            {{--<h5 class="card-title">{{\Str::limit($data->description->title,40)}}</h5>--}}
                            {{--<a class="btn-readmore" href="{{route('blogDetails',[slug($data->description->title), $data->content_id])}}"><i class="icofont-long-arrow-right"></i> @lang('Read More')</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--@endforeach--}}

            </div>

        </div> -->
        <div class="container">
        <div class="row">
                <div class="col-lg-12 text-center d-flex justify-content-center">
                    <h1 class="tit">الوكلاء</h1>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 text-center">
                <img class="imag" style="width: 225px;"
                src="{{asset($themeTrue.'imgs/unnamed.png')}}" alt="">
                </div>
                <div class="col-lg-6 col-sm-12 col-12 mb-4 gr-int">
                    <h2>شروط الانتساب كوكيل لسيريا ماركت :</h2>
                    <h4>
                        <ul>
                            <li><i class="fas fa-check"></i><span>ان تتجاوز مشترياتك 5000$ شهريا</span></li>
                            <li><i class="fas fa-check"></i><span>الدفع نقدا</span></li>
                            <li><i class="fas fa-check"></i><span> دعوة 10 من اصدقائك وفتح حساباتهم بمدة أقل من 15 يوم</span></li>
                            <li><i class="fas fa-check"></i><span>يجب ان يحوي رصيدك على الاقل على 500 $</span></li>
                        </ul>


                    </h4>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 text-center">
                <img class="imag" src="{{asset($themeTrue.'imgs/agents.png')}}" alt="">
                </div>
                <div class="col-lg-6 col-sm-12 col-12 gr-int">
                    <h2>مميزات كونك أحد وكلائنا :</h2>
                    <h4>
                        <ul>
                            <li><i class="fas fa-check"></i><span>أسعار مخصصة لتجار الجملة</span></li>
                            <li><i class="fas fa-check"></i><span>وزع أكثر من 1500 بطاقة</span></li>
                            <li><i class="fas fa-check"></i><span>الربح من خلال مشتريات اصدقائك</span></li>
                            <li><i class="fas fa-check"></i><span>خدمة عملاء مخصصة</span></li>
                            <li><i class="fas fa-check"></i><span>تسليم مباشر للطلبات</span></li>
                        </ul>


                    </h4>
                </div>

                </div>
                <hr>
                <div class="row">
                <div class="col-lg-12 text-center d-flex justify-content-center">
                <h1 class="mb-4 tit">الشرائح</h1>
                </div>
                <div class="col-lg-12 text-center">
                <h3>
                    عزيزي المستخدم
                <br> إذا كنت ترغب بترقية حسابك الى شريحة أعلى والحصول على حسومات مميزة ما عليك إلا زيادة مبيعاتك الشهرية
                </h3>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 text-center mt-4">
                <img class="imag" src="{{asset($themeTrue.'imgs/slides1.jpg')}}" alt="">
                </div>
                <div class="col-lg-6 col-sm-12 col-12 mt-4">
                    <h4>
                        <ul class="sim">
                            @foreach($levels as $key => $level)
                            <li>
                                <img src="{{asset($themeTrue.'imgs/level-'.($key+1 > 5 ? 6 : $key+1).'.jpg')}}" alt="">
                                <span>يتطلب الشراء ب
                                <span style="color:#ff5917">{{$level->min_total_amount}}$</span>
                                    للوصول لهذا المستوى
                                </span>
                                <i class="fas fa-check"></i>
                            </li>
                            @endforeach

                        </ul>


                    </h4>
                </div>
                </div>
            {{--points--}}
            <hr>
            <div class="row">
                <div class="col-lg-12 text-center d-flex justify-content-center">
                    <h1 class="mb-4 tit">@lang('Points')</h1>
                </div>
                <div class="col-lg-12 text-center">
                    <h3>
                        <br>{{$pointsSection->description->title}}
                    </h3>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 text-center mt-4">
                    <img class="imag" src="{{asset($themeTrue.'imgs/earn-point.png')}}" alt="" width="50%">
                </div>
                <div class="col-lg-6 col-sm-12 col-12 mt-4">
                        <div class="card-body" >
                            {!! $pointsSection->description->short_description !!}
                        </div>
                </div>
            </div>
        </div>
    </section>
<style>

#blog{
    text-align: start;
    padding: 20px;
}
#blog h1{
    font-weight: bold;
    padding: 5px 20px;
    border-bottom: 2px solid #ff5917;
}
#blog hr{
    border: 1px solid #ff5917;
}
#blog{
    text-align: start;
    color:#fff;
    min-height:300px;
    padding: 20px;
}
#blog .imag{
    max-width: 100%;
    margin-bottom:25px;
    border-radius: 29px;
}
#blog .gr-inf{
    display:grid;
    place-content:center;
}
#blog ul li{
    line-height: 2;
    display: flex;
    align-items: center;
}
#blog ul li img{
    width:100px;
}
#blog ul li i{
    margin-inline-end: 10px;
    color: #f1632c;
}
#blog .sim li{
    justify-content: space-around;
}
#blog .sim li i{
    margin-inline-start: 10px;
    margin-inline-end: 0;
    color: #f1632c;
}
@media (max-width:568px) {
#blog{
    padding: 20px 10px;
}
#blog .gr-int{
    display:grid;
    place-content:center;
}
h2{
  font-size: 20px;
}
h3{
  font-size: 18px;
}
h4{
  font-size: 16px;
}
#blog .sim li{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 10px 0;
    border: 1px solid #ff682d;
    padding: 5px;
}
#blog ul li img{
    width:80px;
}
#blog .sim li i{
    display: none;
}
}
</style>
    <!-- /BLOG -->
    {{--@endif--}}

@endsection

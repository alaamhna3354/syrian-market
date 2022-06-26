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
                <div class="col-lg-12 text-center">
                    <h1>أنضم إلينا</h1>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 text-center">
                <img class="imag" src="{{asset($themeTrue.'imgs/agents.png')}}" alt="">
                </div>
                <div class="col-lg-6 col-sm-12 col-12 gr-inf">
                    <h2>مميزات كونك أحد وكلائنا :</h2>
                    <h4>
                        <ul>
                            <li><i class="fas fa-check"></i><span>أسعار مخصصة لتجار الجملة</span></li>
                            <li><i class="fas fa-check"></i><span>وزع أكثر من 1500 بطاقة</span></li>
                            <li><i class="fas fa-check"></i><span>خدمة عملاء مخصصة</span></li>
                            <li><i class="fas fa-check"></i><span>تسليم مباشر للطلبات</span></li>
                        </ul>
                         
                        
                    </h4>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-lg-12 text-center">
                <h1 class="mb-4">الشرائح</h1>
                <h3>
                    عزيزي المستخدم إن شريحتك الحالية : <span style="color:#ff5917">3</span>
                <br> إذا كنت ترغب بترقية حسابك الى شريحة أعلى والحصول على حسومات مميزة ما عليك إلا زيادة مبيعاتك الشهرية
                </h3>
                </div>
                <!-- <div class="col-lg-6 col-sm-12 col-12 text-center">
                <img class="imag" src="{{asset($themeTrue.'imgs/slides1.jpg')}}" alt="">
                </div> -->
                <div class="col-sm-12 col-12 gr-inf">
                    <h4>
                        <ul class="sim">
                            <li>
                                <img src="{{asset($themeTrue.'imgs/level-1.jpg')}}" alt="">
                                <span>يتطلب الشراء ب
                                <span style="color:#ff5917">500$</span> 
                                    للوصول لهذا المستوى
                                </span>
                                <i class="fas fa-check"></i>
                            </li>
                            <li>
                                <img src="{{asset($themeTrue.'imgs/level-2.jpg')}}" alt="">
                                <span>يتطلب الشراء ب
                                <span style="color:#ff5917">700$</span> 
                                    للوصول لهذا المستوى
                                </span>
                                <i class="fas fa-check"></i>
                            </li>
                            <li>
                                <img src="{{asset($themeTrue.'imgs/level-3.jpg')}}" alt="">
                                <span>يتطلب الشراء ب
                                <span style="color:#ff5917">800$</span> 
                                    للوصول لهذا المستوى
                                </span>
                                <i class="fas fa-check"></i>
                            </li>
                            <li>
                                <img src="{{asset($themeTrue.'imgs/level-4.jpg')}}" alt="">
                                <span>يتطلب الشراء ب
                                <span style="color:#ff5917">900$</span> 
                                    للوصول لهذا المستوى
                                </span>
                                <i class="fas fa-check"></i>
                            </li>
                            <li>
                                <img src="{{asset($themeTrue.'imgs/level-5.jpg')}}" alt="">
                                <span>يتطلب الشراء ب
                                <span style="color:#ff5917">1000$</span> 
                                    للوصول لهذا المستوى
                                </span>
                                <i class="fas fa-check"></i>
                            </li>
                        </ul>
                         
                        
                    </h4>
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
#blog .sim li i{
    margin-inline-start: 10px;
    margin-inline-end: 0;
    color: #f1632c;
}

#blog .gr-inf{
    display: grid;
    place-content: center;
}
@media (max-width:568px) {
#blog{
    padding: 20px 10px;
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

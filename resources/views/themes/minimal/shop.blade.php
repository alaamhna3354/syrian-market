@extends($theme.'layouts.app')
@section('title','shop')

@section('content')

    <div class="breadcrumb-content text-center">
        <h2 style="margin:0;padding: 10px;"> <span>@lang('Shop')</span></h2>
    </div>
    <!-- shop-area -->
    <section class="shop-area shop-bg pt-120 pb-120" data-background="{{asset($themeTrue.'imgs/shop_bg.jpg')}}">
        <div class="container">
            <div class="shop-top-meta mb-30">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <p class="show-result">@lang('Showing 1–12 of 10 Results')</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="shop-filter">
                            <form action="#">
                                <select class="custom-select">
                                    <option selected="">@lang('sort by latest')</option>
                                    <option>@lang('Best match')</option>
                                    <option>@lang('Price high to low')</option>
                                    <option>@lang('price low to high')</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($categories as $category)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                    <div class="popular-game-item mb-40">
                        <div class="popular-game-thumb">
                            <a href="{{route("user.services.show",$category->id)}}">
                                <img src="{{ getFile(config('location.category.path').$category->image) }}" alt=""></a>
                        </div>    
                        <a href="{{route("user.services.show",$category->id)}}">
                        <div class="popular-game-overlay">
                            <h6><span>{{$category->category_title}}</span></h6>
                            {{--<a href="uc-details.html" class="cart"><i class="fas fa-shopping-basket"></i></a>--}}
                        </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="pagination-wrap mt-30">
                        <ul >
                            <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            {{--<li><a href="#">2</a></li>--}}
                            {{--<li><a href="#">..</a></li>--}}
                            {{--<li><a href="#">4</a></li>--}}
                            <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>
                    {{ $categories->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
        {{--<div class="shop-area-shape"><img src="img/bg/shop_overlay_shape.png" alt=""></div>--}}
    </section>
    <!-- shop-area-end -->
@endsection
<style>
.pagination-wrap ul {
    display:flex;
    justify-content:center;
}    
.page-item.active .page-link {
    background-color: #ff5917 !important;
    border-color: #ff5917 !important;
}
.pagination-wrap ul li a {
    background-color: transparent;
    display:flex !important;
    justify-content:center !important;
    align-items: center !important;
}
.page-link:hover {
    background-color: #ff5917 !important;
    border-color: #ff5917 !important;
}

</style>

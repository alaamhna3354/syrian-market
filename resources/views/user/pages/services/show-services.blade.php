@extends('user.layouts.app')
@section('title')
    @lang('Service')
@endsection

@section('styles')
    <style>


    </style>
@endsection

@section('content')
    {{--<!-- Page Content -->--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--@foreach($services as $service)--}}
    {{--<!-- category -->--}}
    {{--<div class="col-xl-2 col-md-6 mb-4">--}}
    {{--<div class="card border-0 shadow">--}}
    {{--<a href="{{route('user.order.create')}}?serviceId={{$service->id}}">--}}
    {{--<img src="{{ getFile(config('location.category.path').$category->image) }}" class="card-img-top" alt="...">--}}
    {{--<div class="card-body text-center">--}}
    {{--<h5 class="card-title mb-0">{{$service->service_title }}</h5>--}}
    {{--<div class="card-text text-black-50">{{$service->price}} {{config('basic.currency_symbol')}}</div>--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}
    {{--</div>--}}

    <div class="contain-cards-order services">
        <h3 class="text-white">@lang('Add Order') <a href="{{ route('user.service.show') }}"><i class="fa fa-arrow-right"></i></a></h3>
        <div class="search">
            <input type="text" class="myInput">
            <button class="btn">@lang('search')</button>
        </div>
        <div class="cards-order" id="cards-services">
            @foreach($services as $service)
            <div class="item it" data-title=" {{$service->service_title }}">
                <div class="name" data-name="{{$service->service_title }}">
                    {{$service->service_title }}
                    <div class="icon">
                        <img src="{{asset($themeTrue.'imgs/tumile.png')}}" alt="user">
                    </div>
                </div>
                <div class="price" data-price=" {{$service->price}} {{config('basic.currency_symbol')}}">
                    {{$service->price}} {{config('basic.currency_symbol')}}
                </div>
                <div class="fire">
                    <img src="{{asset($themeTrue.'imgs/firegif_2.gif')}}" alt="user">
                </div>
            </div>

            {{--<div class="item disable">--}}
                {{--<div class="pack">--}}
                    {{--‏tumile 1250 coins--}}
                    {{--<div class="icon">--}}
                        {{--<img src="{{asset($themeTrue.'imgs/tumile.png')}}" alt="user">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="name">--}}
                    {{--$3.34--}}
                {{--</div>--}}
                {{--<div class="fire">--}}
                    {{--<img src="{{asset($themeTrue.'imgs/firegif_2.gif')}}" alt="user">--}}
                {{--</div>--}}
            {{--</div>--}}
            @endforeach
        </div>

        <form action="">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <label for="">@lang('quantity')</label>
                    <input type="number" class="quantity">
                </div>
                <div class="col-12 col-sm-6">
                    <label for="">@lang('Total')</label>
                    <input type="text" class="total" readonly>
                </div>

                <div class=" col-12 col-sm-5">
                    <label for="">@lang('Player number')</label>
                    <input type="number">
                </div>
                <div class="col-10 col-sm-5">
                    <label for="">@lang('Player name')</label>
                    <input type="text">
                </div>
                <div class="col-2 col-sm-2 d-flex align-items-center refresh">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <div class="col-12 mt-4 text-center ">
                    <div class="chosen-item">
    <span>
    <img
            src="{{asset($themeTrue.'imgs/tumile.png')}}"
            alt="user"
    > x<span class="quantity-val"></span></span>
                        <span class="name-val"></span>
                        <span class="price-val"></span>
                    </div>
                </div>
                <div class="col-12 mt-4 text-center add">
                    <button class="btn">@lang('Add')</button>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
          "use strict"; 
           // fun 1
           $(".myInput").on("keyup", function() {
            var value = this.value.toLowerCase().trim();
            $(".it").show().filter(function() {
                return $(this).attr("data-title").toLowerCase().trim().indexOf(value) == -1;
            }).hide();
            });
          // fun 2
        $('#cards-services .item').on('click', function (event) {
            if($(this).hasClass("disable")){
                event.preventDefault();
            }
           else if($(this).hasClass("active")){
                $(this).removeClass('active');
                $('.chosen-item').removeClass('active');
                $('#cards-services .item').removeClass('un-active');
                $(".total").val(`0`);
                $('.quantity').val('0');

            }
            else{
                $('#cards-services .item').removeClass('active');
                $('#cards-services .item').addClass('un-active');
                $(this).addClass('active');
                $('.chosen-item').addClass('active');
                var name =  $(this).children(`.name`).attr("data-name");
                var price =  $(this).children(`.price`).attr("data-price").replace('$','');
                $(".name-val").html(name);
                $(".price-val").html(`${price}$`);
                $(".total").val(`${price}$`);
                $('.quantity').val('1');
                $('.quantity-val').html('1');

                $(".quantity").keyup(function(){
                var valu =  $(this).val();
               $(".quantity-val").html(valu);
               $(".total").val(`${valu*price}$`);
               $(".price-val").html(`${valu*price}$`);
            });
            }
            
            event.preventDefault();
        });
            
        {{--"use strict";--}}
        {{--$(document).on('click', '#details', function () {--}}
        {{--var title = $(this).data('servicetitle');--}}
        {{--var id = $(this).data('id');--}}

        {{--var orderRoute = "{{route('user.order.create')}}" + '?serviceId=' + id;--}}
        {{--$('.order-now').attr('href', orderRoute);--}}

        {{--var description = $(this).data('description');--}}
        {{--$('#title').text(title);--}}
        {{--$('#servicedescription').text(description);--}}
        {{--});--}}

        // // Add active class to the current side-bar item
        // var cards = document.getElementById("cards");
        // var li = cards.getElementsByClassName("card-item");
        // var add = document.getElementById("add");
        //
        // add.addEventListener("click", function(event) {
        //     event.preventDefault();
        // });
        //
        // for (var i = 0; i < li.length; i++) {
        //     li[i].addEventListener("click", function() {
        //         add.classList.add('active');
        //         // ****************** set code here ******************
        //     });
        // }
    </script>
@endpush


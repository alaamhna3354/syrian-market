@extends('user.layouts.app')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection


@section('content')

    <div class="container ">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="custom-breadcrumb-li"><a href="{{route('user.addFund')}}" class="text-white">@lang('Add Fund')</a></li>
            <li class="active">@lang(optional($order->gateway)->name)</li>
        </ol>


        <div class="row my-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">@lang('Payment Preview')</h3>

                        <h4> @lang('PLEASE SEND EXACTLY') <span
                                class="text-success"> {{ getAmount($data->amount) }}</span> {{$data->gateway_currency}}
                        </h4>
                        <h5>@lang('TO') <span class="text-success"> {{ $data->sendto }}</span></h5>
                        <img src="{{$data->img}}" alt="..">
                        <h4 class="text-color bold">@lang('SCAN TO SEND')</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection


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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                         class="card-img-top gateway-img" alt="..">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4 class="my-3 text-center">@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                <h4 class=" text-center">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4>


                                <button type="button"
                                        class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"
                                        id="btn-confirm">@lang('Pay Now')</button>
                                <form
                                    action="{{ route('ipn', [optional($order->gateway)->code, $order->transaction]) }}"
                                    method="POST">
                                    @csrf
                                    <script
                                        src="//js.paystack.co/v1/inline.js"
                                        data-key="{{ $data->key }}"
                                        data-email="{{ $data->email }}"
                                        data-amount="{{$data->amount}}"
                                        data-currency="{{$data->currency}}"
                                        data-ref="{{ $data->ref }}"
                                        data-custom-button="btn-confirm">
                                    </script>
                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


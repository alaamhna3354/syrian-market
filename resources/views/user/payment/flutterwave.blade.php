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
                    <div class="card-body text-center">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                         class="card-img-top gateway-img" alt="..">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h4 class="my-3 text-center">@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                <h4 class=" text-center">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4>

                                <button type="button" class="btn btn-info" id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script>
        var btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");
        const API_publicKey = "{{$data->API_publicKey ?? ''}}";

        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "{{$data->customer_email ?? 'example@example.com'}}",
                amount: "{{ $data->amount ?? '0' }}",
                customer_phone: "{{ $data->customer_phone ?? '0123' }}",
                currency: "{{ $data->currency ?? 'USD' }}",
                txref: "{{ $data->txref ?? '' }}",
                onclose: function () {
                },
                callback: function (response) {
                    let txref = response.tx.txRef;
                    let status = response.tx.status;
                    window.location = '{{ url('payment/flutterwave') }}/' + txref + '/' + status;
                }
            });
        }
    </script>
@endsection

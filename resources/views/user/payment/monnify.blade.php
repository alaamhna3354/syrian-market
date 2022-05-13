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

                            <div class="col-md-5">
                                <h4 class="my-3  text-center">@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                <h4 class="text-center">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4>
                                <button class="btn btn-primary btn-block mt-2" onclick="payWithMonnify()">@lang('Pay via Monnify')
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript" src="//sdk.monnify.com/plugin/monnify.js"></script>
    <script type="text/javascript">
        function payWithMonnify() {
            MonnifySDK.initialize({
                amount: {{ $data->amount ?? '0' }},
                currency: "{{ $data->currency ?? 'NGN' }}",
                reference: "{{ $data->ref }}",
                customerName: "{{$data->customer_name ?? 'John Doe'}}",
                customerEmail: "{{$data->customer_email ?? 'example@example.com'}}",
                customerMobileNumber: "{{ $data->customer_phone ?? '0123' }}",
                apiKey: "{{ $data->api_key }}",
                contractCode: "{{ $data->contract_code }}",
                paymentDescription: "{{ $data->description }}",
                isTestMode: true,
                onComplete: function (response) {
                    if (response.paymentReference) {
                        window.location.href = '{{ route('ipn', ['monnify', $data->ref]) }}';
                    } else {
                        window.location.href = '{{ route('failed') }}';
                    }
                },
                onClose: function (data) {
                }
            });
        }
    </script>
@endsection

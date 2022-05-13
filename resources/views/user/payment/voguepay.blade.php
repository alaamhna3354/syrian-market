@extends('user.layouts.app')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection
@section('content')
    <div class="container">
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

                                <h4 class="my-3 text-center">@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                <h4 class=" text-center">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4>

                                <button type="button"
                                        class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"
                                        id="btn-confirm">@lang('Pay with VoguePay')
                                </button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('js')
    <script src="//voguepay.com/js/voguepay.js"></script>
    <script>
        closedFunction = function () {

        }
        successFunction = function (transaction_id) {
            let txref = "{{ $data->merchant_ref }}";
            window.location.href = '{{ url('payment/voguepay') }}/' + txref + '/' + transaction_id;
        }
        failedFunction = function (transaction_id) {
            window.location.href = '{{ route('failed') }}';
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id}}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{$data->cur}}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo: "{{$data->memo}}",
                recurrent: true,
                frequency: 10,
                developer_code: '5cff7398d89d1',
                store_id: "{{ $data->store_id }}",
                custom: "{{ $data->custom }}",

                closed: closedFunction,
                success: successFunction,
                failed: failedFunction
            });
        }

        $(document).ready(function () {
            $(document).on('click', '#btn-confirm', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        });
    </script>
@endpush

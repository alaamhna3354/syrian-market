@extends('user.layouts.app')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('content')
    @push('style')
        <link href="{{ asset('assets/css/card-js.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

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
                                <h4 class="card-title text-center mb-4"> Your Card Information</h4>


                                <form class="form-horizontal" id="example-form" action="{{ route('ipn', [optional($order->gateway)->code ?? '', $order->transaction]) }}" method="post">
                                    <div class="card-js form-group">
                                        <input class="card-number form-control"
                                               name="card_number"
                                               placeholder="Enter your card number"
                                               autocomplete="off"
                                               required>
                                        <input class="name form-control"
                                               id="the-card-name-id"
                                               name="card_name"
                                               placeholder="Enter the name on your card"
                                               autocomplete="off"
                                               required>
                                        <input class="expiry form-control"
                                               autocomplete="off"
                                               required>
                                        <input class="expiry-month" name="expiry_month">
                                        <input class="expiry-year" name="expiry_year">
                                        <input class="cvc form-control"
                                               name="card_cvc"
                                               autocomplete="off"
                                               required>
                                    </div>
                                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block">Submit</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/js/card-js.min.js') }}"></script>
    @endpush

@endsection

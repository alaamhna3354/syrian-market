@extends('user.layouts.app')
@section('title')
    @lang('Add Fund')
@endsection
@section('content')

    <div class="container">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang('Add Fund')</li>
        </ol>
        <div class="row my-3">
            @foreach($gateways as $key => $gateway)
                <div class="col-xl-2 col-lg-3 col-md-4  col-sm-6 col-6 ">
                    <div class="card text-center">
                        <img src="{{ getFile(config('location.gateway.path').$gateway->image)}}"
                             alt="{{$gateway->name}}" class="gateway">
                        <div class="card-footer bg-white deposit-footer">
                            <button type="button"
                                    data-id="{{$gateway->id}}"
                                    data-name="{{$gateway->name}}"
                                    data-currency="{{$gateway->currency}}"
                                    data-gateway="{{$gateway->code}}"

                                    data-min_amount="{{getAmount($gateway->min_amount, $basic->fraction_number)}}"
                                    data-max_amount="{{getAmount($gateway->max_amount,$basic->fraction_number)}}"
                                    data-percent_charge="{{getAmount($gateway->percentage_charge,$basic->fraction_number)}}"
                                    data-fix_charge="{{getAmount($gateway->fixed_charge, $basic->fraction_number)}}"

                                    class="btn waves-effect waves-light btn-sm btn-primary btn-block addFund"
                                    data-toggle="modal" data-target="#signup-modal">@lang('Pay Now')</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>




    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="primary-header-modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title method-name" id="primary-header-modalLabel"></h4>

                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>


                <div class="modal-body">

                    <div class="payment-form">
                        <p class="text-danger depositLimit"></p>
                        <p class="text-danger depositCharge"></p>
                        <input type="hidden" class="form-control gateway" name="gateway" value="">
                        <div class="form-group">
                            <label>@lang('Amount')</label>
                            <div class="input-group">
                                <input type="text" class="form-control amount" name="amount" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text show-currency"></span>
                                </div>
                            </div>
                            <pre class="text-danger errors"></pre>
                        </div>
                    </div>
                    <div class="payment-info text-center">
                        <img id="loading" src="{{asset('assets/images/loading.gif')}}" alt=""/>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary checkCalc">@lang('Check')</button>
                </div>

            </div>
        </div>
    </div>


@endsection



@push('js')

    <script>
        $('#loading').hide();
        "use strict"
        var id, minAmount, maxAmount, baseSymbol, fixCharge, percentCharge, currency, amount, gateway;

        $('.addFund').on('click', function () {
            id = $(this).data('id');
            gateway = $(this).data('gateway');
            minAmount = $(this).data('min_amount');
            maxAmount = $(this).data('max_amount');
            baseSymbol = "{{config('basic.currency_symbol')}}";
            fixCharge = $(this).data('fix_charge');
            percentCharge = $(this).data('percent_charge');
            currency = $(this).data('currency');
            $('.depositLimit').text(`@lang('Transaction Limit:') ${minAmount} - ${maxAmount}  ${baseSymbol}`);

            var depositCharge = `@lang('Charge:') ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' + percentCharge + ' % ' : ''}`;
            $('.depositCharge').text(depositCharge);

            $('.method-name').text(`@lang('Payment By') ${$(this).data('name')} - ${currency}`);
            $('.show-currency').text("{{config('basic.currency')}}");
            $('.gateway').val(currency);
        });


        $(".checkCalc").on('click', function () {
            $('#loading').show();
            $('.payment-form').addClass('d-none');

            amount = $('.amount').val();

            $.ajax({
                url: "{{route('user.addFund.request')}}",
                type: 'POST',
                data: {
                    amount,
                    gateway
                },
                success(data) {

                    $('.payment-form').addClass('d-none');
                    $('.checkCalc').closest('.modal-footer').addClass('d-none');

                    var htmlData = `
                     <ul class="list-group text-center">
                        <li class="list-group-item">
                            <img src="${data.gateway_image}"
                                style="max-width:100px; max-height:100px; margin:0 auto;"/>
                        </li>
                        <li class="list-group-item">
                            @lang('Amount'):
                            <strong>${data.amount} </strong>
                        </li>
                        <li class="list-group-item">@lang('Charge'):
                                <strong>${data.charge}</strong>
                        </li>
                        <li class="list-group-item">
                            @lang('Payable'): <strong> ${data.payable}</strong>
                        </li>
                        <li class="list-group-item">
                            @lang('Conversion Rate'): <strong>${data.conversion_rate}</strong>
                        </li>
                        <li class="list-group-item">
                            <strong>${data.in}</strong>
                        </li>

                        ${(data.isCrypto == true) ? `
                        <li class="list-group-item">
                            ${data.conversion_with}
                        </li>
                        ` : ``}

                        <li class="list-group-item">
                        <a href="${data.payment_url}" class="btn btn-default text-white waves-effect waves-light btn-block addFund ">@lang('Pay Now')</a>
                        </li>
                        </ul>`;

                    $('.payment-info').html(htmlData)
                },
                complete: function () {
                    $('#loading').hide();
                },
                error(err) {
                    var errors = err.responseJSON;
                    for (var obj in errors) {
                        $('.errors').text(`${errors[obj]}`)
                    }
                    $('.payment-form').removeClass('d-none');
                }
            });

            $('.close').on('click', function () {
                $('#loading').hide();
                $('.payment-form').removeClass('d-none');
                $('.checkCalc').closest('.modal-footer').removeClass('d-none');
                $('.payment-info').html(``)
                $('.amount').val('');
            })


        });

    </script>
@endpush


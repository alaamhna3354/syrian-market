@extends('user.layouts.app')
@section('title')
    @lang('New Order')
@endsection
@section('content')
    <div class="container">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang('New Order')</li>
        </ol>

        <div class="row my-3">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-order">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title shadow-h text-white mb-3">@lang('Add new')</h4>
                                <form class="form" method="post" action="{{route('user.order.store')}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group price">
                                                <label class="shadow-h text-white">@lang('CODE')</label>
                                                <input type="text" id="code" name="code" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3 place_order"><span>@lang('Place Order')</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        "use strict";
        $(document).ready(function () {
            var catId = "{{ old('category', $selectService->category_id ?? '') }}";
            if (catId) {
                getService(catId);
            }
            $(document).on('change', '#category', function (e) {
                var cat_id = $('option:selected', this).val();
                getService(cat_id);
            });

            $(document).on('change', '#service', function () {
                var ser_id = $('option:selected', this).val();
                getServiceDetails(ser_id)
            });

            function getService(cat_id) {
                $.ajax({
                    url: "{{ route('user.service') }}",
                    type: "POST",
                    data: {cat_id: cat_id},
                    success: function (data) {
                        $('#service').html('');
                        if (data.length) {
                            var serviceId = "{{old('service', $selectService->id ?? '')}}";

                            $(data).each(function (key, val) {
                                if(!serviceId) {
                                    if (key == 0) {
                                        $('#service').append('<option value="" disabled selected>@lang('Select Service')</option>');
                                    }

                                }
                                if(serviceId == val.id){
                                    $('#service').append('<option value="' + val.id + '" selected>' + val.service_title + '</option>');
                                }else{
                                    $('#service').append('<option value="' + val.id + '">' + val.service_title + '</option>');
                                }

                            });
                            let serviceIdForDetails = !data[0].id ? serviceId : data[0].id;
                            getServiceDetails(serviceIdForDetails);
                        }
                    }
                })
            }

            function getServiceDetails(ser_id) {
                $.ajax({
                    type: "get",
                    data: {ser_id: ser_id},
                    url: "{{ route('user.service_id') }}",
                    success: function (data) {

                        var price = (data.user_rate) ?? data.price

                        $('.service_name').val(data.service_title);
                        $('.minimum_amount').val(data.min_amount);
                        $('.maximum_amount').val(data.max_amount);
                        $('.price_per').val(price);
                        $('.description').val(data.description);

                        if (data.drip_feed == 0) {
                            $('.drip_feed').css("display", "none");
                        } else {
                            $('.drip_feed').css("display", "block");
                        }

                    }
                });
            }

            var total = 1;
            $(document).on('change keyup', '#quantity,#runs', function () {
                var quan = $('#quantity').val();
                var run = $('#runs').val();
                var total = quan * run;
                $('.total_quantity').val(total);

            });

            $(document).on('change click', '#status', function () {
                var re = $('#status').is(":checked");
                if (re == true) {
                    $('.drip_feed_check').css("display", "none");
                } else {
                    $('.drip_feed_check').css("display", "block");
                }
            });

            $(document).on('change keyup', '#quantity', function () {
                var quan = parseInt($('#quantity').val());
                var pri = parseFloat($('.price_per').val());
                var total = ((quan/1000) * pri).toFixed(2);
                $('#price').val(total);
            });

        });
    </script>
@endpush

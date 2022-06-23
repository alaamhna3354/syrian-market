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
            <div class="col-md-12">
                <div class="card card-order">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title shadow-h text-white mb-3">@lang('Add new')</h4>
                                <form class="form un-form" method="post" action="{{route('user.order.store')}}" enctype="multipart/form-data" id="oederform">
                                    @csrf
                                    <div class="form-group">
                                        <label class="shadow-h text-white control-label" for="category_id">@lang('Category')</label>
                                        <select id="category" class="form-control" name="category" required>
                                            <option value="0" hidden>@lang('Select Category')</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : (isset($selectService) && $selectService->category_id == $category->id ? 'selected ' : '')  }}>@lang($category->category_title)</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('category'))
                                            <div class="error text-danger">@lang($errors->first('category')) </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="shadow-h text-white control-label " for="service_id">@lang('Service')</label>
                                        <select id="service" class="form-control" name="service" required>
                                        </select>
                                        @if($errors->has('service'))
                                            <div class="error text-danger">@lang($errors->first('service'))</div>
                                        @endif
                                    </div>

                                    <div class="form-group ">
                                        <label"form-group drip_feed">
                                                    <label class="shadow-h text-white ">@lang('Link')</label>
                                        <input type="text" name="link" value="{{ old('link') }}"
                                               placeholder="Player ID" class="form-control" required>
                                        @if($errors->has('link'))
                                            <div class="error text-danger">@lang($errors->first('link'))</div>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label class="form-group drip_feed">
                                                    <label class="shadow-h text-white ">@lang('Quantity')</label>
                                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') ?? 1}}" 
                                               class="form-control">
                                        @if($errors->has('quantity'))
                                            <div class="error text-danger"> @lang($errors->first('quantity')) </div>
                                        @endif
                                    </div>

                                    <div class="form-group drip_feed" style="{{ old('runs') || old('interval')  || $errors->has('runs') || $errors->has('interval') ? '' : 'display: none;' }}">
                                        <label>@lang('Drip-feed')</label>
                                        <div class="custom-switch-btn w-md-25">
                                            <input type="checkbox" name="drip_feed" class="custom-switch-checkbox dripfeed" 
                                                   id="status" value="0" {!!  old('runs') || old('interval') || $errors->has('runs') || $errors->has('interval') ? '' : 'checked="false"' !!}>
                                            <label class="shadow-h text-white custom-switch-checkbox-label" for="status">
                                                <span class="custom-switch-checkbox-inner"></span>
                                                <span class="custom-switch-checkbox-switch"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="drip_feed_check" style="{{ old('runs') || old('interval')  || $errors->has('runs') || $errors->has('interval') ? '' : 'display: none;' }}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group drip_feed">
                                                    <label class="shadow-h text-white ">@lang('Runs')</label>
                                                    <input type="number" id="runs" name="runs" class="form-control" value="{{ old('runs') }}" >
                                                    @if($errors->has('runs'))
                                                        <div class="error text-danger">@lang($errors->first('runs'))</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group drip_feed">
                                                    <label class="shadow-h text-white ">@lang('Interval (in minutes)')</label>
                                                    <input type="number" name="interval" class="form-control" value="{{ old('interval') }}" >
                                                    @if($errors->has('interval'))
                                                        <div class="error text-danger">@lang($errors->first('interval'))</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group drip_feed">
                                            <label class="shadow-h text-white ">@lang('Total Quantity')</label>
                                            <input type="text" class="form-control total_quantity" name="total_quantity"
                                                   disabled >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group price">
                                                <label class="shadow-h text-white">@lang('Price')</label>
                                                <input type="number" id="price" name="price" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input style="margin-inline-start: 0px;position: relative;"
                                        type="checkbox" class="form-check-input agree" id="agree" name="check" required>
                                        <label class="shadow-h text-white form-check-label" 
                                               for="agree">@lang('Yes, i have confirmed the order!')</label>
                                        @if($errors->has('check'))
                                            <div class="error text-danger">@lang($errors->first('check')) </div>
                                        @endif
                                    </div>
                                    <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                                        <button disabled type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3 place_order"><span>@lang('Place Order')</span></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="card-title shadow-h text-white mb-3">@lang('Order Resume')</h4>
                                <form class="form" id="formDescription">
                                    <div class="form-group ">
                                        <label class="shadow-h text-white ">@lang('Service name')</label>
                                        <input type="text" class="form-control service_name" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group ">
                                                <label class="shadow-h text-white ">@lang('Minimum Amount')</label>
                                                <input class="form-control minimum_amount" name="min_amount" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group ">
                                                <label class="shadow-h text-white ">@lang('Maximum Amount')</label>
                                                <input type="text" class="form-control maximum_amount" name="max_amount" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group ">
                                                <label class="shadow-h text-white ">@lang("Price")</label>
                                                <input type="text" class="form-control price_per" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="shadow-h text-white ">@lang('Description')</label>
                                        <textarea class="form-control description" disabled rows="12"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        "use strict";
        // fun 1
        $(".agree").on("click", function() {
            if(  $('#oederform')[0].checkValidity()){
                $('.place_order').removeAttr("disabled");
            }
            else{
                $('.place_order').attr("disabled","");
            }
        });
    </script>
@endpush
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

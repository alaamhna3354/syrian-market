@extends('admin.layouts.app')
@section('title')
    @lang('Edit Order')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <form method="post" action="{{route('admin.order.update',$order->id)}}" enctype="multipart/form-data">

                @csrf
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label" for="category_id">@lang('Category')</label>
                            <select class="form-control" id="category" name="category_id" disabled>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{ ($order->category_id == $category->id) ? 'selected' : ''}}>{{ $category->category_title  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>@lang('Quantity')</label>
                            <input type="number" name="quantity" id="quantity" value="{{ $order->quantity }}"
                                   class="form-control" disabled>
                            <div class="invalid-feedback">@lang('Please fill in the link')</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="service_id">@lang('Service')</label>
                            <select class="form-control" name="service_id" id="service" disabled>
                                @foreach($category->service as $service)
                                    <option
                                        value="{{$service->id}}" {{ ($order->service_id == $service->id) ? 'selected' : '' }} >{{ $service->service_title  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>@lang('Runs')</label>
                            <input type="number" name="runs" value="{{ old('link',$order->runs) }}" placeholder="runs"
                                   class="form-control runs" disabled>
                            <div class="invalid-feedback">@lang('Please fill in the link')</div>
                        </div>
                        <div class="form-group ">
                            <label>@lang('Start Counter')</label>
                            <input type="number" name="start_counter" value="{{ old('link',$order->start_counter) }}"
                                   placeholder="start counter" class="form-control" disabled>
                            <div class="invalid-feedback">@lang('Please fill in the link')</div>
                        </div>

                        <div class="form-group ">
                            <label>@lang('Status Description')</label>
                            <textarea class="form-control" disabled>{{ $order->status_description }}</textarea>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('Link')</label>
                            <input type="text" name="link" value="{{ old('link',$order->link) }}"
                                   placeholder="www.example.com/your_profile_identity" class="form-control">
                        </div>

                        <div class="form-group ">
                            <label>@lang('Interval')</label>
                            <input type="number" name="interval" value="{{ old('interval',$order->interval) }}"
                                   placeholder="interval" class="form-control" disabled>
                            <div class="invalid-feedback">@lang('Please fill in the link')</div>
                        </div>
                        <div class="form-group ">
                            <label>@lang('Remains')</label>
                            <input type="number" name="remains" value="{{ old('remains',$order->remains) }}"
                                   placeholder="remains" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Start counter')</label>
                                    <input class="form-control" type="number" name="start_counter" id="start_counter"
                                           value="{{ old('start_counter',$order->start_counter) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('API Order ID')</label>
                                    <input class="form-control" type="text" name="api_order_id" id="api_order_id"
                                           value="{{ old('api_order_id',$order->api_order_id) }}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>@lang('Change Status')</label>
                            <select class="form-control" id="status" name="status">
                                <option value="{{$order->status}}" disabled selected>
                                    @if($order->status=='awaiting') {{'Awaiting'}}
                                    @elseif($order->status == 'pending') {{'Pending'}}
                                    @elseif($order->status == 'processing') {{'Processing'}}
                                    @elseif($order->status == 'progress') {{'In progress'}}
                                    @elseif($order->status == 'completed') {{'Completed'}}
                                    @elseif($order->status == 'partial') {{'Partial'}}
                                    @elseif($order->status == 'canceled') {{'Canceled'}}
                                    @elseif($order->status == 'refunded') {{'Refunded'}}
                                    @endif
                                </option>
                                <option value="awaiting">@lang('Awaiting')</option>
                                <option value="pending">@lang('Pending')</option>
                                <option value="processing">@lang('Processing')</option>
                                <option value="progress">@lang('In progress')</option>
                                <option value="completed">@lang('Completed')</option>
                                <option value="partial">@lang('Partial')</option>
                                <option value="canceled">@lang('Canceled')</option>
                                <option value="refunded">@lang('Refunded')</option>
                            </select>
                            <div class="invalid-feedback">@lang('Please fill in the Service Type')</div>
                        </div>
                        <div class="form-group ">
                            <label>@lang('Note')</label>
                            <textarea class="form-control" name="reason">{{ $order->reason }}</textarea>
                        </div>

                    </div>

                </div>

                <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">

                    <button type="submit" class=" btn  btn-primary btn-block mt-3">
                        <span>@lang('Submit')</span></button>
                </div>

            </form>

        </div>
    </div>
@endsection
@push('extra-script')
    <script>
        "use strict";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#category').on('change', function (e) {
                let cat_id = $('option:selected', this).val();
                // console.log(cat_id)
                $.ajax({
                    url: "{{ route('admin.service') }}",
                    type: "POST",
                    data: {cat_id: cat_id},
                    success: function (data) {
                        $('#service').html('');
                        if (data.length) {
                            $(data).each(function (key, val) {
                                if (key == 0) {
                                    $('#service').append('<option value="" disabled selected>Select Service</option>');
                                }
                                $('#service').append('<option value="' + val.id + '">' + val.service_title + '</option>');
                            });
                        }
                    }
                })
            });

        });
    </script>
@endpush

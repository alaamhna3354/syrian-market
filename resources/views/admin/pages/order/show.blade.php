@extends('admin.layouts.app')
@section('title')
    @lang($page_title)
@endsection
@section('content')
    @include('admin.pages.order.partials.search-bar')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        {{--<th scope="col" class="text-center">--}}
                        {{--<input type="checkbox" class="form-check-input check-all tic-check" name="check-all"--}}
                        {{--id="check-all">--}}
                        {{--<label for="check-all"></label>--}}
                        {{--</th>--}}
                        <th scope="col" style="width: 5%">@lang('Order No.')</th>
                        <th scope="col" style="width: 10%">@lang('User')</th>
                        <th scope="col" style="width: 15%">@lang('Order Details')</th>
                        <th scope="col" style="width: 15%">@lang('Service Details')</th>
                        <th scope="col" style="width: 10%">@lang('Codes')</th>
                        <th scope="col" style="width: 15%">@lang('Details')</th>
                        <th scope="col" style="width: 10%">@lang('Created')</th>
                        <th scope="col" style="width: 10%">@lang('Status')</th>
                        <th scope="col" style="width: 10%">@lang('Balance')</th>
                        <th scope="col" style="width: 10%">@lang('Execution Time')</th>
                        @if(auth()->user()->role=='Super' || auth()->user()->role=='Admin')
                            <th scope="col" style="width: 10%">@lang('Executed By')</th>
                        @endif
                        <th scope="col" style="width: 5%">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr @if($order->agree ==1) style="background: red" @endif>
                            {{--<td class="text-center">--}}
                            {{--<input type="checkbox" id="chk-{{ $order->id }}"--}}
                            {{--class="form-check-input row-tic tic-check"--}}
                            {{--name="check" value="{{ $order->id }}" data-id="{{ $order->id }}">--}}
                            {{--<label for="chk-{{ $order->id }}"></label>--}}
                            {{--</td>--}}
                            <td data-label="@lang('Order No.')">{{$order->id}}</td>
                            <td data-label="@lang('User')">
                                <a href="{{route('admin.user-edit',$order->user_id)}}" target="_blank">
                                    @lang(optional($order->users)->username)
                                </a>
                            </td>

                            <td data-label="@lang('Order Details')">


                                <h5>@lang(optional($order->service)->service_title) </h5>
                                @lang('Link'): @lang($order->link)<br>
                                @lang('Quantity'): @lang($order->quantity)<br>
                                {{--@lang('Start counter'):<br>--}}
                                {{--@lang('Start counter'):--}}
                                {{--<br>--}}
                                <span
                                    onclick="copy('{{$order->service->service_title}} \n @lang('Link'): @lang($order->link)\n @lang('Quantity'): @lang($order->quantity)  \n @lang('Category'): @lang(optional(@$order->service)->category->category_title)')">
                                    <i class="fa fa-copy" style="font-size: 25px;"></i>
                                </span>
                            </td>

                            <td data-label="@lang('Service Details')">
                                <h5>@lang(optional($order->service)->service_title) </h5>
                                @lang('Category'): @lang(optional($order->service)->category->category_title)<br>
                                @lang('order price'): {{$order->price}} {{config('basic.currency_symbol')}}<br>
                                @lang('service price'): {{$order->service->price}} {{config('basic.currency_symbol')}}
                                <br>

                            </td>

                            <td data-label="@lang('Codes')">{{$order->code}}</td>
                            <td data-label="@lang('Details')">{!!  $order->details!!}</td>
                            <td data-label="@lang('Created')">{{dateTime($order->created_at , 'd M Y, h:i A')}} </td>
                            <td data-label="@lang('Status')">
                                @if($order->status=='awaiting')
                                    <span
                                        class="badge badge-pill badge-warning">{{'Awaiting'}}</span>
                                @elseif($order->status == 'pending')
                                    <span
                                        class="badge badge-pill badge-info">{{'Pending'}}</span>
                                @elseif($order->status == 'processing')
                                    <span
                                        class="badge badge-pill badge-info">{{'Processing'}}</span>
                                @elseif($order->status == 'progress')
                                    <span
                                        class="badge badge-pill badge-warning">{{'In progress'}}</span>
                                @elseif($order->status == 'completed')
                                    <span
                                        class="badge badge-pill badge-success">{{'Completed'}}</span>
                                @elseif($order->status == 'partial')
                                    <span
                                        class="badge badge-pill badge-warning">{{'Partial'}}</span>
                                @elseif($order->status == 'canceled')
                                    <span
                                        class="badge badge-pill badge-danger">{{'Canceled'}}</span>
                                @elseif($order->status == 'refunded')
                                    <span
                                        class="badge badge-pill badge-danger">{{'Refunded'}}</span>
                                @elseif($order->status == 'code-waiting')
                                    <span
                                        class="badge badge-pill badge-danger">{{'Waiting for Code'}}</span>
                                @endif
                            </td>
                            @if($order->balance_before)
                                <td data-label="@lang('Balance')">@lang('Before :'){{$order->balance_before }} <br>
                                    @lang('After :'){{$order->balance_after }}
                                </td>
                            @endif
                            <td data-label="@lang('Execution Time')">{{$order->execution_time ? $order->execution_time. ' '. __('Second') : ' '}} </td>
                            @if(auth()->user()->role=='Super' || auth()->user()->role=='Admin')
                                <td data-label="@lang('Executed by')">{{ @$order->admin->name }} </td>
                            @endif
                            <td data-label="@lang('Action')">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item"
                                           href="{{ route('admin.order.edit',[$order->id]) }}"><i
                                                class="fa fa-edit text-warning pr-2"
                                                aria-hidden="true"></i> @lang('Edit')
                                        </a>
                                        <a href="javascript:void(0)" class="dropdown-item status-change"
                                           data-toggle="modal"
                                           data-target="#statusMoldal"
                                           data-route="{{ route('admin.order.status.change',['id'=>$order->id] ) }} ">
                                            <i class="fa fa-check pr-2 text-success"
                                               aria-hidden="true"></i> @lang('Change Status')
                                        </a>
                                        @if(auth()->user()->role!='SellMan')
                                            <a href="javascript:void(0)" class="dropdown-item delete-order"
                                               data-toggle="modal"
                                               data-target="#deleteModal"
                                               data-route="{{ route('admin.order.destroy',[$order->id])}} ">
                                                <i class="fa fa-trash-alt pr-2 text-danger"
                                                   aria-hidden="true"></i> @lang('Delete')
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $orders->appends($_GET)->links() }}
            </div>
        </div>
    </div>
    @include('admin.pages.order.partials.modal')
@endsection
@push('js-lib')
    <script src="{{ asset('assets/global/js/jquery-ui.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            "use strict";
            var status;
            $(document).on('click', '#check-all', function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
            $(document).on('change', ".row-tic", function () {
                let length = $(".row-tic").length;
                let checkedLength = $(".row-tic:checked").length;
                if (length == checkedLength) {
                    $('#check-all').prop('checked', true);
                } else {
                    $('#check-all').prop('checked', false);
                }
            });

            $(document).on('click', '.status-change', function () {
                let route = $(this).data('route');
                $('#statusForm').attr('action', route);
            });

            $(document).on('click', '.delete-order', function () {
                let route = $(this).data('route');
                $('#deleteConfirm').attr('action', route);
            });

            $(document).on('click', '.dropdown-menu', function (e) {
                e.stopPropagation();
            });


            //all checked click function

            $(document).on('click', '.usersOrderChangeStatus', function () {
                status = $(this).data('status');
                $('.text-status').text(status)
            });

            $(document).on('click', '.awaiting-yes', function (e) {
                e.preventDefault();
                var allVals = [];

                $(".row-tic:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });


                var strIds = allVals.join(",");


                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{ route('admin.usersOrderChangeStatus') }}",
                    data: {
                        strIds,
                        status
                    },
                    datatType: 'json',
                    type: "get",
                    success: function (data) {
                        location.reload();
                    }
                });
            })

        });

        function copy($link) {
            /* Copy the text inside the text field */
            console.log($link)
            navigator.clipboard.writeText($link);

            Toastify({
                text: "تم النسخ",
                duration: 3000
            }).showToast();
        }

    </script>
@endpush

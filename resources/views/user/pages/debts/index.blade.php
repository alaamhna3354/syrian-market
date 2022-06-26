@extends('user.layouts.app')
@section('title',__('Debts'))
@section('content')


    <div class="container px-3 user-service-list ">
        <div class="row my-3 justify-content-between">
            <div class="col-md-6">
                <ol class="breadcrumb center-items">
                    <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="active">@lang('Debt List')</li>
                </ol>

                {{--                <div class="card my-3">--}}
                {{--                    <div class="card-body">--}}
                {{--                        <form action="{{ route('agent.debt.search') }}" method="get">--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-md-3">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <input type="text" name="debt_id" value="{{@request()->debt_id}}"--}}
                {{--                                               class="form-control"--}}
                {{--                                               placeholder="@lang('Debt ID')">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-md-3">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <input type="text" name="user" value="{{@request()->user}}"--}}
                {{--                                               class="form-control get-service"--}}
                {{--                                               placeholder="@lang('User')">--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                                <div class="col-md-2">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <select name="status" class="form-control">--}}
                {{--                                            <option value="-1"--}}
                {{--                                                    @if(@request()->status == '-1') selected @endif>@lang('All Status')</option>--}}
                {{--                                            <option value="0"--}}
                {{--                                                    @if(@request()->status == 0) selected @endif>@lang('Active')</option>--}}
                {{--                                            <option value="1"--}}
                {{--                                                    @if(@request()->status == 1) selected @endif>@lang('Inactive')</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                                <div class="col-md-2">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <input type="date" class="form-control" name="date_time" id="datepicker"/>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                                <div class="col-md-2">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <button type="submit" class="btn waves-effect waves-light w-100 btn-primary"><i--}}
                {{--                                                class="fas fa-search"></i> @lang('Search')</button>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb center-items">
                    <li style="color: #000000">@lang('Total')</li>
                    <li class="active">{{auth()->user()->debt}} {{config('basic.currency_symbol')}}</li>
                </ol>
            </div>
        </div>


        <div class="row my-3 justify-content-between align-items-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body pb-4">


                        <div class="table-responsive ">
                            <table class="categories-show-table table table-striped text-center ">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('Debt ID')</th>
                                    <th scope="col" class="order-details-column text-left">@lang('Debt')</th>
                                    <th scope="col">@lang('Order')</th>
                                    <th scope="col">@lang('Debt AT')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Is Paid')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($debts as $key => $debt)
                                    <tr>
                                        <td data-label="@lang('Debt ID')"> {{$debt->id}} </td>
                                        <td data-label="@lang('Debt')">
                                            <h5>{{$debt->debt}} @lang(config('basic.currency'))</h5>
                                        </td>

                                        <td data-label="@lang('Order')">
                                            @if($debt->order_id != 0)
                                                {{$debt->order->id}}
                                            @else
                                                @if($debt->despite == 0)
                                                    @lang('From Agent')
                                                @else
                                                    @lang('To Agent')
                                                @endif
                                            @endif
                                        </td>

                                        <td data-label="@lang('Debt AT')">@lang(dateTime($debt->created_at, 'd/m/Y - h:i A' ))</td>

                                        <td data-label="@lang('Status')">
                                <span
                                    class="badge badge-pill {{ $debt->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $debt->status == 0 ? 'Inactive' : 'Active' }}</span>
                                        </td>
                                        <td data-label="@lang('Is Paid')">
                                <span
                                    class="badge badge-pill {{ $debt->despite == 0 ? 'badge-danger' : 'badge-success' }}">{{ $debt->despite == 0 ? 'Not Paid' : 'Paid' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--                    <!-- {{ $debts->appends($_GET)->links() }} -->--}}

                    </div>
                </div>
            </div>
        </div>

    </div>




    <div id="infoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-colored-header" style="background-color: #fe5917;">
                    <h5 class="modal-title">@lang('Note')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="info-reason"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn waves-effect waves-light btn-dark"
                            data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="description">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header modal-colored-header" style="background-color: #fe5917;">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="servicedescription">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <a href="" type="submit" class="btn btn-primary order-now">@lang('Order Now')</a>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        'use strict';
        $(document).on('click', '.infoBtn', function () {
            var modal = $('#infoModal');
            var id = $(this).data('service_id');
            var orderRoute = "{{route('agent.order.create')}}" + '?serviceId=' + id;
            $('.order-now').attr('href', orderRoute);
            modal.find('.info-reason').html($(this).data('reason'));
        });

        $(document).on('click', '#details', function () {
            var title = $(this).data('servicetitle');
            var id = $(this).data('service_id');

            var orderRoute = "{{route('agent.order.create')}}" + '?serviceId=' + id;
            $('.order-now').attr('href', orderRoute);

            var description = $(this).data('description');
            $('#title').text(title);
            $('#servicedescription').text(description);
        });
    </script>
@endpush

@extends('admin.layouts.app')
@section('title')
    @lang($user->username)
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">@lang('User Order') (<a
                        href="{{ route('admin.user-edit',$user->id) }}" target="_blank">@lang($user->username)</a>) </h4>
            </div>
        </div>
    </div>

    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form method="GET" action="{{ route('admin.user-order-search') }}">
                    <div class="row">
                        <input name="user_id" value="{{ @$userid }}" hidden>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="search" value="{{@request()->search}}"
                                       class="form-control get-service"
                                       placeholder="@lang('Type Here')">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="-1"
                                            @if(@request()->status == '-1') selected @endif>@lang('All')</option>
                                    <option value="awaiting"
                                            @if(@request()->status == 'awaiting') selected @endif>@lang('Awaiting')</option>
                                    <option value="pending"
                                            @if(@request()->status == 'pending') selected @endif>@lang('Pending')</option>
                                    <option value="processing"
                                            @if(@request()->status == 'processing') selected @endif>@lang('Processing')</option>
                                    <option value="progress"
                                            @if(@request()->status == 'progress') selected @endif>@lang('In Progress')</option>
                                    <option value="completed"
                                            @if(@request()->status == 'completed') selected @endif>@lang('Completed')</option>
                                    <option value="partial"
                                            @if(@request()->status == 'partial') selected @endif>@lang('Partial')</option>
                                    <option value="canceled"
                                            @if(@request()->status == 'canceled') selected @endif>@lang('Cancelled')</option>
                                    <option value="refunded"
                                            @if(@request()->status == 'refunded') selected @endif>@lang('Refunded')</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_order" id="datepicker"/>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100"><i
                                        class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">

        <div class="card-body">
            <div class="dropdown mb-2 text-right">
                <button class="btn btn-sm btn-swap dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><i class="fas fa-bars pr-2"></i> @lang('Action')</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="awaiting">@lang('Awaiting')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus usersOrderChangeStatus"
                            data-status="pending">@lang('Pending')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="processing">@lang('Processing')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="progress">@lang('In Progress')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="completed">@lang('Completed')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="partial">@lang('Partial')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="canceled">@lang('Canceled')</button>
                    <button class="dropdown-item usersOrderChangeStatus" type="button" data-toggle="modal"
                            data-target="#usersOrderChangeStatus" data-status="refunded">@lang('Refunded')</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col" class="text-center">
                            <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                   id="check-all">
                            <label for="check-all"></label>
                        </th>
                        <th scope="col">@lang('Order No.')</th>
                        <th scope="col">@lang('User')</th>
                        <th scope="col">@lang('Order Details')</th>
                        <th scope="col">@lang('Created')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($user->order as $order)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" id="chk-{{ $order->id }}"
                                       class="form-check-input row-tic tic-check"
                                       name="check" value="{{ $order->id }}" data-id="{{ $order->id }}">
                                <label for="chk-{{ $order->id }}"></label>
                            </td>
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
                                @lang('Start counter'):<br>
                                @lang('Start counter'):
                            </td>
                            <td data-label="@lang('Created')">{{dateTime($order->created_at , 'd/m/Y')}} </td>
                            <td data-label="@lang('Status')">
                                @if($order->status=='awaiting') <span
                                    class="badge badge-pill badge-danger">{{'Awaiting'}}</span>
                                @elseif($order->status == 'pending') <span
                                    class="badge badge-pill badge-info">{{'Pending'}}</span>
                                @elseif($order->status == 'processing') <span
                                    class="badge badge-pill badge-info">{{'Processing'}}</span>
                                @elseif($order->status == 'progress') <span
                                    class="badge badge-pill badge-warning">{{'In progress'}}</span>
                                @elseif($order->status == 'completed') <span
                                    class="badge badge-pill badge-success">{{'Completed'}}</span>
                                @elseif($order->status == 'partial') <span
                                    class="badge badge-pill badge-warning">{{'Partial'}}</span>
                                @elseif($order->status == 'canceled') <span
                                    class="badge badge-pill badge-danger">{{'Canceled'}}</span>
                                @elseif($order->status == 'refunded') <span
                                    class="badge badge-pill badge-danger">{{'Refunded'}}</span>
                                @endif
                            </td>
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

                                        <a href="javascript:void(0)" class="dropdown-item status-change" data-toggle="modal"
                                           data-target="#statusMoldal"
                                           data-route="{{ route('admin.order.status.change',['id'=>$order->id] ) }} ">
                                            <i class="fa fa-check pr-2 text-success"
                                               aria-hidden="true"></i> @lang('Change Status')
                                        </a>

                                        <form action="{{ route('admin.order.destroy',[$order->id]) }} " method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="submit-a-btn dropdown-item"><span><i
                                                        class="fas fa-trash-alt pr-2 text-danger"></i> @lang('Delete')</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="100%">@lang('No User Order Data')</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>



    @include('admin.pages.order.partials.modal')

@endsection
@push('js-lib')
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


            //all checked click function

            $(document).on('click', '.usersOrderChangeStatus', function () {
                status = $(this).data('status');
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
                        // console.log(data)

                        location.reload();
                    }
                });
            })


            //dropdown menu is not working
            $(document).on('click', '.dropdown-menu', function (e) {
                e.stopPropagation();
            });

        });
    </script>
@endpush


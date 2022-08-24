@extends('agent.layouts.app')
@section('title',__('Orders'))
@section('content')


    <div class="container px-3 user-service-list ">
        <div class="row my-3 justify-content-between">
            <div class="col-md-12">
                <ol class="breadcrumb center-items">
                    <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="active">@lang('Order List')</li>
                </ol>

                <div class="card my-3">
                    <div class="card-body">
                        <form action="{{ route('agent.users.debtSearch') }}" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="user_name" value="{{@request()->user_name}}"
                                               class="form-control"
                                               placeholder="@lang('Username')">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn waves-effect waves-light w-100 btn-primary"><i
                                                class="fas fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-3 justify-content-between align-items-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body pb-4">

                        @foreach(auth()->user()->children as $user)
                            <div class="row">
                                <div class="col-md-6">
                                    <ol class="breadcrumb center-items">
                                        <li class="active">@lang($user->username)</li>
                                    </ol>
                                </div>
                                <div class="col-md-6">
                                    <ol class="breadcrumb center-items">
                                        <li style="color: #000000">@lang('Total')</li>
                                        <li class="active">{{$user->debts()->where('despite' , 0)->sum('debt') - $user->debts()->where('despite' , 1)->sum('debt')}}</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="categories-show-table table table-hover table-striped table-bordered">
                                    <thead class="thead-primary">
                                    <tr>

                                        <th scope="col">@lang('Debt ID')</th>
                                        <th scope="col" class="order-details-column text-left">@lang('Debt')</th>
                                        <th scope="col">@lang('Order')</th>
                                        <th scope="col">@lang('User')</th>
                                        <th scope="col">@lang('Debt AT')</th>
                                        <th scope="col">@lang('Details')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->debts()->get() as $debt)
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
                                                        @if($debt->is_for_admin == 1)
                                                            @lang('From Admin')
                                                        @else
                                                            @lang('From Agent')
                                                        @endif
                                                    @else
                                                        @lang('To Agent')
                                                    @endif
                                                @endif
                                            </td>
                                            <td data-label="@lang('User')">@lang($debt->user->username)</td>

                                            <td data-label="@lang('Debt AT')">@lang(dateTime($debt->created_at, 'd/m/Y - h:i A' ))</td>

                                            <td data-label="@lang('Details')">
                                <span
                                    class="badge badge-pill {{ $debt->despite == 0 ? 'badge-danger' : 'badge-success' }}">{{ $debt->despite == 0 ? 'دين' : 'دفعة دين' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--                    {{ $orders->appends($_GET)->links() }}--}}
                            </div>
                        <div class="clearfix"></div>
                         {{ $user->debts()->latest()->paginate(config('basic..paginate'))->appends($_GET)->links() }}
                        @endforeach
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
            var orderRoute = "{{route('user.order.create')}}" + '?serviceId=' + id;
            $('.order-now').attr('href', orderRoute);
            modal.find('.info-reason').html($(this).data('reason'));
        });

        $(document).on('click', '#details', function () {
            var title = $(this).data('servicetitle');
            var id = $(this).data('service_id');

            var orderRoute = "{{route('user.order.create')}}" + '?serviceId=' + id;
            $('.order-now').attr('href', orderRoute);

            var description = $(this).data('description');
            $('#title').text(title);
            $('#servicedescription').text(description);
        });
    </script>
@endpush

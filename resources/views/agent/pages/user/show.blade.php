@extends('agent.layouts.app')
@section('title',__('Users'))
@section('content')


    <div class="container px-3 user-service-list ">
        <div class="row my-3 justify-content-between">
            <div class="col-md-12">
                <ol class="breadcrumb center-items">
                    <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="active">@lang('Users List')</li>
                </ol>

                <div class="card my-3">
                    <div class="card-body" >
                        <form action="{{ route('agent.users.search') }}" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="username" value="{{@request()->username}}"
                                               class="form-control"
                                               placeholder="@lang('Username')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="email" value="{{@request()->email}}" class="form-control"
                                               placeholder="@lang('Email Address')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="phone" value="{{@request()->phone}}" class="form-control"
                                               placeholder="@lang('Phone Number')">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="date_time" id="datepicker"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="">@lang('All User')</option>
                                            <option value="1"
                                                    @if(@request()->status == '1') selected @endif>@lang('Active User')</option>
                                            <option value="0"
                                                    @if(@request()->status == '0') selected @endif>@lang('Inactive User')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn w-100 btn-primary"><i
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


                        <div class="table-responsive ">
                            <table class="categories-show-table table table-striped text-center ">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('No.')</th>
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('Email')</th>
                                    <th scope="col">@lang('Phone')</th>
                                    <th scope="col">@lang('Balance')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td data-label="@lang('No.')">{{loopIndex($users) + $loop->index	 }}</td>
                                        <td data-label="@lang('Username')">@lang($user->username)</td>
                                        <td data-label="@lang('Email')">@lang($user->email)</td>
                                        <td data-label="@lang('Phone')">@lang(($user->phone)? : 'N/A')</td>
                                        <td data-label="@lang('Balance')">{{getAmount($user->balance, config('basic.fraction_number'))}} {{trans(config('basic.currency'))}}</td>
                                        <td data-label="@lang('Status')">
                                <span
                                    class="badge badge-pill {{ $user->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $user->status == 0 ? 'Inactive' : 'Active' }}</span>
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a class="" href="{{ route('agent.user.edit',$user->id) }}">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i>
                                            </a>
{{--                                            <div class="dropdown show">--}}
{{--                                                <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"--}}
{{--                                                   aria-haspopup="true" aria-expanded="false">--}}
{{--                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>--}}
{{--                                                </a>--}}
{{--                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
{{--                                                    --}}
{{--                                                    <a class="dropdown-item" href="{{ route('admin.user.customRate',$user->id) }}">--}}
{{--                                                        <i class="fa fa-money-bill-alt text-dark pr-2"--}}
{{--                                                           aria-hidden="true"></i> @lang('Custom Rate')--}}
{{--                                                    </a>--}}

{{--                                                    <a class="dropdown-item" href="{{ route('admin.user-order',$user->id) }}">--}}
{{--                                                        <i class="fa fa-eye text-info pr-2" aria-hidden="true"></i> @lang('Order')--}}
{{--                                                    </a>--}}
{{--                                                    <a class="dropdown-item" href="{{ route('admin.send-email',$user->id) }}">--}}
{{--                                                        <i class="fa fa-envelope text-success pr-2"--}}
{{--                                                           aria-hidden="true"></i> @lang('Send Email')--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

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

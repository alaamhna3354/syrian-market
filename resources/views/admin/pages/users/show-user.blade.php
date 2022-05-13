@extends('admin.layouts.app')
@section('title')
    @lang("User List")
@endsection


@section('content')
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="{{ route('admin.users.search') }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="username" value="{{@request()->username}}" class="form-control"
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


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <div class="dropdown mb-2 text-right">
                <button class="btn btn-sm  btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><i class="fas fa-bars pr-2"></i> @lang('Action')</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button class="dropdown-item" type="button" data-toggle="modal"
                            data-target="#all_active">@lang('Active')</button>
                    <button class="dropdown-item" type="button" data-toggle="modal"
                            data-target="#all_inactive">@lang('Inactive')</button>
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
                    @forelse($users as $user)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" id="chk-{{ $user->id }}"
                                       class="form-check-input row-tic tic-check" name="check" value="{{$user->id}}"
                                       data-id="{{ $user->id }}">
                                <label for="chk-{{ $user->id }}"></label>
                            </td>
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
                                <div class="dropdown show">
                                    <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('admin.user-edit',$user->id) }}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Edit')
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.user.customRate',$user->id) }}">
                                            <i class="fa fa-money-bill-alt text-dark pr-2"
                                               aria-hidden="true"></i> @lang('Custom Rate')
                                        </a>

                                        <a class="dropdown-item" href="{{ route('admin.user-order',$user->id) }}">
                                            <i class="fa fa-eye text-info pr-2" aria-hidden="true"></i> @lang('Order')
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.send-email',$user->id) }}">
                                            <i class="fa fa-envelope text-success pr-2"
                                               aria-hidden="true"></i> @lang('Send Email')
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="9">@lang('No User Data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$users->appends(@$_GET)->links()}}

            </div>
        </div>
    </div>




    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('Active User Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        ×
                    </button>
                </div>

                <div class="modal-body">

                    <p>@lang("Are you really want to active the User's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary active-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_inactive" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('DeActive User Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        ×
                    </button>
                </div>

                <div class="modal-body">
                    <p>@lang("Are you really want to Inactive the User's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary inactive-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')
    <script>
        "use strict";
        $(document).ready(function () {
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

            //dropdown menu is not working
            $(document).on('click', '.dropdown-menu', function (e) {
                e.stopPropagation();
            });

            //multiple active
            $(document).on('click', '.active-yes', function (e) {
                e.preventDefault();
                var allVals = [];
                $(".row-tic:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                var strIds = allVals;

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{ route('admin.user-multiple-active') }}",
                    data: {strIds: strIds},
                    datatType: 'json',
                    type: "post",
                    success: function (data) {
                        location.reload();

                    },
                });
            });

            //multiple deactive
            $(document).on('click', '.inactive-yes', function (e) {
                e.preventDefault();
                var allVals = [];
                $(".row-tic:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                var strIds = allVals;
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{ route('admin.user-multiple-inactive') }}",
                    data: {strIds: strIds},
                    datatType: 'json',
                    type: "post",
                    success: function (data) {
                        location.reload();

                    }
                });
            });


            $('select[name=status]').select2({
                selectOnClose: true
            });

        });
    </script>
@endpush

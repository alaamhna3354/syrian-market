@extends('admin.layouts.app')
@section('title')
    @lang('Debt with admin')
@endsection
@section('content')
{{--    @include('admin.pages.order.partials.search-bar')--}}


        <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">

            <div class="card-body">

                <div class="table-responsive">
                    <table class="categories-show-table table table-hover table-striped table-bordered">
                        <thead class="thead-primary">
                        <tr>
                            <th scope="col" class="text-center">
                                <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                       id="check-all">
                                <label for="check-all"></label>
                            </th>
                            <th scope="col">@lang('Debt ID')</th>
                            <th scope="col" class="order-details-column text-left">@lang('Debt')</th>
                            <th scope="col">@lang('Order')</th>
                            <th scope="col">@lang('User')</th>
                            <th scope="col">@lang('Debt AT')</th>
                            <th scope="col">@lang('Details')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->debts()->limit(10)->get() as $debt)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" id="chk-{{ $debt->id }}"
                                           class="form-check-input row-tic tic-check"
                                           name="check" value="{{ $debt->id }}" data-id="{{ $debt->id }}">
                                    <label for="chk-{{ $debt->id }}"></label>
                                </td>
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
            </div>
            <div class="card-footer">
                <h2>@lang('Total') : {{$user->debts()->where('despite' , 0)->sum('debt') - $user->debts()->where('despite' , 1)->sum('debt')}}</h2>
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

        </script>
    @endpush

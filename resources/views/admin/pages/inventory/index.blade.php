@extends('admin.layouts.app')
@section('title')
    @lang("Inventory")
@endsection
@section('content')

    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="{{route('admin.inventory.search')}}" method="get">
                    <div class="row">


                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="user_name" value="{{@request()->user_name}}" class="form-control get-username"
                                       placeholder="@lang('Username')">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn w-100 btn-primary"><i class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




@foreach($users as $user)
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-header">
            <div class="row">
                <table class="table table table-hover table-striped ">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col" style="background-color: #000000">@lang('User Name')</th>
                        <th scope="col" style="background-color: #000000">@lang('Total')</th>
                        <th scope="col" style="background-color: #000000">@lang('User Balance')</th>
                        @if($user->is_agent == 1 && $user->is_approved == 1)
                            <th scope="col" style="background-color: #000000">@lang('User Debt For Admin')</th>
                        @else
                            <th scope="col" style="background-color: #000000">@lang('User Debt For Agent')</th>
                        @endif

                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td data-label="@lang('User Name')">
                            <a href="{{route('admin.user-edit',$user->id)}}" target="_blank">
                                @lang($user->username)
                            </a>
                        </td>
                        <td data-label="@lang('Total')">{{$user->transactions()->where('trx_type','+')->sum('amount') - $user->transactions()->where('trx_type','-')->sum('amount')}}</td>
                        <td data-label="@lang('User Balance')">{{$user->balance}}</td>
                        @if($user->is_agent == 1 && $user->is_approved == 1)
                        <td data-label="@lang('User Debt For Admin')">{{$user->debt}}</td>
                        @else
                            <td data-label="@lang('User Debt For Agent')">{{$user->debt}}</td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="categories-show-table table table-hover table-striped table-bordered">
                        <thead class="thead-primary">
                        <tr>
                            <th scope="col">@lang('No.')</th>
                            <th scope="col">@lang('TRX')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Remark')</th>
                            <th scope="col">@lang('Date - Time')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($user->transactions as $k => $row)
                            <tr>
                                <td data-label="@lang('No.')">{{loopIndex($transaction) + $k}}</td>
                                <td data-label="@lang('TRX')">@lang($row->trx_id)</td>
                                <td data-label="@lang('Amount')"> <span class="text-{{($row->trx_type == "+") ? 'success' :'danger'}}">{{config('basic.currency_symbol')}}{{getAmount($row->amount, config('basic.fraction_number'))}}</span></td>
                                <td data-label="@lang('Remark')">@lang($row->remarks)</td>
                                <td data-label="@lang('Date - Time')">{{dateTime($row->created_at, 'd M, Y h:i A')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-danger" colspan="8">@lang('No User Data')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $transaction->links() }}
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="categories-show-table table table-hover table-striped table-bordered">
                            <thead class="thead-primary">
                            <tr>
                                <th scope="col">@lang('Debt ID')</th>
                                <th scope="col">@lang('Debt')</th>
                                <th scope="col">@lang('Order')</th>
                                <th scope="col">@lang('Debt AT')</th>
                                <th scope="col">@lang('Details')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->debts()->limit(10)->get() as $debt)
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
            </div>

        </div>
        <div class="table-responsive">
        </div>
    </div>
@endforeach
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

        });
    </script>
@endpush

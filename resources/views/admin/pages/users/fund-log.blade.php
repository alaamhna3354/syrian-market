@extends('admin.layouts.app')
@section('title')
    @lang($user->name)
@endsection
@section('content')

    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <form action="{{ route('admin.payment.search') }}" method="get">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" name="name" value="{{@request()->name}}" class="form-control"
                               placeholder="@lang('Type Here')">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="-1"
                                    @if(@request()->status == '-1') selected @endif>@lang('All Payment')</option>
                            <option value="1"
                                    @if(@request()->status == '1') selected @endif>@lang('Complete Payment')</option>
                            <option value="2"
                                    @if(@request()->status == '2') selected @endif>@lang('Pending Payment')</option>
                            <option value="3"
                                    @if(@request()->status == '3') selected @endif>@lang('Cancel Payment')</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="date" class="form-control" name="date_time" id="datepicker"/>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn w-100 btn-primary"><i
                                class="fas fa-search"></i> @lang('Search')</button>
                    </div>
                </div>
            </div>
        </form>

    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col">@lang('Date')</th>
                        <th scope="col">@lang('Trx Number')</th>
                        <th scope="col">@lang('Username')</th>
                        <th scope="col">@lang('Method')</th>
                        <th scope="col">@lang('Amount')</th>
                        <th scope="col">@lang('Charge')</th>
                        <th scope="col">@lang('Payable')</th>
                        <th scope="col">@lang('Status')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($funds as $key => $fund)
                        <tr>
                            <td data-label="@lang('Date')"> {{ DateTime($fund->created_at,'d M,Y H:i') }}</td>
                            <td data-label="@lang('Trx Number')"
                                class="font-weight-bold text-uppercase">{{ $fund->transaction }}</td>
                            <td data-label="@lang('Username')"><a
                                    href="{{route('admin.user-edit', $fund->user_id)}}" target="_blank">{{ optional($fund->user)->username }}</a>
                            </td>
                            <td data-label="@lang('Method')">{{ optional($fund->gateway)->name }}</td>
                            <td data-label="@lang('Amount')"
                                class="font-weight-bold">{{ $basic->currency_symbol}}{{ getAmount($fund->amount ) }}</td>
                            <td data-label="@lang('Charge')"
                                class="text-success">{{ $basic->currency_symbol}}{{ getAmount($fund->charge)}} </td>
                            <td data-label="@lang('Payable')"
                                class="font-weight-bold">{{ getAmount($fund->final_amount) }} {{$fund->gateway_currency}}</td>


                            <td data-label="@lang('Status')">
                                @if($fund->status == 2)
                                    <span class="badge badge-warning">@lang('Pending')</span>
                                @elseif($fund->status == 1)
                                    <span class="badge badge-success">@lang('Approved')</span>
                                @elseif($fund->status == 3)
                                    <span class="badge badge-danger">@lang('Rejected')</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">
                                <p class="text-danger text-center">@lang('No Data Found')</p>
                            </td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
                {{ $funds->appends($_GET)->links() }}
            </div>
        </div>
    </div>

@endsection

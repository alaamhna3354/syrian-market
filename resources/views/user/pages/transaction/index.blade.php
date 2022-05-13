@extends('user.layouts.app')
@section('title')
    @lang('Transaction')
@endsection
@section('content')
     <div class="container-fluid px-3 user-service-list">

         <div class="row justify-content-between mx-lg-5">
             <div class="col-md-12">

                 <ol class="breadcrumb center-items">
                     <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                     <li class="active">@lang('Transaction')</li>
                 </ol>

                <div class="card my-3">
                    <div class="card-body">
                        <form action="{{route('user.transaction.search')}}" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="transaction_id" value="{{@request()->transaction_id}}" class="form-control get-trx-id"
                                               placeholder="@lang('Search for Transaction ID')">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="remark" value="{{@request()->remark}}" class="form-control get-service"
                                               placeholder="@lang('Remark')">
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="datetrx" id="datepicker"/>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn waves-effect waves-light w-100 btn-primary"><i class="fas fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
         </div>


        <div class="row my-3 justify-content-between mx-lg-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">

                            <div class="table-responsive">
                            <table class="table  table-striped " id="service-table">
                                <thead>
                                <tr>
                                    <th>@lang('SL No.')</th>
                                    <th >@lang('Transaction ID')</th>
                                    <th >@lang('Amount')</th>
                                    <th >@lang('Remarks')</th>
                                    <th>@lang('Time')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td data-label="@lang('SL No.')">{{loopIndex($transactions) + $loop->index}}</td>
                                        <td data-label="@lang('Transaction ID')">@lang($transaction->trx_id)</td>
                                        <td data-label="@lang('Amount')">
                                        <span
                                            class="font-weight-bold text-{{($transaction->trx_type == "+") ? 'success': 'danger'}}">{{($transaction->trx_type == "+") ? '+': '-'}}{{getAmount($transaction->amount, config('basic.fraction_number')). ' ' . trans(config('basic.currency'))}}</span>
                                        </td>
                                        <td data-label="@lang('Remarks')"> @lang($transaction->remarks)</td>
                                        <td data-label="@lang('Time')">
                                            {{ dateTime($transaction->created_at, 'd M Y h:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>
                            {{ $transactions->appends($_GET)->links() }}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('extra-script')
@endpush

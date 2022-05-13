@extends('admin.layouts.app')
@section('title')
    @lang("Transaction")
@endsection
@section('content')

    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="{{route('admin.transaction.search')}}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="transaction_id" value="{{@request()->transaction_id}}" class="form-control get-trx-id"
                                       placeholder="@lang('Search for Transaction ID')">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="user_name" value="{{@request()->user_name}}" class="form-control get-username"
                                       placeholder="@lang('Username')">
                            </div>
                        </div>


                        <div class="col-md-2">
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





    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <table class="categories-show-table table table-hover table-striped table-bordered">
                <thead class="thead-primary">
                <tr>
                    <th scope="col">@lang('No.')</th>
                    <th scope="col">@lang('TRX')</th>
                    <th scope="col">@lang('User Name')</th>
                    <th scope="col">@lang('Amount')</th>
                    <th scope="col">@lang('Remark')</th>
                    <th scope="col">@lang('Date - Time')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($transaction as $k => $row)
                    <tr>
                        <td data-label="@lang('No.')">{{loopIndex($transaction) + $k}}</td>
                        <td data-label="@lang('TRX')">@lang($row->trx_id)</td>
                        <td data-label="@lang('User Name')">
                            <a href="{{route('admin.user-edit',$row->user_id)}}" target="_blank">
                                @lang($row->user->username)
                            </a>
                        </td>
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
        <div class="table-responsive">
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

        });
    </script>
@endpush

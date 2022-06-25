@extends('agent.layouts.app')
@section('title')
    @lang('Fund History')
@endsection
@section('content')
     <div class="container px-3 user-service-list">



        <div class="row justify-content-between">
            <div class="col-md-12">

                <ol class="breadcrumb center-items">
                    <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="active">@lang('Fund History')</li>
                </ol>

                <div class="card my-3">
                    <div class="card-body">

                        <form action="{{ route('agent.fund-history.search') }}" method="get">
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
                                            <option value="">@lang('All Payment')</option>
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
        <div class="row my-3 justify-content-between mx-lg-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">

                            <div class="table-responsive">
                            <table class="table table-striped " id="service-table">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('Transaction ID')</th>
                                    <th scope="col">@lang('Gateway')</th>
                                    <th scope="col">@lang('Amount')</th>
                                    <th scope="col">@lang('Charge')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Time')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($funds as $data)
                                    <tr>

                                        <td data-label="#@lang('Transaction ID')">{{$data->transaction}}</td>
                                        <td data-label="@lang('Gateway')">@lang(optional($data->gateway)->name)</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{getAmount($data->amount)}} @lang($basic->currency)</strong>
                                        </td>

                                        <td data-label="@lang('Charge')">
                                            <strong>{{getAmount($data->charge)}} @lang($basic->currency)</strong>
                                        </td>

                                        <td data-label="@lang('Status')">
                                            @if($data->status == 1)
                                                <span class="badge badge-success badge-pill">@lang('Complete')</span>
                                            @elseif($data->status == 2)
                                                <span class="badge badge-warning badge-pill">@lang('Pending')</span>
                                            @elseif($data->status == 3)
                                                <span class="badge badge-danger badge-pill">@lang('Cancel')</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Time')">
                                            {{ dateTime($data->created_at, 'd M Y h:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>
                            {{ $funds->appends($_GET)->links() }}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

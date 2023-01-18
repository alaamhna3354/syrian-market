@extends('user.layouts.app')
@section('title')
    @lang('My Points')
@endsection
@section('content')
    <div class="container px-3 user-service-list order-list">
        <div class="row justify-content-between ">
            <div class="col-md-12">
                {{--<ol class="breadcrumb center-items">--}}
                {{--<li><a href="{{route('user.home')}}">@lang('Home')</a></li>--}}
                {{--<li class="active">@lang('My Points')</li>--}}
                {{--</ol>--}}

                <div class="row">
                    <div class="col-md-6 ">
                        <div class="card-header">
                            <ol class="breadcrumb center-items">
                                <li class="active"><h4>@lang('Your points balance')
                                        : {{auth()->user()->points}} @lang('Point')</h4></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn waves-effect waves-light w-100 btn-primary"
                                data-toggle="modal" id="replaceButton" data-target="#replacePoints">
                            @lang('Replace points')</button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn waves-effect waves-light w-100 btn-primary"
                                data-toggle="modal" id="howToEarnButon" data-target="#howToEarbPoints">
                            @lang('How to earn points?')</button>
                    </div>
                </div>
                <div class="card my-3">
                    <div class="card-body">
                        <form action="{{route('user.points.transactions.search')}}" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="transaction_id" value="{{@request()->transaction_id}}"
                                               class="form-control get-trx-id"
                                               placeholder="@lang('Search for Transaction ID')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="remark" value="{{@request()->remark}}"
                                               class="form-control get-service"
                                               placeholder="@lang('Remarks')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="datetrx" id="datepicker"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button style="padding: 12px 15px;margin: 0;"
                                                type="submit" class="btn waves-effect waves-light w-100 btn-primary"
                                                id="replacepoint"><i
                                                    class="fas fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-3 justify-content-between">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">

                        <div class="table-responsive">
                            <table class="table  table-striped " id="service-table">
                                <thead>
                                <tr>
                                    <th>@lang('SL No.')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Remarks')</th>
                                    <th>@lang('Time')</th>
                                    <th>@lang('Details')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pointTransactions as $transaction)
                                    <tr>
                                        <td data-label="@lang('SL No.')">{{loopIndex($pointTransactions) + $loop->index}}</td>
                                        <td data-label="@lang('Amount')">
                                        <span
                                                class="font-weight-bold text-{{$transaction->status=='active' ? 'success' : 'danger'}}">{{$transaction->amount}}</span>
                                        </td>
                                        <td data-label="@lang('Remarks')"> @lang($transaction->remarks)</td>
                                        <td data-label="@lang('Time')">
                                            {{ dateTime($transaction->created_at, 'd M Y h:i A') }}
                                        </td>
                                        <td data-label="@lang('Note')"> @lang($transaction->note)</td>
                                        <td data-label="@lang('Status')"> @lang($transaction->status)</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    <!-- {{ $pointTransactions->appends($_GET)->links() }} -->


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- small modal -->
    <div class="modal fade" id="replacePoints" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <p class="text-danger ">@lang('Every 1000 points')
                            = {{config('basic.points_rate_per_kilo') . ' ' . trans(config('basic.currency'))}}</p>
                        <h3>@lang('Your points value')
                            = {{(auth()->user()->points * config('basic.points_rate_per_kilo')/1000) . ' ' . trans(config('basic.currency'))}}</h3>
                        <div class="modal-footer">
                            <form action="{{route('user.points.replace')}}" method="post">
                                @csrf
                                @if(auth()->user()->points >= config('basic.min_points_allowed_to_replace'))
                                    <button type="submit" class="btn btn-primary ">@lang('Replace')</button>
                                    @else
                                    <p class="text-danger ">@lang('Minimum points amount allowed to transfer is') :
                                         {{config('basic.min_points_allowed_to_replace')}}  @lang('Point')</p>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How to earn points modal -->
    <div class="modal fade" id="howToEarbPoints" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div class="card card-primary">
                        <div class="card-header">
                            <ol class="breadcrumb center-items">
                                <li class="active">{{$pointsSection->description->title}}</li>
                            </ol>
                        </div>
                        <div class="card-body" style="background: #000;color: white">
                            {!! $pointsSection->description->short_description !!}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>1
@endsection
@push('extra-script')
    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function () {
                    $('#loader').show();
                },
                // return the result
                success: function (result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function () {
                    $('#loader').hide();
                },
                error: function (jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
@endpush

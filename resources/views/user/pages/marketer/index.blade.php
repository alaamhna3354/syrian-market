@extends('user.layouts.app')
@section('title')
    @lang('Marketing')
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
                                <li class="active"><h4>@lang('Marketers join through you')
                                        : {{$marketer->childern->count()}} @lang('Marketers')</h4></li>
                            </ol>
                        </div>
                    </div>
                    @can('join_as_marketer')
                        <div class="col-md-3">
                            <a href="{{route('user.marketer.join')}}"
                               class="btn waves-effect waves-light w-100 btn-primary">
                                @lang('Get more codes')</a>
                        </div>
                    @endcan()
                    @if(config('basic.marketers_swap')==1)
                        @can('normal_marketer')
                            <div class="col-md-3">
                                <button class="btn waves-effect waves-light w-100 btn-primary"
                                        data-toggle="modal" id="" data-target="#swap">
                                    <span>@lang('Swap')</span></button>
                            </div>
                        @endcan
                    @endif
                    @if(config('basic.golden_refund')==1)
                        @can('golden_marketer')
                            <div class="col-md-3">
                                <button class="btn waves-effect waves-light w-100 btn-primary"
                                        data-toggle="modal" id="" data-target="#refund">
                                    <span>@lang('Refund')</span></button>
                            </div>
                        @endcan
                    @endif
                </div>
                <div class="card my-3">
                    <div class="card-body" style="background: #00000077;color: aliceblue;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('Your invitation code'): </label></br>
                                    <span> {{$marketer->invitation_code}}
                                        <i class="fa fa-copy" style="font-size: 16px;"
                                           onclick="copy('{{$marketer->invitation_code}}')"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>@lang('Joining date') :</label></br>
                                <span>{{ dateTime($marketer->created_at, 'd M Y h:i A') }}</span>
                            </div>
                            <div class="col-md-3">
                                <label>@lang('Status'):</label></br><span> @lang($marketer->status)</span>
                            </div>
                            <div class="col-md-3">
                                <label>@lang('Remaining invitation'):</label></br>
                                <span>{{$marketer->remaining_invitation}}</span>
                            </div>
                        </div>
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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Joinig Date')</th>
                                    <th>@lang('Invitation code')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($marketer->childern as $childMarketer)
                                    <tr>
                                        <td data-label="@lang('Name')">{{$childMarketer->user->firstname .' '.$childMarketer->user->lastname}}</td>
                                        <td data-label="@lang('Remarks')"> @lang($childMarketer->status)</td>
                                        <td data-label="@lang('Joinig Date')">
                                            {{ dateTime($childMarketer->created_at, 'd M Y h:i A') }}
                                        </td>
                                        <td data-label="@lang('Remarks')"> @lang($childMarketer->invitation_code)</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        {{--<!-- {{ $marketer->childMarketers->appends($_GET)->links() }} -->--}}


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- small modal -->
    <div class="modal fade" id="swap" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
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
                        <p class="text-danger ">@lang('Swap Proceess allow you to disable your marketer account and get some points in first 3 days after joining')</p>
                        <h3>@lang('Do you want to swap?')
                            <div class="modal-footer">
                                <form action="{{route('user.marketer.swap')}}" method="post">
                                    @csrf
                                    @if((now()->diff(auth()->user()->marketer->created_at)->format('%a') ) <= 3)
                                        <button type="submit" class="btn btn-primary ">@lang('Process')</button>
                                    @else
                                        <p class="text-danger ">@lang('Sorry you cannot swap after 3 days of joining') </p>
                                    @endif
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- small modal -->
    <div class="modal fade" id="refund" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
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
                        <p class="text-danger ">@lang('Swap Proceess allow you to disable your marketer account and get some points in first 3 days after joining')</p>
                        <h3>@lang('Do you want to swap?')
                            <div class="modal-footer">
                                <form action="{{route('user.marketer.golden.refund')}}" method="post">
                                    @csrf
                                    @if((now()->diff(auth()->user()->marketer->created_at)->format('%a') ) <= 3)
                                        <button type="submit" class="btn btn-primary ">@lang('Process')</button>
                                    @else
                                        <p class="text-danger ">@lang('Sorry you cannot swap after 3 days of joining') </p>
                                    @endif
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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


    </script>
@endpush
@push('js')
    <script>
        function copy($link) {
            console.log($link)
            /* Copy the text inside the text field */
            navigator.clipboard.writeText($link);
            Toastify({
                text: "تم النسخ",
                duration: 3000
            }).showToast();
        }
    </script>
@endpush
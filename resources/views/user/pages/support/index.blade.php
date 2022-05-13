@extends('user.layouts.app')
@section('title')
    @lang($page_title)
@endsection
@section('content')


    <div class="container-fluid px-3 user-service-list">

        <div class="row my-3 justify-content-between mx-lg-5">

            <div class="col-sm-12">
                <ol class="breadcrumb center-items">
                    <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="active">@lang($page_title)</li>
                </ol>

                <div class="card my-3">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="categories-show-table table table-hover table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('Subject')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Last Reply')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($tickets as $key => $ticket)
                                    <tr>
                                        <td data-label="@lang('Subject')">
                                            <span class="font-weight-bold"> [{{ trans('Ticket#').$ticket->ticket }}] {{ $ticket->subject }} </span>
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if($ticket->status == 0)
                                                <span class="badge badge-pill badge-success">@lang('Open')</span>
                                            @elseif($ticket->status == 1)
                                                <span class="badge badge-pill badge-primary">@lang('Answered')</span>
                                            @elseif($ticket->status == 2)
                                                <span class="badge badge-pill badge-warning">@lang('Replied')</span>
                                            @elseif($ticket->status == 3)
                                                <span class="badge badge-pill badge-dark">@lang('Closed')</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Last Reply')">
                                            {{diffForHumans($ticket->last_reply) }}
                                        </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('user.ticket.view', $ticket->ticket) }}"
                                               class="btn btn-sm btn-outline-info"
                                               data-toggle="tooltip" title="" data-original-title="Details">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">
                                            <p class="text-dark">@lang('No Data Found')</p>
                                        </td>
                                    </tr>

                                @endforelse
                                </tbody>
                            </table>
                            {{ $tickets->appends($_GET)->links() }}
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

@push('js')


@endpush

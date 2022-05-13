@extends('admin.layouts.app')
@section('title')
    @lang('Dashboard')
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row admin-fa_icon">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card  shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($userRecord['totalUser'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Total Users')
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="users" class="fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ config('basic.currency_symbol')}}{{getAmount($userRecord['totalUserBalance'])}} </h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Total Balance')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-money-bill-alt fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($totalOrder)}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Total Order')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-shopping-cart fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ config('basic.currency_symbol')}}{{getAmount($totalAmountReceived)}} </h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Fund Collected')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-hand-holding-usd fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ config('basic.currency_symbol')}}{{getAmount($transactionProfit['profit_30_days'])}} </h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Last 30 days')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-hand-holding-usd fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ config('basic.currency_symbol')}}{{getAmount($transactionProfit['profit_today'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Today Profit')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-money-bill-alt fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{$orders['records']['todaysOrder']}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Todays Order')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-shopping-cart fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{$userRecord['todayJoin']}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Today Join User')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="users" class="fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body p-1">
                        <h4 class="card-title pl-1 py-1">@lang("Recent Orders")</h4>
                        <div>
                            <canvas id="line-chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-4">
                <div class="card shadow">
                    <div class="card-body  p-1">
                        <h4 class="card-title pl-1 py-1">@lang('Statistics')</h4>
                        <div>
                            <canvas id="pie-chart" height="280"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row  admin-fa_icon">
            <div class="col-md-12">
                <h4 class="card-title">@lang('Last 30 Days Order')</h4>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['totalOrder'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Total')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-shopping-cart fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['complete'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Complete')</h6>
                            </div>

                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-check fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['processing'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Processing')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-sync fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['pending'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Pending')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-spinner fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['inProgress'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('In Progress')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-arrow-left fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['partial'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Partial')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-inbox fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['canceled'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Canceled')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-times fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($orders['records']['refunded'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Refunded')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-arrow-right fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div class="row  admin-fa_icon">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title"> @lang('Top bestsellers')</h4>
                        <div class="table-responsive">
                            <table class="categories-show-table table table-hover table-striped table-bordered text-right text-lg-center">
                                <thead class="thead-primary">
                                <tr>
                                    <th scope="col">@lang('ID')</th>
                                    <th scope="col" class="text-left">@lang('Name')</th>
                                    <th scope="col">@lang('Total Order')</th>
                                    <th scope="col">@lang('Total Quantity')</th>
                                    <th scope="col">@lang('Provider')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bestSale as $sale)
                                    <tr>
                                        <td data-label="@lang('ID')">@lang($sale->service->id)</td>
                                        <td data-label="@lang('Name')" class="text-right text-lg-left">

                                            <a href="javascript:void(0)" data-container="body"  data-toggle="popover" data-placement="top" data-content="{{optional($sale->service)->service_title}}">
                                                {{\Str::limit(optional($sale->service)->service_title, 30)}}
                                            </a>
                                        </td>

                                        <td data-label="@lang('Total Order')">
                                            {{$sale->count}}
                                        </td>
                                        <td data-label="@lang('Total Quantity')">
                                            {{$sale->quantity}}
                                        </td>

                                        <td data-label="@lang('Provider')">
                                            {{ optional($sale->service->provider)->api_name ?? 'N/A' }}
                                        </td>



                                        <td data-label="@lang('Action')">
                                            <div class="dropdown show">
                                                <a class="dropdown-toggle" href="#" id="dropdownMenuLink"
                                                   data-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.service.edit',['id'=>$sale->service->id])}}">
                                                        <i class="fa fa-edit text-warning pr-2"
                                                           aria-hidden="true"></i> @lang('Edit')</a>

                                                    <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal"
                                                            data-target="#description" id="details"
                                                            data-toggle="tooltip" title="Details"
                                                            data-servicetitle="{{$sale->service->service_title}}"
                                                            data-description="{{$sale->service->description}}">

                                                        <i class="fa fa-info-circle text-info pr-2"
                                                           aria-hidden="true"></i> @lang('Details')
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row  admin-fa_icon">
            <div class="col-md-12">
                <h4 class="card-title">@lang('Tickets')</h4>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($tickets['closed'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Closed')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-times-circle fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($tickets['replied'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Replied')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-inbox fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($tickets['answered'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Answered')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-check fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{number_format($tickets['pending'])}}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Pending')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i class="fa fa-spinner fa-2x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="card-title">@lang('Latest User')</h4>
                        <div class="table-responsive">
                            <table class="categories-show-table table table-hover table-striped table-bordered">
                                <thead class="thead-primary">
                                <tr>
                                    <th scope="col">@lang('Username')</th>
                                    <th scope="col">@lang('Email')</th>
                                    <th scope="col">@lang('Phone')</th>
                                    <th scope="col">@lang('Balance')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($latestUser as $user)
                                    <tr>
                                        <td data-label="@lang('Username')">@lang($user->username)</td>
                                        <td data-label="@lang('Email')">@lang($user->email)</td>
                                        <td data-label="@lang('Phone')">@lang(($user->phone)? : 'N/A')</td>
                                        <td data-label="@lang('Balance')">{{getAmount($user->balance)}} {{trans(config('basic.currency'))}}</td>
                                        <td data-label="@lang('Status')">
                                            <span
                                                class="badge badge-pill {{ $user->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $user->status == 0 ? 'Inactive' : 'Active' }}</span>
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <div class="dropdown show">
                                                <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink"
                                                   data-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.user-edit',$user->id) }}">
                                                        <i class="fa fa-edit text-warning pr-2"
                                                           aria-hidden="true"></i> @lang('Edit')
                                                    </a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.user.customRate',$user->id) }}">
                                                        <i class="fa fa-money-bill-alt text-dark pr-2"
                                                           aria-hidden="true"></i> @lang('Custom Rate')
                                                    </a>

                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.user-order',$user->id) }}">
                                                        <i class="fa fa-eye text-info pr-2"
                                                           aria-hidden="true"></i> @lang('Order')
                                                    </a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('admin.send-email',$user->id) }}">
                                                        <i class="fa fa-envelope text-success pr-2"
                                                           aria-hidden="true"></i> @lang('Send Email')
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-danger" colspan="7">@lang('No User Data')</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div class="modal fade" id="description">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="servicedescription"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/js/Chart.min.js') }}"></script>
    <script>
        "use strict";
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: @json($statistics['date']),
                datasets: [{
                    data: @json($statistics['completed']),
                    label: "Completed",
                    borderColor: "#6fbbff",
                    fill: false
                }, {
                    data: @json($statistics['processing']),
                    label: "Processing",
                    borderColor: "#ff6f62",
                    fill: false
                }, {
                    data: @json($statistics['pending']),
                    label: "Pending",
                    borderColor: "#05ffe4",
                    fill: false
                }, {
                    data: @json($statistics['progress']),
                    label: "Progress",
                    borderColor: "#98df8a",
                    fill: false
                }, {
                    data: @json($statistics['partial']),
                    label: "Partial",
                    borderColor: "#8b6ef3",
                    fill: false
                },
                    {
                        data: @json($statistics['canceled']),
                        label: "Canceled",
                        borderColor: "#f9dd7e",
                        fill: false
                    },
                    {
                        data: @json($statistics['refunded']),
                        label: "Refunded",
                        borderColor: "#f34da3",
                        fill: false
                    }
                ]
            }
        });


        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
                labels: @json(collect($orders['percent'])->keys()),
                datasets: [{
                    backgroundColor: ["#6fbbff", "#ff6f62", "#05ffe4", "#98df8a", "#8b6ef3", "#f9dd7e", "#f34da3"],
                    data: @json(collect($orders['percent'])->flatten()),
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function (tooltipItems, data) {
                            return data.labels[tooltipItems.index] + ': ' + data.datasets[0].data[tooltipItems.index] + '%';
                        }
                    }

                }
            }
        });


        $(document).on('click', '#details', function () {
            var title = $(this).data('servicetitle');
            var description = $(this).data('description');
            $('#title').text(title);
            $('#servicedescription').text(description);
        });
    </script>
@endpush

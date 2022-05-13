@extends('admin.layouts.app')
@section('title')
    @lang('Service Show')
@endsection
@push('style-lib')
    <link href="{{ asset('assets/admin/css/select.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/jquery-ui.css') }}" rel="stylesheet">
@endpush

@section('content')


    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5">
        <div class="row ">
            <div class="col-xl-10">
                <form action="{{ route('admin.service-search') }}" method="get">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <input type="text" name="service" value="{{@request()->service}}" class="form-control"
                                       placeholder="@lang('Type Here')">
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <select name="category" id="category" class="form-control statusfield">
                                    <option value="-1" @if(@request()->category == '-1') selected @endif>@lang('All Category')</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(@request()->category == $category->id) selected @endif>@lang($category->category_title)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <select name="provider" id="provider" class="form-control statusfield">
                                    <option value="-1" @if(@request()->provider == '-1') selected @endif>@lang('All Provider')</option>
                                    @foreach($apiProviders as $provider)
                                        <option value="{{ $provider->id }}" @if(@request()->provider == $provider->id) selected @endif>@lang($provider->api_name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="-1" @if(@request()->status == '-1') selected @endif>@lang('All Status')</option>
                                    <option value="1" @if(@request()->status == '1') selected @endif>@lang('Active')</option>
                                    <option value="0" @if(@request()->status == '0') selected @endif>@lang('Inactive')</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100 w-sm-auto"><i class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-xl-2 ">

                <div class="d-flex justify-content-start justify-content-xl-end">
                    <button type="button" class="btn btn-sm btn-primary  mr-3" data-toggle="modal"
                            data-target="#importServiceModal">
                        <span> @lang('Import Services')</span>
                    </button>

                    <div class="dropdown">
                        <button class="btn btn-dark  btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="fas fa-bars pr-2"></i> @lang('Action')</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" type="button" data-toggle="modal"
                                    data-target="#all_active">@lang('Active')</button>
                            <button class="dropdown-item" type="button" data-toggle="modal"
                                    data-target="#all_deactive">@lang('Inactive')</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    @forelse($services as $key => $service)
            <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
                <div class="card-body">
                <h4 class="card-title">@lang($key)</h4>
                    <div class="table-responsive">
                        <table class="categories-show-table table table-hover table-striped table-bordered text-right text-lg-center">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th scope="col">
                                        <input type="checkbox"
                                               class="form-check-input check-all tic-check check-all-tic" id="cat-tic-{{ $key }}"
                                               name="check-all">
                                        <label for="cat-tic-{{ $key }}"></label>
                                    </th>
                                    <th scope="col" >@lang('ID')</th>
                                    <th scope="col" class="text-left">@lang('Name')</th>
                                    <th scope="col" >@lang('Provider')</th>
                                    <th scope="col" >@lang('Drip-Feed')</th>
                                    <th scope="col" >@lang('Status')</th>
                                    <th scope="col" >@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($service as $row)
                                <tr>
                                    <td class="text-center check-box-width-50">
                                        <input type="checkbox"
                                               class="form-check-input row-tic tic-check row-tic-check" id="service-tic-{{ $row->id }}"
                                               name="check" value="{{ $row->id }}" data-id="{{ $row->id }}">
                                        <label for="service-tic-{{ $row->id }}"></label>
                                    </td>
                                    <td data-label="@lang('ID')">{{$row->id }}</td>
                                    <td data-label="@lang('Name')"  class="text-right text-lg-left">
                                        <a href="javascript:void(0)" data-container="body"  data-toggle="popover" data-placement="top" data-content="{{$row->service_title}}">
                                            {{\Str::limit($row->service_title, 30)}}
                                        </a>
                                    </td>
                                    <td data-label="@lang('Provider')" >
                                        {{ optional($row->provider)->api_name ?? 'N/A' }}
                                    </td>


                                    <td data-label="@lang('Drip-Feed')">
                                        <span class="badge badge-pill {{ $row->drip_feed == 0 ? 'badge-danger' : 'badge-success' }}">{{ $row->drip_feed == 0 ? 'Inactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        <span class="badge badge-pill {{ $row->service_status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $row->service_status == 0 ? 'Inactive' : 'Active' }}</span>
                                    </td>


                                    <td data-label="@lang('Action')">
                                        <a href="{{route('admin.service.edit',['id'=>$row->id])}}"  class="btn btn-primary btn-rounded btn-sm" title="@lang('Edit')">
                                            <i class="fa fa-edit"
                                               aria-hidden="true"></i>
                                        </a>

                                        @if($row->service_status == 0)
                                            <a href="javascript:void(0)" class="btn btn-success btn-rounded btn-sm status-change" data-toggle="modal"
                                               data-target="#statusMoldal"
                                               data-route="{{route('admin.category.status.change',['id'=>$row->id])}}">
                                                <i class="fa fa-check-circle  "
                                                   aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="btn btn-danger btn-rounded btn-sm status-change" data-toggle="modal"
                                               data-target="#statusMoldal"
                                               data-route="{{route('admin.category.status.change',['id'=>$row->id])}}">
                                                <i class="fa fa-times-circle  "
                                                   aria-hidden="true"></i>
                                            </a>

                                        @endif


                                        <button type="button" class="btn btn-secondary btn-rounded btn-sm"
                                                data-toggle="modal" data-target="#description" id="details"
                                                data-toggle="tooltip" title="Details"
                                                data-servicetitle="{{$row->service_title}}"
                                                data-description="{{$row->description}}"
                                                data-rateper="{{$row->api_provider_price}}"
                                                data-orderlimit="{{$row->min_amount .' - ' .$row->max_amount}}">
                                            <i class="fa fa-info-circle"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


    @empty

        <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
            <div class="card-body">
                <h4 class="card-title">@lang('No Data Found!')</h4>

            </div>
        </div>
    @endforelse


    <div class="modal fade" id="statusMoldal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="statusForm">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you really want to change the current status of the category')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span>  @lang('Change Status')</span> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="importServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('Confirm Import Services')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.api.services') }}" method="post" id="getServicesForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" name="api_provider_id">
                                <option selected="" disabled>@lang('Select API Provider')</option>
                                @foreach($apiProviders as $apiProvider)
                                    <option value="{{ $apiProvider->id }}" >@lang($apiProvider->api_name)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span>  @lang('Get Services')</span> </button>
                    </div>
                </form>
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

                <div class="modal-body">
                    <p id="servicedescription"></p>
                    <p><strong>{{trans('Rate Per 1k')}} :</strong> <span id="rateper"></span> {{config('basic.currency')}} </p>
                    <p><strong>{{trans('Order Limit')}} :</strong> <span id="orderlimit"></span> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="title">@lang('Active Confirmation')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h2><i class="fas fa-sync-alt position-absolute"></i></h2>
                    <div class="body-centent pl-5">
                        <p>@lang('Are you really want to active the category')</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">@lang('No')
                    </button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary active-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="all_deactive" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="title">@lang('DeActive Confirmation')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <h2><i class="fas fa-sync-alt position-absolute"></i></h2>
                    <div class="body-centent pl-5">
                        <p>@lang('Are you really want to Inactive the category')</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary deactive-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/jquery-ui.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            "use strict";
            $(document).on('click', '.check-all-tic', function () {
                $(this).closest('table').find('input:checkbox').prop('checked', this.checked);
            });

            $(document).on('click', '.row-tic-check', function () {
                if($(this).closest('table').find('.row-tic-check').length == $(this).closest('table').find('.row-tic-check:checked').length){
                    $(this).closest('table').find('.check-all-tic').prop('checked', this.checked);
                }else{
                    $(this).closest('table').find('.check-all-tic').prop('checked', false);
                }
            });

            $(document).on('click', '.status-change', function (){
                let route =$(this).data('route');
                $('#statusForm').attr('action', route);
            });
            $(document).on('click','#details',function(){
                var title = $(this).data('servicetitle');
                var description = $(this).data('description');
                var rateper = $(this).data('rateper');
                var orderlimit = $(this).data('orderlimit');
                $('#title').text(title);
                $('#servicedescription').text(description);
                $('#rateper').text(rateper);
                $('#orderlimit').text(orderlimit);
            });
            $(document).on('click','.dropdown-menu',function(e){
                e.stopPropagation();
            });

            $('.statusfield').select2({'width': '100%'});


            //multiple active
            $(document).on('click', '.active-yes', function (e) {
                e.preventDefault();
                var allVals = [];
                $(".row-tic:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length > 0) {
                    var strIds = allVals.join(",");
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        url: "{{ route('admin.service-multiple-active') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: "get",
                        success: function (data) {
                            if (data.success == 1) {
                                location.reload();
                            }
                        }
                    });
                } else {
                    var strIds = allVals.join(",");
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        url: "{{ route('admin.service-multiple-active') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: "get",
                        success: function (data) {
                            if (data.error == 1) {
                                location.reload();
                            }
                        }
                    });
                }
            });
            //multiple deactive
            $(document).on('click', '.deactive-yes', function (e) {
                e.preventDefault();
                var allVals = [];
                $(".row-tic:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length > 0) {
                    var strIds = allVals.join(",");
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        url: "{{ route('admin.service-multiple-deactive') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: "get",
                        success: function (data) {
                            if (data.success == 1) {
                                location.reload();
                            }
                        }
                    });
                } else {
                    var strIds = allVals.join(",");
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        url: "{{ route('admin.service-multiple-deactive') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: "get",
                        success: function (data) {
                            if (data.error == 1) {
                                location.reload();
                            }
                        }
                    });
                }
            });

        });
    </script>
@endpush



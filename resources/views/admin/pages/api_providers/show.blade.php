@extends('admin.layouts.app')
@section('title')
    @lang('Api Provider')
@endsection
@push('style-lib')
    <link href="{{ asset('assets/admin/css/select.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/jquery-ui.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row">
            <div class="col-xl-10">
                <form action="{{route('admin.provider-search')}}" method="get">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <input type="text" class="form-control get-provider" name="provider"
                                       value="{{@request()->provider}}" placeholder="@lang('Type Here')"/>
                            </div>
                        </div>


                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option>@lang('All Status')</option>
                                    <option value="1"
                                            @if(@request()->status == '1') selected @endif>@lang('Active')</option>
                                    <option value="0"
                                            @if(@request()->status == '0') selected @endif>@lang('Inactive')</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <button type="submit" class="btn w-100 w-sm-auto btn-primary"><i
                                        class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-xl-2 ">
                <div class="d-flex justify-content-start justify-content-xl-end">
                    <a href="{{route('admin.provider.api-provider.create')}}"
                       class="btn btn-primary btn-sm mr-2"><span>@lang('Add Providers')</span></a>

                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
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

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <div class="mt-4">
                    <table class="categories-show-table table table-hover table-striped table-bordered">
                        <thead class="thead-primary">
                        <tr>
                            <th scope="col" class="text-center">
                                <input type="checkbox" class="form-check-input check-all tic-check " name="check-all"
                                       id="check-all">
                                <label for="check-all"></label>
                            </th>
                            <th scope="col">@lang('No.')</th>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Balance')</th>
                            <th scope="col">@lang('Description')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($api_providers as $api_provider)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" id="chk-{{ $api_provider->id }}"
                                           class="form-check-input row-tic tic-check"
                                           name="check[]" value="{{ $api_provider->id }}"
                                           data-id="{{ $api_provider->id }}">
                                    <label for="chk-{{ $api_provider->id }}"></label>
                                </td>
                                <td data-label="@lang('No.')">@lang($loop->iteration)</td>

                                <td data-label="@lang('Name')">@lang($api_provider->api_name) </td>

                                <td data-label="@lang('Balance')">@lang($api_provider->balance) </td>
                                <td data-label="@lang('Description')">{!! $api_provider->description ?? '<span class="text-danger">N/A</span>' !!}</td>
                                <td data-label="@lang('Status')">
                                    <span
                                        class="badge badge-pill {{ $api_provider->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $api_provider->status == 0 ? 'Inactive' : 'Active' }}</span>
                                </td>

                                <td data-label="@lang('Action')">
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">


                                            <a class="dropdown-item" href="{{ route('admin.provider.api-provider.edit',[$api_provider->id]) }}">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> @lang('Edit')
                                            </a>


                                            <a href="javascript:void(0)"
                                               class="dropdown-item   status-change"

                                               data-toggle="modal" data-target="#statusModal"
                                               data-route="{{ route('admin.provider.status',[$api_provider->id] ) }} ">

                                                <i class="fa {{ $api_provider->status == 0 ? 'fa-check text-success' : 'fa-times text-danger' }}  pr-2"
                                                   aria-hidden="true"></i>  {{ $api_provider->status == 0 ? 'Activate' : 'Deactivate' }}
                                            </a>


                                            <a href="javascript:void(0)"
                                               class="dropdown-item price-change"
                                               data-route="{{ route('admin.provider.priceUpdate',[$api_provider->id] ) }} "
                                               data-toggle="modal" data-target="#updatePriceModal">
                                                <i class="fa fa-sync text-info pr-2" aria-hidden="true"></i> @lang('Update Price')
                                            </a>

                                        </div>
                                    </div>
                                </td>



                            </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">@lang('No Data Found!')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="statusForm">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you want to change status?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><i
                                    class="fas fa-power-off"></i> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span><i
                                    class="fas fa-save"></i> @lang('Change Status')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">


                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>@lang('Are you want to change status?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span>
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
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>



                <form action="" method="post">
                    @csrf
                <div class="modal-body">
                    <p>@lang('Are you want to change status')</p>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-light red" data-dismiss="modal"><span>@lang('No')</span>
                    </button>

                    <a href="" class="btn btn-primary deactive-yes"><span>@lang('Yes')</span></a>
                </div>

                </form>
            </div>
        </div>
    </div>





    <div class="modal fade" id="updatePriceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Price Update Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="priceForm">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you confirm to update price')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">
                            <span> @lang('Cancel')</span>
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <span> @lang('Yes')</span>
                        </button>
                    </div>
                </form>
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

            $(document).on('click', '.status-change', function () {
                let route = $(this).data('route');
                $('#statusForm').attr('action', route);
            });

            $(document).on('click', '.price-change', function () {
                let route = $(this).data('route');
                $('#priceForm').attr('action', route);
            });


            $(document).on('click', '.dropdown-menu', function (e) {
                e.stopPropagation();
            });



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
                        url: "{{ route('admin.apiprovider-multiple-active') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: 'get',
                        success: function (data) {
                            if (data.success == 1) {
                                window.location.reload();
                            }
                        }
                    });
                } else {
                    var strIds = allVals.join(",");
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        url: "{{ route('admin.apiprovider-multiple-active') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: 'get',
                        success: function (data) {
                            if (data.error == 1) {
                                window.location.reload();
                            }
                        }
                    });
                }
            });

            //multiple deActive
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
                        url: "{{ route('admin.apiprovider-multiple-deactive') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: 'get',
                        success: function (data) {
                            if (data.success == 1) {
                                window.location.reload();
                            }
                        }
                    });

                } else {
                    var strIds = allVals.join(",");
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                        url: "{{ route('admin.apiprovider-multiple-deactive') }}",
                        data: {strIds: strIds},
                        datatType: 'json',
                        type: 'get',
                        success: function (data) {
                            if (data.error == 1) {
                                window.location.reload();
                            }
                        }
                    });
                }

            });


            $('select[name=status]').select2({
                selectOnClose: true
            });

        });


    </script>
@endpush

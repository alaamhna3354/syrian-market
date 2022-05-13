@extends('admin.layouts.app')
@section('title', $provider->api_name)
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <h4 class="card-title mb-3">
                <a href="javascript:void(0)" class="import-multiple btn btn-primary text-white float-right" data-toggle="modal"
                                       data-target="#importMultipleMoldal"
                                       data-route="{{ route('admin.api.service.import.multi',['provider'=>$provider->id]) }}">
                    <span><i class="fas fa-plus text-white pr-2"></i> @lang('Add Bulk Service')</span>
                </a>
            </h4>
            <div class="table-responsive ">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr class="text-center">
                        <th scope="col" class="text-center check-box-width-50">
                            <input type="checkbox" class="form-check-input check-all tic-check check-all" name="check-all"
                                   id="check-all">
                            <label for="check-all" class="mt-3"></label>
                        </th>
                        <th scope="col">@lang('ID')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Category')</th>
                        <th scope="col">@lang('Drip-Feed')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apiServiceLists as $service)
                        <tr>
                            <td class="text-center check-box-width-50">
                                <input type="checkbox" id="chk-{{$service->service}}"
                                       class="form-check-input row-tic tic-check row-tic-{{$service->service}}"
                                       name="check" value="{{ $service->service }}">
                                <label for="chk-{{$service->service}}"></label>
                            </td>
                            <td class="text-center">{{$service->service}}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" data-container="body"  data-toggle="popover" data-placement="top" data-content="{{$service->name}}">
                                    {{\Str::limit($service->name, 30)}}
                                </a></td>
                            <td class="text-center">{{ $service->category }}</td>
                            <td class="text-center">
                            <span
                                class="badge badge-pill {{ $service->dripfeed == 0 ? 'badge-danger' : 'badge-success' }}">{{ $service->dripfeed == 0 ? 'Inactive' : 'Active' }}</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" href="javascript:void(0)" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a href="javascript:void(0)" class="dropdown-item import-single" data-toggle="modal"
                                           data-target="#importMoldal"
                                           data-route="{{ route('admin.api.service.import',['id'=>$service->service,'name'=>$service->name,'category'=>$service->category,'rate'=>$service->rate,'min'=>$service->min,'max'=>$service->max,'dripfeed'=>$service->dripfeed, 'provider'=>$provider->id]) }}">
                                            <i class="fas fa-plus text-success pr-2"></i> @lang('Add Service')</a>
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

    <div class="modal fade" id="importMoldal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="importForm">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Select Percentage Increase')</label>
                            <select class="form-control" name="price_percentage_increase">
                                <option value="100" selected>@lang('100%')</option>
                                @for($loop = 0; $loop <= 1000; $loop++)
                                    <option value="{{ $loop }}">{{ $loop }} %</option>
                                @endfor
                            </select>
                        </div>

                        <p>@lang('Are you really want to Import Service')</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><i
                                    class="fas fa-power-off"></i> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span><i
                                    class="fas fa-save"></i> @lang('Confirm Import')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="importMultipleMoldal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm Status Change')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="importMultipleForm">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Bulk add limit')</label>
                            <select class="form-control" name="import_quantity">
                                @for($loop = 25; $loop <= 1000; $loop+=25)
                                    <option value="{{ $loop }}">{{ $loop }}</option>
                                @endfor
                                <option value="all">All</option>
                            </select>
                        </div>

                        <p>@lang('Are you really want to Import All Service')</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span><i
                                    class="fas fa-power-off"></i> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span><i
                                    class="fas fa-save"></i> @lang('Confirm Import')</span></button>
                    </div>
                </form>
            </div>
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
            $(document).on('click', '.import-single', function () {
                let route = $(this).data('route');
                $('#importForm').attr('action', route);
            });
            $(document).on('click', '.import-multiple', function () {
                let route = $(this).data('route');
                $('#importMultipleForm').attr('action', route);
            });

        });
    </script>
@endpush


@extends('admin.layouts.app')
@section('title')
    @lang('Price Range Show')
@endsection

@section('content')



    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">

        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col" class="text-center">
                            <input type="checkbox" class="form-check-input check-all tic-check" name="check-all"
                                   id="check-all">
                            <label for="check-all"></label>
                        </th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Min Total Amount')</th>
                        <th scope="col">@lang('Min Total Amount To Stay In Level')</th>
                        <th scope="col">@lang('Limit Days')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ranges as $range)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" id="chk-{{$range->id}}"
                                       class="form-check-input row-tic tic-check"
                                       name="check[]" value="{{ $range->id }}" data-id="{{ $range->id }}">
                                <label for="chk-{{$range->id}}"></label>
                            </td>
                            <td data-label="@lang('Name')">

                                <div class="chat-img d-inline-block">
                                    @lang($range->name)
                                </div>
                            </td>
                            <td data-label="@lang('Min Total Amount')">
                                @if($range->min_total_amount != 0)
                                @lang($range->min_total_amount)
                                @else
                                --
                                @endif
                            </td>
                            <td data-label="@lang('Min Total Amount To Stay In Level')">
                                @if($range->min_total_amount_to_stay != 0)
                                    @lang($range->min_total_amount_to_stay)
                                @else
                                    --
                                @endif
                            </td>
                            <td data-label="@lang('Limit Days')">
                                @if($range->limit_days != 0)
                                    @lang($range->limit_days) @lang('Hours')
                                @else
                                    --
                                @endif
                            </td>
                            <td data-label="@lang('Action')">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a  class="dropdown-item"
                                            href="{{route('admin.price_range.edit',$range->id)}}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Edit')</a>

{{--                                        <a href="javascript:void(0)"--}}
{{--                                           class="dropdown-item status-change {{ $range->status == 0 ? 'text-success' : 'text-danger' }}"--}}
{{--                                           data-toggle="modal"--}}
{{--                                           data-target="#statusMoldal"--}}
{{--                                           data-route="{{route('admin.category.status.change',['id'=>$range->id])}}">--}}
{{--                                            <i class="fa fa-check "--}}
{{--                                               aria-hidden="true"></i>--}}
{{--                                            {{ $range->status == 0 ? 'Activate' : 'Deactivate' }}--}}
{{--                                        </a>--}}
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

    <div class="modal fade" id="statusMoldal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <p>@lang('Are you really want to change the current status of the category')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span> @lang('Change Status')</span> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm to active status')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                        <p>@lang('Are you really want to active the category')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <button type="button" class="btn btn-primary active-yes"><span>@lang('Yes')</span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="all_deactive" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm to deactive status')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>@lang('Are you really want to deactive the category')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span>
                        <button type="button" class="btn btn-primary deactive-yes"><span>@lang('Yes')</span></button>
                    </button>
                </div>
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

            $(document).on('click', '.status-change', function () {
                let route = $(this).data('route');
                $('#statusForm').attr('action', route);
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
                        url: "{{ route('admin.category-multiple-active') }}",
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
                        url: "{{ route('admin.category-multiple-active') }}",
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
                        url: "{{ route('admin.category-multiple-deactive') }}",
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
                        url: "{{ route('admin.category-multiple-deactive') }}",
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

    <script>
            "use strict";
            $(document).ready(function () {

                $('#status').select2({
                    selectOnClose: true
            });
            });
    </script>
@endpush

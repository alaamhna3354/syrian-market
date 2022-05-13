@extends('admin.layouts.app')
@section('title')
    @lang('Category Show')
@endsection

@section('content')

    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5">
        <div class="row">
            <div class="col-xl-10">
                <form action="{{route('admin.category-search')}}" method="get">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <input type="text" name="category_title" value="{{@request()->category_title}}"
                                       class="form-control"
                                       placeholder="@lang('Type Here')">
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="form-group">
                                <select name="status" class="form-control" id="status">
                                    <option value="" >@lang('All Status')</option>
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
            <div class="col-xl-2">
                <div class="d-flex justify-content-start justify-content-xl-end">

                    <a href="{{route('admin.category.add')}}"
                       class="btn btn-primary btn-sm mr-3"><span>@lang('Add Category')</span></a>

                    <div class="dropdown">
                        <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
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
                        <th scope="col">@lang('Image')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Description')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" id="chk-{{$category->id}}"
                                       class="form-check-input row-tic tic-check"
                                       name="check[]" value="{{ $category->id }}" data-id="{{ $category->id }}">
                                <label for="chk-{{$category->id}}"></label>
                            </td>
                            <td data-label="@lang('Image')">

                                <div class="chat-img d-inline-block">

                                    <img src="{{ getFile(config('location.category.path').$category->image) }}"
                                         alt="user" class="rounded-circle" width="45">
                                </div>
                            </td>
                            <td data-label="@lang('Name')">
                                @lang($category->category_title)
                            </td>
                            <td data-label="@lang('Description')">
                                {!! $category->category_description ?? 'N/A' !!}
                            </td>
                            <td data-label="@lang('Status')">
                                <span
                                    class="badge badge-pill {{ $category->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $category->status == 0 ? 'Inactive' : 'Active' }}</span>
                            </td>
                            <td data-label="@lang('Action')">




                                <div class="dropdown show">
                                    <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a  class="dropdown-item"
                                            href="{{route('admin.category.edit',['id'=>$category->id])}}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Edit')</a>

                                        <a href="javascript:void(0)"
                                           class="dropdown-item status-change {{ $category->status == 0 ? 'text-success' : 'text-danger' }}"
                                           data-toggle="modal"
                                           data-target="#statusMoldal"
                                           data-route="{{route('admin.category.status.change',['id'=>$category->id])}}">
                                            <i class="fa fa-check "
                                               aria-hidden="true"></i>
                                            {{ $category->status == 0 ? 'Activate' : 'Deactivate' }}
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

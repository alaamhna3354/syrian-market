@extends('admin.layouts.app')
@section('title')
    @lang('Language')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <a href="{{route('admin.language.create')}}"
               class="btn btn-sm btn-primary float-right mb-3"><i class="fa fa-plus"></i> @lang('Add New')</a>
            <div class="table-responsive">


                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('Flag')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Short Name')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($languages as $key => $language)
                        <tr>
                            <td>

                                <img class="rounded-circle width-40p"
                                     src="{{ getFile(config('location.language.path').$language->flag )}}"></td>
                            <td>{{ $language->name }}</td>
                            <td>{{ $language->short_name }}</td>

                            <td>
                                @if($language->is_active)
                                    <span class="badge badge-info">@lang('Active')</span>
                                @else
                                    <span class="badge badge-warning">@lang('Inactive')</span>
                                @endif


                            </td>
                            <td>
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item"
                                           href="{{route('admin.language.edit',$language) }}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Edit')</a>

                                        <a class="dropdown-item"
                                           href="{{route('admin.language.keywordEdit',$language) }}">
                                            <i class="fa fa-code text-success pr-2"
                                               aria-hidden="true"></i> @lang('Edit Keywords')</a>


                                        @if($language->short_name != 'en')
                                            <a href="javascript:void(0)"
                                               class="dropdown-item deleteBtn"
                                               data-toggle="modal"
                                               data-toggle="modal" data-target="#deleteModal"
                                               data-route="{{route('admin.language.delete',$language)}}"

                                            >
                                                <i class="fa fa-trash text-danger"></i>
                                                @lang('Delete')
                                            </a>
                                        @endif


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



    <!-- Primary Header Modal -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel">@lang('Delete Confirmation')
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure to delete this?')</p>
                </div>

                <form action="" method="post" class="actionForm">
                    @csrf
                    @method('delete')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Delete')</button>
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
            $('.deleteBtn').on('click', function () {
                $('.actionForm').attr('action', $(this).data('route'));
            });

        })

    </script>

@endpush

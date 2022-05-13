@extends('admin.layouts.app')
@section('title')
    @lang('Notice List')
@endsection

@section('content')


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">

        <div class="card-body">

            <h3 class="card-title">
                <a class="btn btn-primary btn-sm float-right mb-3"
                   href="{{route('admin.notice.create')}}"><i
                        class="fa fa-plus " aria-hidden="true"></i> @lang('Add New')</a>
            </h3>
            <div class="table-responsive">
                    <table class=" table table-hover table-striped table-bordered">
                        <thead class="thead-primary">
                        <tr>
                            <th scope="col">@lang('No.')</th>
                            <th scope="col">@lang('Title')</th>
                            <th scope="col">@lang('Highlight text')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($notices as $notice)
                            <tr>
                                <td data-label="@lang('No.')">@lang($loop->iteration)</td>
                                <td data-label="@lang('Title')">@lang($notice->title) </td>
                                <td data-label="@lang('Highlight text')"><span class="badge badge-info">@lang($notice->highlight_text)</span> </td>

                                <td data-label="@lang('Status')">
                                    <span class="badge badge-pill {{ $notice->status == 0 ? 'badge-danger' : 'badge-success' }}">{{ $notice->status == 0 ? 'Inactive' : 'Active' }}</span>
                                </td>

                                <td>
                                    <div class="dropdown show">
                                        <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item"
                                               href="{{ route('admin.notice.edit',[$notice->id])}}">
                                                <i class="fa fa-edit text-warning pr-2"
                                                   aria-hidden="true"></i> @lang('Edit')</a>
                                                <a href="javascript:void(0)"
                                                   class="dropdown-item deleteBtn"
                                                   data-toggle="modal"
                                                   data-toggle="modal" data-target="#top-modal"
                                                   data-route="{{ route('admin.notice.delete',[$notice->id])}}">
                                                    <i class="fa fa-trash text-danger"></i>
                                                    @lang('Delete')
                                                </a>



                                        </div>
                                    </div>





                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
            {{$notices->links()}}
        </div>
    </div>



    <!-- Top modal content -->
    <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="topModalLabel">@lang('Delete Confirmation')</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <strong>@lang('Are you sure to delete this?')</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">@lang('Close')</button>
                    <form action="" class="form-inline deleteForm" method="post">
                        @csrf
                        @method('delete')
                    <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection



@push('js')
    <script>
        $(document).ready(function() {
            "use strict";
            $('.deleteBtn').on('click', function () {
                let route = $(this).data('route');
                $('.deleteForm').attr('action', route);
            });
        });
    </script>
@endpush

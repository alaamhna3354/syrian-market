@extends('admin.layouts.app')
@section('title')
    @lang("Marketers List")
@endsection


@section('content')
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="{{ route('admin.marketers.search') }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="username" value="{{@request()->username}}" class="form-control"
                                       placeholder="@lang('Username')">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date_time" id="datepicker"/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="">@lang('All Marketers')</option>
                                    <option value="active"
                                            @if(@request()->status == 'active') selected @endif>@lang('Active marketer')</option>
                                    <option value="disabled"
                                            @if(@request()->status == 'disabled') selected @endif>@lang('Inactive marketer')</option>
                                    <option value="banned"
                                            @if(@request()->status == 'banned') selected @endif>@lang('Banned marketer')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn w-100 btn-primary"><i
                                        class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('Username')</th>
                        <th scope="col">@lang('Invitation code')</th>
                        <th scope="col">@lang('Remaining invitation')</th>
                        <th scope="col">@lang('Golden')</th>
                        <th scope="col">@lang('Note')</th>
                        <th scope="col">@lang('Joined by')</th>
                        <th scope="col">@lang('Joined at')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($marketers as $marketer)
                        <tr>
                            <td data-label="@lang('No.')">{{loopIndex($marketers) + $loop->index	 }}</td>
                            <td data-label="@lang('Username')">{{$marketer->user->username}}</td>
                            <td data-label="@lang('Invitation Code')">@lang($marketer->invitation_code)</td>
                            <td data-label="@lang('Remaining invitation')">{{($marketer->remaining_invitation)}}</td>
                            <td data-label="@lang('Golden')">{{$marketer->is_golden ? trans('Yes') : trans('No')}}</td>
                            <td data-label="@lang('Note')">@lang($marketer->note)</td>
                            <td data-label="@lang('Joined by')">@lang(@$marketer->parentMarketer->user->username)</td>
                            <td data-label="@lang('Joined at')">{{$marketer->created_at->format('d M,Y h:i A')}}</td>
                            <td data-label="@lang('Status')">
                                <span
                                    class="badge badge-pill">{{ trans($marketer->status) }}</span>
                            </td>
                            <td data-label="@lang('Action')">
                                <div class=" show">
                                    <div class="-menu" aria-labelledby="">
                                        <a class="dropdown-item" href="{{ route('admin.marketer.info',$marketer->id) }}">
                                            <i class="fa fa-edit text-warning pr-2"
                                               aria-hidden="true"></i> @lang('Info')
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="9">@lang('No Marketer Data')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$marketers->appends(@$_GET)->links()}}

            </div>
        </div>
    </div>


    <div class="modal fade" id="statusMoldal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Confirm Approve')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="statusForm">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you really want to approve this agent')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span> @lang('Cancel')</span></button>
                        <button type="submit" class="btn btn-primary"><span> @lang('Approve')</span> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="all_active" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('Active User Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        ×
                    </button>
                </div>

                <div class="modal-body">

                    <p>@lang("Are you really want to active the User's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary active-yes"><span>@lang('Yes')</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_inactive" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h5 class="modal-title">@lang('DeActive User Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        ×
                    </button>
                </div>

                <div class="modal-body">
                    <p>@lang("Are you really want to Inactive the User's")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('No')</span></button>
                    <form action="" method="post">
                        @csrf
                        <a href="" class="btn btn-primary inactive-yes"><span>@lang('Yes')</span></a>
                    </form>
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

            //dropdown menu is not working
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

                var strIds = allVals;

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{ route('admin.user-multiple-active') }}",
                    data: {strIds: strIds},
                    datatType: 'json',
                    type: "post",
                    success: function (data) {
                        location.reload();

                    },
                });
            });

            //multiple deactive
            $(document).on('click', '.inactive-yes', function (e) {
                e.preventDefault();
                var allVals = [];
                $(".row-tic:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                var strIds = allVals;
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "{{ route('admin.user-multiple-inactive') }}",
                    data: {strIds: strIds},
                    datatType: 'json',
                    type: "post",
                    success: function (data) {
                        location.reload();

                    }
                });
            });


            $('select[name=status]').select2({
                selectOnClose: true
            });

        });
    </script>
@endpush

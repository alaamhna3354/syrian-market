@extends('admin.layouts.app')
@section('title')
    @lang($marketer->user->username)
@endsection
@section('content')


    <div class="m-0 m-md-4 my-4 m-md-0">
        <div class="row">
            <div class="col-sm-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">@lang('Marketer Info')</h4>
                        <h3> @lang(ucfirst($marketer->user->username))</h3>
                        <p>@lang('Joined At') @lang($marketer->created_at->format('d M,Y h:i A')) </p>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Username')
                            <span>{{ $marketer->user->username }}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Fullname')
                            <span>{{ $marketer->user->fullname }}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Invited')
                            <span>{{ $marketer->childern->count() }}</span></li>
                    </div>
                </div>
            </div>

            <div class="card card-primary col-sm-8">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.marketer.update', $marketer->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Remaining Invitation')</label>
                                    <input class="form-control" type="text" name="remaining_invitation"
                                           value="{{ $marketer->remaining_invitation }}"
                                           required>
                                    @error('remaining_invitation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Invitation Code')</label>
                                    <input class="form-control" type="text" name="invitation_code"
                                           value="{{ $marketer->invitation_code }}" required>
                                    @error('invitation_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <label>@lang('Status')</label>
                                    <select name="status" class="form-control">
                                        <option value="" disabled>@lang('Select Status')</option>
                                        <option value="active"
                                                @if($marketer->status == 'active') selected @endif>@lang('Active')</option>
                                        <option value="disabled"
                                                @if($marketer->status == 'disabled') selected @endif>@lang('Disabled')</option>
                                    </select>
                            </div>
                            <div class="col-sm-6">
                                <label>@lang('Type')</label>
                                <select name="is_golden" class="form-control">
                                    <option value="" disabled>@lang('Select Status')</option>
                                    <option value="1"
                                            @if($marketer->is_golden ==1) selected @endif>@lang('Golden')</option>
                                    <option value="0"
                                            @if($marketer->is_golden == 0) selected @endif>@lang('Normal')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label>@lang('Note')</label>
                                <input class="form-control" type="text" name="note"
                                       value="{{ $marketer->note }}">
                                @error('invitation_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="submit-btn-wrapper mt-md-3  text-center text-md-left">
                            <button type="submit"
                                    class=" btn waves-effect waves-light btn-rounded btn-primary btn-block">
                                <span>@lang('Update Marketer')</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <h3>@lang('Marketer log')</h3>
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col">@lang('Date')</th>
                        <th scope="col">@lang('Invited By')</th>
                        <th scope="col">@lang('Earned points')</th>
                        <th scope="col">@lang('Paid')</th>
                        <th scope="col">@lang('Status')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($invitation_logs  as $log)
                        <tr>
                            <td data-label="@lang('Date')"> {{ DateTime($log->created_at,'d M,Y H:i') }}</td>
                            <td data-label="@lang('Invited By')">{{ @$log->invitedBy->user->username }}</td>
                            <td data-label="@lang('Earned points')">{{ $log->earned_points }}</td>
                            <td data-label="@lang('Paid')"
                                class="font-weight-bold">{{ $basic->currency_symbol}}{{ getAmount($log->paid ) }}</td>
                            <td data-label="@lang('Status')" class="font-weight-bold">  {{$log->status}}</td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">
                                <p class="text-danger text-center">@lang('No Data Found')</p>
                            </td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
                {{--{{ $invitation_logs->appends($_GET)->links() }}--}}
            </div>
        </div>
    </div>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <h3>{{$marketer->user->username}} @lang('Has Invite')</h3>
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr>
                        <th scope="col">@lang('Date')</th>
                        <th scope="col">@lang('Invited By')</th>
                        <th scope="col">@lang('Earned points')</th>
                        <th scope="col">@lang('Paid')</th>
                        <th scope="col">@lang('Status')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($childrenLog  as $log)
                        <tr>
                            <td data-label="@lang('Date')"> {{ DateTime($log->created_at,'d M,Y H:i') }}</td>
                            <td data-label="@lang('Marketer')">{{ @$log->marketer->user->username }}</td>
                            <td data-label="@lang('Earned points')">{{ $log->earned_points }}</td>
                            <td data-label="@lang('Paid')"
                                class="font-weight-bold">{{ $basic->currency_symbol}}{{ getAmount($log->paid ) }}</td>
                            <td data-label="@lang('Status')" class="font-weight-bold">  {{$log->status}}</td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">
                                <p class="text-danger text-center">@lang('No Data Found')</p>
                            </td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
                {{--{{ $invitation_logs->appends($_GET)->links() }}--}}
            </div>
        </div>
    </div>





    <!-- The Modal -->
    <div class="modal fade" id="balance">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="{{ route('admin.user-balance-update',$marketer->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title">@lang('Add / Subtract Balance')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group ">
                            <label>@lang('Amount')</label>
                            <input class="form-control" type="text" name="balance" id="balance">
                        </div>

                        <div class="form-group">
                            <div class="custom-switch-btn w-md-30">
                                <input type='hidden' value='1' name='add_status'>
                                <input type="checkbox" name="add_status" class="custom-switch-checkbox" id="add_status"
                                       value="0">
                                <label class="custom-switch-checkbox-label" for="add_status">
                                    <span class="custom-switch-checkbox-inner"></span>
                                    <span class="custom-switch-checkbox-switch"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span>@lang('Close')</span>
                        </button>
                        <button type="submit" class=" btn btn-primary balanceSave"><span>@lang('Submit')</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection
@push('js')
    <script>
        "use strict";


    </script>
@endpush



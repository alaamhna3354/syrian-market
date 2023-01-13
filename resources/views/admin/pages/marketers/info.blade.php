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
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">@lang('Agent action')</h4>


                        <div class="btn-list">
                            <a href="{{ route('admin.user.fundLog',$marketer->id) }}"
                               class="btn btn-info waves-effect waves-light">
                                <span class="btn-label"><i class="fas fa-money-bill-alt"></i></span> @lang('Fund Log')
                            </a>
                            <a href="{{ route('admin.user.user_fundLog',$marketer->id) }}"
                               class="btn btn-info waves-effect waves-light">
                                <span class="btn-label"><i class="fas fa-money-bill-alt"></i></span> @lang('Users Fund Log')
                            </a>

                        </div>


                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">@lang('Marketer information')</h4>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Email')
                                <span>{{ $marketer->user->username }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Fullname')
                                <span>{{ $marketer->user->fullname }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Remaining Invitation')
                                <span>{{ $marketer->remaining_invitation }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Type')
                                <span>{{ $marketer->is_golden ? trans('Golden') : trans('Normal') }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Status')
                                <span>{{ $marketer->status }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Invited')
                                <span>{{ $marketer->children }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('invitation_code')
                                <span>{{ $marketer->invitation_code }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Note')
                                <span>{{ $marketer->note}} </span>
                            </li>
                        </ul>
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
                            <td data-label="@lang('Paid')" class="font-weight-bold">{{ $basic->currency_symbol}}{{ getAmount($log->paid ) }}</td>
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
        $(document).ready(function () {
            $(document).on('click', '#image-label', function () {
                $('#image').trigger('click');
            });
            $(document).on('change', '#image', function () {
                var _this = $(this);
                var newimage = new FileReader();
                newimage.readAsDataURL(this.files[0]);
                newimage.onload = function (e) {
                    $('#image_preview_container').attr('src', e.target.result);
                }
            });
            $(document).on('click', '.balanceSave', function () {
                var bala = $('#balance').text();
            });
        });


        $('.copyBoard').on('click',function () {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success("Copied: " + copyText.value);
        });

        $('.generateBtn').on('click', function () {
            $.ajax({
                url: "{{route('admin.user.keyGenerate',[$marketer->id])}}",
                type: 'POST',
                success(data) {
                    $("#referralURL").val(data)

                    Notiflix.Notify.Success("KEY GENERATE: " + data);

                }
            });
        });

    </script>
@endpush



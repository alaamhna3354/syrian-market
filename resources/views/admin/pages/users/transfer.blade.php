@extends('admin.layouts.app')
@section('title')
    @lang($user->username)
@endsection
@section('content')


    <div class="m-0 m-md-4 my-4 m-md-0">
        <div class="row">

            <div class="col-sm-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">@lang('Profile')</h4>
                        <div class="form-group">
                            <div class="image-input">
                                <img id="image_preview_container" class="preview-image"
                                     src="{{getFile(config('location.user.path').$user->image) }}"
                                     alt="preview image">
                            </div>
                        </div>
                        <h3> @lang(ucfirst($user->username))</h3>
                        <p>@lang('Joined At') @lang($user->agent->created_at->format('d M,Y h:i A')) @lang('As Agent') </p>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-body">
                        <h4 class="card-title">@lang('Agent information')</h4>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Email')
                                <span>{{ $user->agent->email }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Fullname')
                                <span>{{ $user->agent->fullname }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Company Name')
                                <span>{{ $user->agent->company_name }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Company Address')
                                <span>{{ $user->agent->company_address }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Country')
                                <span>{{ $user->agent->country }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Region')
                                <span>{{ $user->agent->region }}</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Profits')
                                <span>{{ getAmount($commission_rate , config('basic.fraction_number')) }} @lang(config('basic.currency'))</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Status')
                                <span
                                    class="badge badge-{{($user->status==1) ? 'success' :'danger'}} success badge-pill">{{($user->status==1) ? trans('Active') : trans('Inactive')}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Approve')
                                <span
                                    class="badge badge-{{($user->is_approved==1) ? 'success' :'danger'}} success badge-pill">{{($user->is_approved==1) ? trans('Approved') : trans('Not Approved')}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Balance')
                                <span>{{ getAmount($user->balance, config('basic.fraction_number')) }} @lang(config('basic.currency')) </span>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>

            <div class="col-sm-8">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="card-title">@lang('Last month earnings') :
                                    <span> {{ getAmount($commission_rate , config('basic.fraction_number')) }} @lang(config('basic.currency'))</span></li>
                                    <br>
                                    ({{$totalCommission_rate == 0 ? "تم تحويل الارباح" : $totalCommission_rate}})
                                </h4>
                            </div>
                            <div class="col-sm-6">
                                <form method="post" action="{{ route('admin.agent.transferEarn') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$userid}}">
                                    <div class="submit-btn-wrapper mt-md-3  text-center text-md-left">
                                        <button type="submit"
                                                class=" btn waves-effect waves-light btn-rounded btn-primary btn-block">
                                            <span>@lang('Transfer of earnings to balance')</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="card-title">@lang('This month earnings') :

                                    <span> {{ getAmount($this_month_commission_rate , config('basic.fraction_number')) }} @lang(config('basic.currency'))</span></li>
                                    <br>
                                    ({{$totalThis_month_commission_rate == 0 ? "تم تحويل الارباح" : "المتبقي :".config('basic.currency')." ".$totalThis_month_commission_rate}}
                                    )
                                </h4>
                            </div>
                            <div class="col-sm-6">
                                <form method="post" action="{{ route('admin.agent.transferThisMonthEarn') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$userid}}">
                                    <div class="submit-btn-wrapper mt-md-3  text-center text-md-left">
                                        <button type="submit"
                                                class=" btn waves-effect waves-light btn-rounded btn-primary btn-block">
                                            <span>@lang('Transfer of earnings to balance')</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        @lang('Last month earnings')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="categories-show-table table table-hover table-striped table-bordered">
                                <thead class="thead-primary">
                                <tr>
                                    <th scope="col" class="text-center">
                                        <input type="checkbox" class="form-check-input check-all tic-check"
                                               name="check-all"
                                               id="check-all">
                                        <label for="check-all"></label>
                                    </th>
                                    <th scope="col">@lang('No.')</th>
                                    <th scope="col">@lang('User')</th>
                                    <th scope="col">@lang('Order')</th>
                                    <th scope="col">@lang('Commission Rate')</th>
                                    <th scope="col">@lang('Date')</th>
                                    <th scope="col">@lang('Is Paid')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($commissions as $key=>$commission)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" id="chk-{{ $commission->id }}"
                                                   class="form-check-input row-tic tic-check" name="check"
                                                   value="{{$commission->id}}"
                                                   data-id="{{ $commission->id }}">
                                            <label for="chk-{{ $commission->id }}"></label>
                                        </td>
                                        <td data-label="@lang('No.')">{{$key+1}}</td>
                                        <td data-label="@lang('User')">@lang($commission->user->username)</td>
                                        <td data-label="@lang('Order')">@lang($commission->order_id)</td>
                                        <td data-label="@lang('Commission Rate')">{{getAmount($commission->commission_rate, config('basic.fraction_number'))}} {{trans(config('basic.currency'))}}</td>
                                        <td data-label="@lang('Date')">@lang(dateTime($commission->created_at, 'd/m/Y - h:i A' ))</td>
                                        <td data-label="@lang('Is Paid')">
                                <span
                                    class="badge badge-pill {{ $commission->is_paid == 0 ? 'badge-danger' : 'badge-success' }}">{{ $commission->is_paid == 0 ? 'Not Paid' : 'Paid' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-danger" colspan="9">@lang('No User Data')</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
{{--                            {{$commissions->appends(@$_GET)->links()}}--}}

                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        @lang('This month earnings')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="categories-show-table table table-hover table-striped table-bordered">
                                <thead class="thead-primary">
                                <tr>
                                    <th scope="col" class="text-center">
                                        <input type="checkbox" class="form-check-input check-all tic-check"
                                               name="check-all"
                                               id="check-all">
                                        <label for="check-all"></label>
                                    </th>
                                    <th scope="col">@lang('No.')</th>
                                    <th scope="col">@lang('User')</th>
                                    <th scope="col">@lang('Order')</th>
                                    <th scope="col">@lang('Commission Rate')</th>
                                    <th scope="col">@lang('Date')</th>
                                    <th scope="col">@lang('Is Paid')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($commissionsThisMonth as $key=>$commission)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" id="chk-{{ $commission->id }}"
                                                   class="form-check-input row-tic tic-check" name="check"
                                                   value="{{$commission->id}}"
                                                   data-id="{{ $commission->id }}">
                                            <label for="chk-{{ $commission->id }}"></label>
                                        </td>
                                        <td data-label="@lang('No.')">{{$key+1}}</td>
                                        <td data-label="@lang('User')">@lang($commission->user->username)</td>
                                        <td data-label="@lang('Order')">@lang($commission->order_id)</td>
                                        <td data-label="@lang('Commission Rate')">{{getAmount($commission->commission_rate, config('basic.fraction_number'))}} {{trans(config('basic.currency'))}}</td>
                                        <td data-label="@lang('Date')">@lang(dateTime($commission->created_at, 'd/m/Y - h:i A' ))</td>
                                        <td data-label="@lang('Is Paid')">
                                <span
                                    class="badge badge-pill {{ $commission->is_paid == 0 ? 'badge-danger' : 'badge-success' }}">{{ $commission->is_paid == 0 ? 'Not Paid' : 'Paid' }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-danger" colspan="9">@lang('No User Data')</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
{{--                            {{$commissions->appends(@$_GET)->links()}}--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <!-- The Modal -->
    <div class="modal fade" id="balance">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="{{ route('admin.user-balance-update',$user->id) }}"
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


        $('.copyBoard').on('click', function () {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            Notiflix.Notify.Success("Copied: " + copyText.value);
        });

        $('.generateBtn').on('click', function () {
            $.ajax({
                url: "{{route('admin.user.keyGenerate',[$user->id])}}",
                type: 'POST',
                success(data) {
                    $("#referralURL").val(data)

                    Notiflix.Notify.Success("KEY GENERATE: " + data);

                }
            });
        });

    </script>
@endpush



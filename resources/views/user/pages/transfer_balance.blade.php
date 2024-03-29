@extends('user.layouts.app')
@section('title')
    @lang('Transfer Balance')
@endsection
@section('content')
    <div class="container">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang('Transfer Balance')</li>
        </ol>

        <div class="row my-3">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-order">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title shadow-h text-white mb-3">@lang('Add new')</h4>
                                <form class="form" method="post" action="{{route('user.balance-transfer')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="shadow-h text-white">@lang('User email')</label>
                                                <input type="text" id="email" name="email" class="form-control"
                                                       placeholder="@lang('Email')" required>
                                            </div>
                                            <div class="vald-email"></div>
                                            <div class="vald-email"
                                                 hidden>@lang('أدخل ايميل المستخدم الذي تريد التحويل له')</div>
                                            <div>
                                                {{--<label class="shadow-h text-white">@lang('Username')</label>--}}
                                                <input type="text" id="username" name="username"
                                                       placeholder="@lang('Username')" readonly>
                                                <button class="btn btn-primary"
                                                        id="check-username">@lang('Check')</button>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group price">
                                                <label class="shadow-h text-white">@lang('Balance')</label>
                                                <input type="number" id="balance" name="balance" class="form-control"
                                                       placeholder="Balance" min="1" max="{{auth()->user()->balance}}"
                                                       required>
                                                @if($errors->has('balance'))
                                                    <div
                                                            class="error text-danger">@lang($errors->first('balance')) </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                                        <button type="submit"
                                                class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3 "
                                                disabled id="transfer">
                                            <span>@lang('Transfer')</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $("#check-username").click(function () {
            event.preventDefault()
            var email = $('#email').val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (email == "" || !regex.test(email)) {
                $('.vald-email').removeAttr('hidden');
            }
            else {
                $('.vald-email').attr('hidden', true);
                $.ajax({
                    url: '/user/username',
                    type: "post",
                    data: {useremail: email, "_token": "{{ csrf_token() }}"},
                    success: function (response) {
                        if (response == 0)
                            $('#username').val('ايميل خاطئ');
                        else
                        {
                            $('#username').val(response);
                            $('#transfer').removeAttr('disabled')
                        }
                    },
                })
            }
            console.log(1);

        });

        $("#email").on("input", function() {
            $('#transfer').attr('disabled',true)
            $('#username').val('');
        });

    </script>
@endpush
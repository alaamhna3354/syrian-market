@extends('user.layouts.app')
@section('title')
    @lang('Join as marketer')
@endsection
@section('content')


    <div class="container" id="Agent">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang('Join as marketer')</li>
        </ol>

        <div class="row my-3">
            <div class="col-sm-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <ol class="breadcrumb center-items">
                            <li class="active">@lang('Terms of affiliation as an marketer for Syria Market')</li>
                        </ol>
                    </div>
                    <div class="card-body" style="background: #00000077;">
                        <ul class="terms">
                            <li><h4 class="">@lang('Pay the specified membership fee')</h4></li>
                            <li><h4>@lang('Get an invite code from a marketer')</h4></li>

                        </ul>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <ol class="breadcrumb center-items">
                            <li class="active">@lang('Advantages of Being a Syria Market marketer')</li>
                        </ol>
                    </div>
                    <div class="card-body" style="background: #00000077;">
                        <ul class="advantages">
                            <li><h4 class="">@lang('Get invitation codes to sell')</h4></li>
                            <li><h4>@lang('Earn points by joining marketers')</h4></li>
                            <li><h4>@lang('Earn through your friends purchases')</h4></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <ol class="breadcrumb center-items">
                            <li class="active">@lang('Join by activation code')</li>
                        </ol>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.marketer.store') }}" class="form-content w-100">
                            @csrf
                            <div class="signup">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" id="invitation_code" type="text" name="invitation_code"
                                                   value="{{old('invitation_code')}}"
                                                   placeholder="@lang('Invitation Code')" required
                                            @if(config('basic.auto_generate_invitation_code')) readonly @endif>
                                            @error('email')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>
                                    @if(config('basic.auto_generate_invitation_code'))
                                        <div class="col-md-6">
                                            <span class="btn mt-20" id="random-code">@lang('Get random code')</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <button class="btn mt-20" type="submit">@lang('Pay fee and join')</button>
                        </form>
                    </div>
                </div>

                <div class="card-header">
                    <ol class="breadcrumb center-items">
                        <li class="active">@lang('Join as Golden marketer')</li>
                    </ol>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.marketer.golden.store') }}" class="form-content w-100">
                        @csrf
                        <button class="btn mt-20" type="submit">@lang('Pay fee and join')</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('js')
    <script>
        "use strict";
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

        $("#random-code").click(function(e){
            e.preventDefault();
            $.ajax({
                url : "/user/random-code",
                success : function(data){
                    $('#invitation_code').val(data);
                }
            });
        });
    </script>
@endpush

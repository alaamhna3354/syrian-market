@extends('agent.layouts.app')
@section('title')
    @lang('Edit User')
@endsection
<style>
    .custom-switch-checkbox-switch{
        background: #fe5917!important;
        border: 2px solid #fe5917!important;
    }
    .custom-switch-checkbox-inner:before {
        color: #000!important;
        font-size: 17px!important;
    }
    .custom-switch-checkbox-inner:after{
        color: #000!important;
        font-size: 17px!important;
    }
    .form-group label{
        color: #ffffff;
    }
</style>
@section('content')


    <div class="container">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang('Profile Settings For User')</li>
        </ol>
        <form method="post" action="{{ route('agent.user.update', $user->id) }}" enctype="multipart/form-data">
            <div class="row my-3">
                <div class="col-sm-4">
                    <div class="card card-primary">
                        <div class="card-body">

                            <div class="form-group">
                                @csrf
                                <div class="image-input ">
                                    <label for="image-upload" id="image-label"><i class="fas fa-upload"></i></label>
                                    <input type="file" name="image" placeholder="Choose image" id="image">
                                    <img id="image_preview_container" class="preview-image"
                                         src="{{getFile(config('location.user.path').$user->image)}}"
                                         alt="preview image">
                                </div>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card card-primary">
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ $errors->has('profile') ? 'active' : ($errors->has('password') ? '' : 'active') }}"
                                       data-toggle="tab" href="#home">@lang('Profile Information')</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>@lang('First Name')</label>
                                                <input class="form-control" type="text" name="firstname"
                                                       value="{{old('firstname')?: $user->firstname }}">
                                                @if($errors->has('firstname'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('firstname')) </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>@lang('Last Name')</label>
                                                <input class="form-control" type="text" name="lastname"
                                                       value="{{old('lastname')?: $user->lastname }}">
                                                @if($errors->has('lastname'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('lastname')) </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>@lang('Username')</label>
                                                <input class="form-control" type="text" name="username"
                                                       value="{{old('username')?: $user->username }}">
                                                @if($errors->has('username'))
                                                    <div
                                                        class="error text-danger">@lang($errors->first('username')) </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>@lang('Email Address')</label>
                                                <input class="form-control" type="email" value="{{ $user->email }}"
                                                       name="email" readonly>
                                                @if($errors->has('email'))
                                                    <div class="error text-danger">@lang($errors->first('email')) </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>@lang('Phone')</label>
                                                <input type="text" name="phone" class="form-control pl-3"
                                                       value="{{old('phone')?: $user->phone }}"
                                                       placeholder="User Phone Number">
                                                @if($errors->has('phone'))
                                                    <div class="error text-danger">@lang($errors->first('phone')) </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if(0 < count($languages))
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label>@lang('Preferred Language')</label>

                                                    <select name="language_id" class="form-control">
                                                        <option value="" disabled>@lang('Select Language')</option>
                                                        @foreach($languages as $item)
                                                            <option value="{{$item->id}}" @if($item->id == $user->language_id) selected @endif>{{$item->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Current Password')</label>
                                                <input id="password" type="password" class="form-control"
                                                       name="current_password" autocomplete="off">
                                                @if($errors->has('current_password'))
                                                    <div class="error text-danger">@lang($errors->first('current_password')) </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('New Password')</label>
                                                <input id="password" type="password" class="form-control"
                                                       name="password" autocomplete="off">
                                                @if($errors->has('password'))
                                                    <div class="error text-danger">@lang($errors->first('password')) </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Confirm Password')</label>
                                                <input id="password_confirmation" type="password"
                                                       name="password_confirmation" autocomplete="off"
                                                       class="form-control">
                                                @if($errors->has('password_confirmation'))
                                                    <div class="error text-danger">@lang($errors->first('password_confirmation')) </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>@lang('Dept')</label>
                                                        <div class="custom-switch-btn w-md-80">
                                                            <input type='hidden' value='0' name='dept'>
                                                            <input type="checkbox" name="dept" class="custom-switch-checkbox"
                                                                   id="dept" {{$user->is_debt == 1 ? "checked" : ""}}>
                                                            <label class="custom-switch-checkbox-label" for="dept" style="border: 2px solid #fe5917;">
                                                                <span class="custom-switch-checkbox-inner"></span>
                                                                <span class="custom-switch-checkbox-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>@lang('Debt amount')</label>
                                                            <input id="dept_amount" type="text"
                                                                   name="dept_amount"
                                                                   class="form-control" value="{{old('dept_amount')?: $user->debt_balance }}">
                                                            @if($errors->has('dept_amount'))
                                                                <div
                                                                    class="error text-danger">@lang($errors->first('dept_amount')) </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label>@lang('Address')</label>
                                        <textarea class="form-control" name="address"
                                                  rows="5">@lang($user->address)</textarea>

                                        @if($errors->has('address'))
                                            <div class="error text-danger">@lang($errors->first('address')) </div>
                                        @endif
                                    </div>

                                    <div class="submit-btn-wrapper text-center text-md-left">
                                        <button type="submit"
                                                class="btn waves-effect waves-light btn-primary btn-block btn-rounded">
                                            <span>@lang('Update User')</span></button>
                                    </div>




                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>
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
    </script>
@endpush

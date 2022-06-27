@extends('user.layouts.app')
@section('title')
    @lang('Sign up As Agent')
@endsection
@section('content')


    <div class="container" id="Agent">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang('Sign up As Agent')</li>
        </ol>

        <div class="row my-3">
            <div class="col-sm-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <ol class="breadcrumb center-items">
                            <li class="active">@lang('Terms of affiliation as an agent for Syria Market')</li>
                        </ol>
                    </div>
                    <div class="card-body" style="background: #00000077;">
                       <ul class="terms">
                           <li><h4 class="">@lang('Your purchases exceed $5000 per month')</h4></li>
                           <li><h4>@lang('pay cash')</h4></li>
                           <li><h4>@lang('Invite 10 people from your friends and open their accounts through you within a period not exceeding 15 days after opening the agency')</h4></li>
                           <li><h4>@lang('Your balance must be at least 500$')</h4></li>

                       </ul>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <ol class="breadcrumb center-items">
                            <li class="active">@lang('Advantages of Being a Syria Market Agent')</li>
                        </ol>
                    </div>
                    <div class="card-body" style="background: #00000077;">
                        <ul class="advantages">
                            <li><h4 class="">@lang('discounted prices')</h4></li>
                            <li><h4>@lang('Invite your friends to join us')</h4></li>
                            <li><h4>@lang('Earn through your friends purchases')</h4></li>
                            <li><h4>@lang('Customized customer service for you')</h4></li>
                            <li><h4>@lang('Direct delivery of orders')</h4></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card card-primary">
                    <div class="card-body">
                        <form method="POST" action="{{ route('addAgent',$user) }}" class="form-content w-100">
                            @csrf
                            <div class="signup">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="fullname"
                                                   value="{{old('fullname')}}" placeholder="@lang('Full Name')">
                                            @error('fullname')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="whatsapp" value="{{old('whatsapp')}}" placeholder="@lang('Whatsapp')">
                                            @error('whatsapp')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="email"
                                                   value="{{old('email')}}"
                                                   placeholder="@lang('Email Address')">
                                            @error('email')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="company_name"
                                                   value="{{old('company_name')}}" placeholder="@lang('Company Name')">
                                            @error('company_name')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="company_address"
                                                   value="{{old('company_address')}}"
                                                   placeholder="@lang('Company Address')">
                                            @error('company_address')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="country"
                                                   value="{{old('country')}}" placeholder="@lang('Country')">
                                            @error('country')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="region"
                                                   value="{{old('region')}}"
                                                   placeholder="@lang('Region')">
                                            @error('region')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="expected_purchasing_power"
                                                   value="{{old('expected_purchasing_power')}}" placeholder="@lang('Expected Purchasing Power')">
                                            @error('expected_purchasing_power')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="note"
                                                   value="{{old('note')}}"
                                            >@lang('Note')</textarea>
                                            @error('note')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="is_agent" value="1">
                            <button class="btn mt-20" type="submit">@lang('Submit')</button>
                        </form>
                    </div>
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
    </script>
@endpush

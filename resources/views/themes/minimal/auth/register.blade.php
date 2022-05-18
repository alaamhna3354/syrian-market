@extends($theme.'layouts.app')
@section('title','REGISTER')
@section('content')
    <!-- LOGIN-SIGNUP -->
    <section class="login-signup">
        <div class="container">
            <div class="row">

                {{--@if(isset($templates['register'][0]) && $content = $templates['register'][0])--}}
                    {{--<div class="col-lg-5">--}}
                        {{--<div class="d-flex align-items-center justify-content-start">--}}
                            {{--<div class="wrapper">--}}
                                {{--<div class="login-info-wrapper">--}}
                                    {{--<h5 class="h5 mb-30">@lang(@$content->description->title)</h5>--}}
                                    {{--<p>@lang(@$content->description->description)</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}


                <div class="col-lg-7">
                    <div
                        class="form-wrapper w-100 h-100 d-flex flex-column align-items-start justify-content-center">
                        <h4 class="h4 text-uppercase mb-30">@lang('REGISTER')</h4>


                        <form method="POST" action="{{ route('register') }}" class="form-content w-100">
                            @csrf
                            <div class="signup">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="firstname"
                                                   value="{{old('firstname')}}" placeholder="@lang('First Name')">
                                            @error('firstname')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="lastname" value="{{old('lastname')}}" placeholder="@lang('Last Name')">
                                            @error('lastname')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="username"
                                                   value="{{old('username')}}" placeholder="@lang('Username')">
                                            @error('username')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

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

                                </div>


                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group ">
                                                <div class="input-group-prepend w-30">
                                                    <select name="phone_code" class="form-control country_code">
                                                        @foreach($countries as $value)
                                                            <option value="{{$value['phone_code']}}"
                                                                    data-name="{{$value['name']}}"
                                                                    data-code="{{$value['code']}}"
                                                                    {{$country_code == $value['code'] ? 'selected' : ''}}
                                                            > {{$value['phone_code']}} <strong>({{$value['name']}})</strong>
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <input type="text" name="phone" class="form-control pl-3" value="{{old('phone')}}"
                                                       placeholder="Your Phone Number">
                                            </div>

                                            @error('phone')
                                            <p class="text-danger  mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="password" name="password"
                                                   placeholder="@lang('Password')">
                                            @error('password')
                                            <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control " type="password" name="password_confirmation"
                                                   placeholder="@lang('Confirm Password')">
                                        </div>
                                    </div>
                                </div>



                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <a class="btn-forgetpass"
                                           href="{{ route('login') }}">@lang("Already have account?")</a>
                                    </div>
                                </div>
                            </div>

                            <button class="btn mt-20" type="submit">@lang('Submit')</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /LOGIN-SIGNUP -->
@endsection
@push('script')
@endpush

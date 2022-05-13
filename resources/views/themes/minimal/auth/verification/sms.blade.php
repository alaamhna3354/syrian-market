@extends($theme.'layouts.app')
@section('title',$page_title)

@section('content')
    <!-- LOGIN-SIGNUP -->
    <section id="login-signup">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="wrapper">
                            <div class="login-info-wrapper">
                                <img src="{{asset(template(true).'images/verification.jpg')}}" alt="" class="w-100">
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-lg-7">
                    <div
                        class="form-wrapper w-100 h-100 d-flex flex-column align-items-start justify-content-center pl-65">
                        <h4 class="h4 text-uppercase mb-30">@lang($page_title)</h4>

                        <form method="POST" action="{{route('user.smsVerify')}}" class="form-content w-100">
                            @csrf
                            <div class="login">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="code" value="{{old('code')}}"  placeholder="@lang('Code')" autocomplete="off">
                                    @error('code')
                                    <p class="text-danger  mt-1">{{ trans($message) }}</p>
                                    @enderror
                                </div>


                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p>@lang('Didn\'t get Code? Click to') <a href="{{route('user.resendCode')}}?type=mobile"  class="btn-forgetpass text-primary"> @lang('Resend code')</a></p>
                                        @error('resend')
                                        <p class="text-danger  mt-1">{{ trans($message) }}</p>
                                        @enderror
                                        @error('error')
                                        <p class="text-danger  mt-1">{{ trans($message) }}</p>
                                        @enderror
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

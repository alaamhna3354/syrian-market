@extends($theme.'layouts.app')
@section('title','Reset Password')


@section('content')

    <!-- LOGIN-SIGNUP -->
    <section id="login-signup">
        <div class="container">
            <div class="row">


                @if(isset($templates['forget-password'][0]) && $content = $templates['forget-password'][0])
                    <div class="col-lg-5">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="wrapper">
                                <div class="login-info-wrapper">
                                    <h5 class="h5 mb-30">@lang(@$content->description->title)</h5>
                                    <p>@lang(@$content->description->description)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="col-lg-7">

                    <div class="form-wrapper w-100 h-100 d-flex flex-column align-items-start justify-content-center pl-65">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h4 class="h4 text-uppercase mb-30">@lang('Reset Password')</h4>




                        <form method="POST" action="{{ route('password.email') }}" class="form-content w-100">
                            @csrf
                            <div class="login">

                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}"
                                           placeholder="@lang('Enter your Email Address')">
                                    @error('email')
                                    <p class="text-danger  mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <div>
                                        <a class="btn-forgetpass"
                                           href="{{ route('register') }}">@lang("Don't have an account?")</a>
                                    </div>
                                </div>
                            </div>

                            <button class="btn mt-20" type="submit">@lang('Send Password Reset Link')</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /LOGIN-SIGNUP -->




@endsection


@extends($theme.'layouts.app')
@section('title','Reset Password')


@section('content')

    <!-- LOGIN-SIGNUP -->
    <section id="login-signup">
        <div class="container">
            <div class="row justify-content-center">


                <div class="col-lg-8">
                    <div
                        class="form-wrapper w-100 h-100 d-flex flex-column align-items-start justify-content-center pl-65">
                        <h4 class="h4 text-uppercase mb-30">@lang('Reset Password')</h4>


                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                {{ trans(session('status')) }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{route('password.update')}}" class="form-content w-100">
                            @csrf


                            @error('token')
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                {{ trans($message) }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            <div class="login">

                                <div class="form-group">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">


                                    <input class="form-control " type="password" name="password"
                                           placeholder="@lang('New Password')">
                                    @error('password')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <input class="form-control " type="password" name="password_confirmation"
                                           placeholder="@lang('Confirm Password')">
                                </div>

                            </div>


                            <button class="btn mt-20" type="submit">@lang('Reset Password')</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /LOGIN-SIGNUP -->


@endsection

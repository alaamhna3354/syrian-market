@extends($theme.'layouts.app')
@section('title','500')


@section('content')
    <section id="error">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">
                <div class="error-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.35s">
                    <div class="wrapper wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="error-heading">
                            <h1 class="h1">500</h1>
                        </div>
                    </div>
                    <div class="error-content mt-40 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.7s">
                        <h2 class="h2">@lang('opps!')</h2>
                        <h3 class="h3 mt-30 mb-30 font-weight-bold">@lang("Internal Server Error")</h3>
                        <p class="p mb-30">
                            @lang("The server encountered an internal error misconfiguration and was unable to complate your request. Please contact the server administrator.")
                        </p>
                        <a class="btn" href="{{url('/')}}">@lang('Back To Home')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /ERROR -->
@endsection

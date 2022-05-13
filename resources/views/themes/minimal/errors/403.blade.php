@extends($theme.'layouts.app')
@section('title','403 Forbidden')


@section('content')
    <section id="error">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">
                <div class="error-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.35s">
                    <div class="wrapper wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="error-heading">
                            <h1 class="h1">@lang('403 Forbidden')
                            </h1>
                        </div>
                    </div>
                    <div class="error-content mt-40 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.7s">
                        <h2 class="h2">@lang('opps!')</h2>
                        <h3 class="h3 mt-30 mb-30 font-weight-bold">@lang("You don’t have permission to access ‘/’ on this server.")</h3>
                        <a class="btn" href="{{url('/')}}">@lang('Back To Home')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /ERROR -->
@endsection

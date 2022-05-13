@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')

    <!-- POLICY -->
    <section id="policy">
        <div class="container">
            <h4 class="h4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">@lang(@$title)</h4>
            <p class="p mt-30 mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                @lang(@$description)
            </p>
        </div>
    </section>
    <!-- /POLICY -->


@endsection

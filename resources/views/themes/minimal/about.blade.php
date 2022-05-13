@extends($theme.'layouts.app')
@section('title','About Us')

@section('content')

    @include($theme.'sections.feature')
    @include($theme.'sections.about')

    @include($theme.'sections.counter')

    @include($theme.'sections.testimonial')

    @include($theme.'sections.gateways')
@endsection

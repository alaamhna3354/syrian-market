@extends($theme.'layouts.app')
@section('title','Home')

@section('content')
    @push('banner')
        @include($theme.'partials.heroBanner')
    @endpush


    @include($theme.'sections.feature')
    @include($theme.'sections.about')
    @include($theme.'sections.how-it-work')
    @include($theme.'sections.service')
    @include($theme.'sections.counter')
    @include($theme.'sections.call-to-action')
    @include($theme.'sections.testimonial')
    @include($theme.'sections.blog')

    @include($theme.'sections.gateways')




@endsection

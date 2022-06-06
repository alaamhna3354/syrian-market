@extends('user.layouts.app')
@section('title')
    @lang('Service')
@endsection
@section('content')

    <div class="contain-cards-order">
        <h3 class="text-white">@lang('Add Order')</h3>
        <div class="search">
            <input type="text" id="myInput">
            <button class="btn">@lang('search')</button>
        </div>
        <div class="cards-order" >
            @foreach($categories as $category)
            <a href="{{route('user.services.show',$category->id)}}" class="it" data-title="{{$category->category_title }}">
                <div class="item" >
                    <img src="{{ getFile(config('location.category.path').$category->image) }}" alt="user">
                    <div class="price">{{$category->category_title }}</div>
                </div>
            </a>
            @endforeach
        </div>
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
    </div>
@endsection
@push('js')
    <script>
    $("#myInput").on("keyup", function() {
    var value = this.value.toLowerCase().trim();
    $(".it").show().filter(function() {
        return $(this).attr("data-title").toLowerCase().trim().indexOf(value) == -1;
    }).hide();
    });
    $(window).on('scroll', function () {
	var scroll = $(window).scrollTop();
	if (scroll < 245) {
		$("#sticky-header").removeClass("sticky-menu");
		$('.scroll-to-target').removeClass('open');

	} else {
		$("#sticky-header").addClass("sticky-menu");
		$('.scroll-to-target').addClass('open');
	}
});
if ($('.scroll-to-target').length) {
  $(".scroll-to-target").on('click', function () {
    var target = $(this).attr('data-target');
    // animate
    $('html, body').animate({
      scrollTop: $(target).offset().top
    }, 1000);

  });
}
    </script>
@endpush


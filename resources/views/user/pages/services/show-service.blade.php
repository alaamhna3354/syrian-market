@extends('user.layouts.app')
@section('title')
    @lang('Service')
@endsection
@section('content')

    <div class="contain-cards-order">
        <h3 class="text-white">Add Order</h3>
        <div class="search">
            <input type="text">
            <button class="btn">search</button>
        </div>
        <div class="cards-order">
            @foreach($categories as $category)
            <a href="{{route('user.services.show',$category->id)}}">
                <div class="item">
                    <img src="{{ getFile(config('location.category.path').$category->image) }}" alt="user">
                    <div class="name">{{$category->category_title }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
@push('js')
    <script>

    </script>
@endpush


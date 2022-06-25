@extends('user.layouts.app')
@section('title')
    @lang('Dashboard')
@endsection
@section('content')
    <div class="container" id="main-dash">
        <div>
            <ol class="breadcrumb center-items">
                <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                <li class="active"> @lang('Dashboard')</li>
            </ol>
        </div>


        <div class="row my-4 admin-fa_icon">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card shadow ">
                    <div class="card-body">
                        <h3 class="text-white shadow-h  mb-1 w-100 text-truncate font-weight-medium">@lang('We will review and approve your application as soon as possible if it meets the required conditions')</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

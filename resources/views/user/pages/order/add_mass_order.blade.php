@extends('user.layouts.app')
@section('title')
    @lang('Mass Order')
@endsection
@section('content')


    <div class="container ">

        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang('Mass Order')</li>
        </ol>

        <div class="row my-3">
            <div class="col-md-12">




            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">@lang('Mass Order')</h4>

                    <p class="label label-default">@lang('Each Order On New Line')</p>

                    <div class="mass-order">
                        <form action="{{route('user.order.mass.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" rows="6" placeholder="e.g. 1 | 1199 | www.google.com" name="mass_order"></textarea>
                                @if($errors->has('mass_order'))
                                    <div class="error text-danger">@lang($errors->first('mass_order'))</div>
                                @endif
                            </div>
                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><span><i class="fas fa-save"></i> @lang('Save Changes')</span> </button>
                        </form>
                    </div>
                </div>
            </div>

            </div>

        </div>
    </div>


@endsection

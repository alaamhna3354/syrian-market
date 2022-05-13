@extends('user.layouts.app')
@section('title')
    @lang('Service')
@endsection

@section('content')
    <div class="container-fluid px-3 user-service-list">


        <div class="row   justify-content-between mx-lg-5">
            <div class="col-md-12">


                <ol class="breadcrumb center-items">
                    <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
                    <li class="active">@lang('Search Service')</li>
                </ol>


                <div class="card my-3">
                    <div class="card-body">
                        <form action="{{ route('user.service.search') }}" method="get">
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="service" value="{{@request()->service}}"
                                               class="form-control"
                                               placeholder="@lang('Search for Services')">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="category" id="category" class="form-control statusfield">
                                            <option value="">@lang('All Category')</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}" {{($category->id == @request()->category) ? 'selected' : ''}}>@lang($category->category_title)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn waves-effect waves-light w-100 btn-primary"><i
                                                class="fas fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3  justify-content-between mx-lg-5">
            <div class="col-md-12">

                @foreach($services as $key => $service)

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">@lang($key)</h4>

                            <div class="table-responsive ">
                                <table class="categories-show-table table  table-striped text-dark">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">@lang('ID')</th>
                                        <th scope="col" class="text-left">@lang('Name')</th>
                                        <th scope="col"
                                            class="text-center">@lang('Rate Per 1k')</th>
                                        <th scope="col" class="text-center">@lang('Min')</th>
                                        <th scope="col" class="text-center">@lang('Max')</th>
                                        <th scope="col" class="text-center">@lang('Description')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($service as $key => $row)
                                        <tr>
                                            <td data-label="@lang('ID')" class="text-center">{{$row->id}}</td>
                                            <td data-label="@lang('Name')" class="text-left">
                                                @lang($row->service_title)
                                            </td>
                                            <td data-label="@lang('Rate Per 1k')" class="text-center">
                                                @lang(config('basic.currency_symbol')){{$row->user_rate ?? $row->price}}

                                            </td>
                                            <td data-label="@lang('Min')" class="text-center">
                                                @lang($row->min_amount)
                                            </td>
                                            <td data-label="@lang('Max')" class="text-center">
                                                 @lang($row->max_amount)
                                            </td>

                                            <td data-label="@lang('Description')" class="text-center">
                                                <button type="button" class="btn btn-default btn-sm text-dark" data-toggle="modal"
                                                        data-target="#description"
                                                        id="details"
                                                        data-servicetitle="{{$row->service_title}}"
                                                        data-id="{{$row->id}}"
                                                        data-description="{{$row->description}}">
                                                    <i class="fa fa-eye"></i>
                                                    @lang('More')</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>


                @endforeach
            </div>
        </div>
    </div>




    <div class="modal fade" id="description">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="servicedescription">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <a href="" type="submit" class="btn btn-primary order-now">@lang('Order Now')</a>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '#details', function () {
                var title = $(this).data('servicetitle');
                var description = $(this).data('description');

                var id = $(this).data('id');
                var orderRoute = "{{route('user.order.create')}}" + '?serviceId=' + id;
                $('.order-now').attr('href', orderRoute);

                $('#title').text(title);
                $('#servicedescription').text(description);
            });
        });
    </script>
@endpush


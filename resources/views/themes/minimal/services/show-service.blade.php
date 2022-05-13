@extends($theme.'layouts.app')
@section('title','Services')
@section('content')

    <section class=" service-list">
        <div class="container-fluid px-3 user-service-list">

            <div class="row my-3 justify-content-between mx-lg-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('service.search') }}" method="get">
                                <div class="row justify-content-center">
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
                                            <button type="submit" class="btn btn-primary btn-padding w-100"><i
                                                    class="fas fa-search"></i> @lang('Search')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            @foreach($categories as $category)
                @if( 0 < count($category->service))
                    <div class="row my-3 justify-content-between mx-lg-5">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">{{$category->category_title }}
                                        <a class="show-hide-icon float-right" data-toggle="collapse"
                                           href="#col-{{$category->id}}"
                                           aria-expanded="true" aria-controls="col-{{$category->id}}">
                                            <i class="fas fa-chevron-down"></i>
                                        </a>
                                    </h4>


                                    <div class="table-responsive collapse show" id="col-{{$category->id}}">
                                        <table
                                            class="categories-show-table table  table-striped text-dark">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-center">@lang('ID')</th>
                                                <th scope="col" class="text-center">@lang('Name')</th>
                                                <th scope="col"
                                                    class="text-center">@lang('Rate Per 1K')</th>
                                                <th scope="col" class="text-center">@lang('Min')</th>
                                                <th scope="col" class="text-center">@lang('Max')</th>
                                                <th scope="col" class="text-center">@lang('Description')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($category->service as $service)
                                                <tr>
                                                    <td data-label="@lang('ID')" class="text-right text-md-center">{{$service->id}}</td>
                                                    <td data-label="@lang('Name')" class="text-right text-md-left">
                                                        @lang($service->service_title)
                                                    </td>
                                                    <td data-label="@lang('Rate Per 1k')" class="text-right text-md-center">
                                                        {{($service->user_rate) ?? $service->price}}{{config('basic.currency')}}
                                                    </td>
                                                    <td data-label="@lang('Min')" class="text-right text-md-center">
                                                        @lang($service->min_amount)
                                                    </td>
                                                    <td data-label="@lang('Max')" class="text-right text-md-center">
                                                         @lang($service->max_amount)
                                                    </td>

                                                    <td  data-label="@lang('Description')" class="text-right text-md-center">
                                                        <button type="button"
                                                                class="btn details bg-transparent btn-default btn-sm text-dark"
                                                                data-toggle="modal"
                                                                data-target="#description"
                                                                data-id="{{$service->id}}"
                                                                data-servicetitle="{{$service->service_title}}"
                                                                data-description="{{$service->description}}">
                                                            <i class="fa fa-eye"></i> @lang('More')</button>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </section>


    <div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="description"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header ">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="servicedescription">

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary btn-padding close"
                            data-dismiss="modal">@lang('Close')</button>
                    <a href="" type="submit" class="btn btn-sm btn-primary btn-padding order-now">@lang('Order Now')</a>
                </div>

            </div>
        </div>
    </div>

@endsection


@push('style')
    <style>
        .user-service-list .card-body thead th {
            background-color: #C1C7D0;
            border-color: #C1C7D0;
            color: #000;
        }
    </style>
@endpush
@push('script')
    <script>
        "use strict";
        $(document).on('click', '.details', function () {
            var title = $(this).data('servicetitle');
            var id = $(this).data('id');

            var orderRoute = "{{route('user.order.create')}}" + '?serviceId=' + id;
            $('.order-now').attr('href', orderRoute);

            var description = $(this).data('description');
            $('#title').text(title);
            $('#servicedescription').text(description);
        });
    </script>
@endpush

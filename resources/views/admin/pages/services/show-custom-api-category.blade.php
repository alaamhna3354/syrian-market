@extends('admin.layouts.app')
@section('title', $provider->api_name)
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-primary">
                    <tr class="text-center">
                        <th scope="col">@lang('ID')</th>
                        <th scope="col">@lang('Image')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Is Requires Player Name')</th>
                        <th scope="col">@lang('Min')</th>
                        <th scope="col">@lang('Max')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apiServiceLists as $service)
                        <tr>
                            <td class="text-center">{{$service['id']}}</td>

                            <td class="text-center">
                                <div class="chat-img d-inline-block">

                                    <img src="{{$service['image']}}"
                                         alt="user" class="rounded-circle" width="45">
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" data-container="body"  data-toggle="popover" data-placement="top" data-content="{{$service['name']}}">
                                    {{\Str::limit($service['name'], 30)}}
                                </a></td>
                            <td class="text-center">
                                {{isset($service['details']['requiresPlayerName']) ? ($service['details']['requiresPlayerName'] == 1 ? 'Yes' : 'No') : 'No'}}
                            </td>
                            <td class="text-center">
                                {{isset($service['details']['customAmount']['minAmount']) ? $service['details']['customAmount']['minAmount'] : '-'}}
                            </td>
                            <td class="text-center">
                                {{isset($service['details']['customAmount']['maxAmount']) ? $service['details']['customAmount']['maxAmount'] : '-'}}
                            </td>
                            <td class="text-center">
                                <div class="dropdown show">

                                    <a href="{{route('admin.import-custom-api-services-by-category',[$service['id'],$provider,isset($service['details']['customAmount']['minAmount']) ? $service['details']['customAmount']['minAmount'] : 0,isset($service['details']['customAmount']['maxAmount']) ? $service['details']['customAmount']['maxAmount'] : '0'])}}" class="dropdown-item">
                                        <i class="fas fa-plus text-success pr-2"></i> @lang('Get Services')</a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush


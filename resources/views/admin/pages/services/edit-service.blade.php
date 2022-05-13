@extends('admin.layouts.app')
@section('title')
    @lang('Edit Service')
@endsection
@section('content')
    <div class="card card-primary card-form m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body ">
            <form action="{{ route('admin.service.update') }} " method="POST" class="form">
                @csrf
                <h5 class="table-group-title text-info mb-2 mb-md-3"><span>@lang('Service Basic')</span></h5>
                <input type="hidden" name="id" value="{{$service->id}}">


                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group ">
                            <label>@lang('Service Title')</label>
                            <input type="text" name="service_title"
                                   value="{{old('service_title',$service->service_title)}}"
                                   class="form-control form-control-sm">
                            @if($errors->has('service_title'))
                                <div class="error text-danger">@lang($errors->first('service_title')) </div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Select Category')</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="{{old('category_id',$service->category_id)}}" selected
                                        hidden>@lang('Change Category')</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id  }}" @if($service->category_id == $category->id ) selected @endif>{{ $category->category_title  }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <div class="error text-danger">@lang($errors->first('category_id')) </div>
                            @endif
                        </div>

                    </div>
                </div>


                <div class="divider"></div>
                <h5 class="table-group-title text-primary mb-2 mb-md-3"><span>@lang('Price & Status')</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Minimum Amount')</label>
                            <input type="number" class="form-control square" name="min_amount"
                                   value="{{old('min_amount',$service->min_amount)}}">
                            @if($errors->has('min_amount'))
                                <div class="error text-danger">@lang($errors->first('min_amount')) </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('Rate per 1000') </label>
                            <input type="text" class="form-control square" name="price" placeholder="50.25"
                                   value="{{old('price',$service->price)}}">
                            @if($errors->has('price'))
                                <div class="error text-danger">@lang($errors->first('price')) </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Maximum Amount')</label>
                            <input type="number" class="form-control square" name="max_amount"
                                   value="{{old('max_amount',$service->max_amount)}}">
                            @if($errors->has('max_amount'))
                                <div class="error text-danger">@lang($errors->first('max_amount')) </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Status')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='service_status'>
                                        <input type="checkbox" name="service_status" class="custom-switch-checkbox"
                                               id="service_status"
                                               value="0" {{ $service->status == 0 ? 'checked': '' }} >
                                        <label class="custom-switch-checkbox-label" for="service_status">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Drip feed')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='drip_feed'>
                                        <input type="checkbox" name="drip_feed" class="custom-switch-checkbox"
                                               id="drip_feed" value="0" {{ $service->drip_feed == 0 ? 'checked': '' }} >
                                        <label class="custom-switch-checkbox-label" for="drip_feed">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <h5 class="table-group-title text-primary mb-2 mb-md-3"><span>@lang('Type & Details')</span></h5>
                <div class="form-group ">
                    <div class="switch-field d-flex">
                        <div class="form-check p-0">
                            <input class="form-check-input" type="radio" name="manual_api" id="less"
                                   value="0" {{$service->manual_api == 0 ? 'checked': ''}}>
                            <label class="form-check-label" for="less">
                                @lang('Manual')
                            </label>
                        </div>
                        <div class="form-check p-0">
                            <input class="form-check-input" type="radio" name="manual_api" id="more"
                                   value="1" {{$service->manual_api == 1 ? 'checked': ''}}>
                            <label class="form-check-label" for="more">
                                @lang('Api')
                            </label>
                        </div>
                    </div>
                </div>
                <div id="moreField d-none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label " for="apiprovider">@lang('API Provider Name')</label>
                                <select class="form-control" name="api_provider_id">
                                    <option value="0" hidden>@lang('Select API Provider name')</option>
                                    @foreach($apiProviders as $apiProvider)
                                        <option value="{{ $apiProvider->id  }}">{{ $apiProvider->api_name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('API Service ID')</label>
                                <input type="text" class="form-control square" name="api_service_id"
                                       value="{{old('api_service_id',$service->api_service_id)}}"
                                       placeholder="Api Service ID">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label " for="description">@lang('Description')</label>
                    <textarea class="form-control" rows="8"
                              name="description">{{ old('description',$service->description) }}</textarea>

                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3"><span><i class="fas fa-save pr-2"></i> @lang('Save Changes')</span>
                </button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        "use strict";
        $(document).ready(function (e) {

            $(document).on('click', '#more', function () {
                $("#moreField").fadeIn(1000);
            });

            $(document).on('click', '#less', function () {
                $("#moreField").fadeOut(1000);
            });

            $('#category_id').select2({
                selectOnClose: true
            });
        });
    </script>
@endpush

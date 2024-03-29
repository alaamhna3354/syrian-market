@extends('admin.layouts.app')
@section('title')
    @lang('Service')
@endsection
@section('content')


    <div class="card card-primary card-form m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body ">
            <form action="{{route('admin.service.store')}}" method="POST" class="form">
                @csrf
                <h5 class="table-group-title text-info mb-2 mb-md-3"><span>@lang('Service Basic')</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('Service Title')</label>
                            <input type="text" name="service_title" value="{{ old('service_title') }}"
                                   placeholder="@lang('Service Title')" class="form-control">
                            @if($errors->has('service_title'))
                                <div class="error text-danger">@lang($errors->first('service_title')) </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Select Category')</label>
                            <select class="form-control" id="category_id" name="category_id" onchange="showExtraField()">
                                <option disabled value="" selected hidden>@lang('Select Category')</option>
                                @foreach($categories as $key=>$categorie)
                                    <option value="{{ $categorie->id  }}" id="{{$categorie->type}}_{{$key}}">@lang($categorie->category_title)</option>
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
                                   value="{{ old('min_amount',1) }}">
                            @if($errors->has('min_amount'))
                                <div class="error text-danger">@lang($errors->first('min_amount')) </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('Price')</label>
                            <input type="text" class="form-control square" name="price" placeholder="0.00"
                                   value="{{ old('price') }}">
                            @if($errors->has('price'))
                                <div class="error text-danger">@lang($errors->first('price')) </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('Points')</label>
                            <input type="number" class="form-control square" name="points" placeholder="0"
                                   value="{{ old('points') }}">
                            @if($errors->has('points'))
                                <div class="error text-danger">@lang($errors->first('points')) </div>
                            @endif
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>@lang('Special Price')</label>--}}
{{--                            <input type="text" class="form-control square" name="special_price" placeholder="0.00"--}}
{{--                                   value="{{ old('special_price') }}">--}}
{{--                            @if($errors->has('special_price'))--}}
{{--                                <div class="error text-danger">@lang($errors->first('special_price')) </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Maximum Amount')</label>
                            <input type="number" class="form-control square" name="max_amount"
                                   value="{{ old('max_amount',500) }}">
                            @if($errors->has('max_amount'))
                                <div class="error text-danger">@lang($errors->first('max_amount')) </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('Agent Commission Rate')</label>
                            <input type="text" class="form-control square" name="agent_commission_rate" placeholder="0"
                                   value="{{ old('agent_commission_rate') }}">
                            @if($errors->has('agent_commission_rate'))
                                <div class="error text-danger">@lang($errors->first('agent_commission_rate')) </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Status')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='service_status'>
                                        <input type="checkbox" name="service_status" class="custom-switch-checkbox"
                                               id="service_status" value="0">
                                        <label class="custom-switch-checkbox-label" for="service_status">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Available')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='is_available'>
                                        <input type="checkbox" name="is_available" class="custom-switch-checkbox"
                                               id="is_available" value="0">
                                        <label class="custom-switch-checkbox-label" for="is_available">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="extra" style="display: none;">
                                <label>@lang('Select Country')</label>
                                <select class="form-control" id="country" name="country">
                                    <option disabled value="" selected hidden>@lang('Select Country')</option>
                                    @foreach(get5SimCountries() as $key=> $country)
                                        <option value="{{$key}}">{{$country}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('type'))
                                    <div class="error text-danger">@lang($errors->first('type')) </div>
                                @endif
                                <label>@lang('Select Product')</label>
                                <select class="form-control" id="product" name="product">
                                    <option disabled value="" selected hidden>@lang('Select Product')</option>
                                    @foreach(get5SimProducts() as  $product)
                                        <option value="{{$product}}">{{$product}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @foreach($ranges as $range)
                        <div class="form-group">
                            <label>@lang('Price') {{$range->name}}  </label>
                            <input type="text" class="form-control square" name="price_{{$range->id}}" placeholder="0.00"
                                   value="{{ old('price_'.$range->id) }}">
                            @if($errors->has('price_'.$range->id))
                                <div class="error text-danger">@lang($errors->first('price_'.$range->id)) </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @foreach($ranges as $range)
                            <div class="form-group">
                                <label>@lang('Agent Commission Rate') {{$range->name}}  </label>
                                <input type="text" class="form-control square" name="agent_commission_{{$range->id}}" placeholder="0.00"
                                       value="{{ old('agent_commission_'.$range->id) }}">
                                @if($errors->has('agent_commission_'.$range->id))
                                    <div class="error text-danger">@lang($errors->first('agent_commission_'.$range->id)) </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--<div class="divider"></div>--}}
                {{--<h5 class="table-group-title text-primary mb-2 mb-md-3"><span>@lang('Type & Details')</span></h5>--}}

                {{--<div class="form-group " hidden>--}}
                    {{--<div class="switch-field d-flex">--}}
                        {{--<div class="form-check p-0">--}}
                            {{--<input class="form-check-input" type="radio" name="manual_api" id="less" value="0" checked>--}}
                            {{--<label class="form-check-label" for="less">--}}
                                {{--@lang('Manual')--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="form-check p-0">--}}
                            {{--<input class="form-check-input" type="radio" name="manual_api" id="more" value="1">--}}
                            {{--<label class="form-check-label" for="more">--}}
                                {{--@lang('Api')--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label class="control-label " for="fieldone">@lang('Description')</label>
                    <textarea class="form-control" rows="4" placeholder="@lang('Description') " name="description"></textarea>

                    @if($errors->has('description'))
                        <div class="error text-danger">@lang($errors->first('description')) </div>
                    @endif
                </div>
                <div class="submit-btn-wrapper mt-md-3  text-center text-md-left">
                    <button type="submit" class="btn  btn-primary btn-block mt-3">
                        <span><i class="fas fa-save pr-2"></i> @lang('Save Changes')</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('js')
    <script>

        function showExtraField(){
            var opti = document.getElementById('category_id').options;
            opt=opti[opti.selectedIndex].id;
            // opt=opt.options[opt.selectedIndex].id;
            console.log(opt.includes('5SIM'))
            if (opt.includes('5SIM')){
                $('#extra').attr('style','display : block;');
                // $('#country').attr(require);
            }
            else {
                $('#extra').attr('style','display : none;')
            }

            console.log(opt)
        }

        $(document).ready(function () {
            "use strict";
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

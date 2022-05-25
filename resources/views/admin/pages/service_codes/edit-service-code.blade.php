@extends('admin.layouts.app')
@section('title')
    @lang('Edit Service Code')
@endsection
@section('content')


    <div class="card card-primary card-form m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body ">
            <form action="{{route('admin.service_codes.update')}}" method="POST" class="form">
                @csrf
                <h5 class="table-group-title text-info mb-2 mb-md-3"><span>@lang('Service Code')</span></h5>
                <input type="hidden" name="id" value="{{$service_code->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Select Service')</label>
                            <select class="form-control" id="service_id" name="service_id">
                                <option value="{{old('service_id',$service_code->service_id)}}" selected
                                        hidden>@lang('Change Service')</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id  }}">@lang($service->service_title)</option>
                                @endforeach
                            </select>
                            @if($errors->has('service_id'))
                                <div class="error text-danger">@lang($errors->first('service_id')) </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('CODE')</label>
                            <input type="text" name="code" value="{{old('code',$service_code->code)}}"
                                   placeholder="@lang('CODE')" class="form-control">
                            @if($errors->has('code'))
                                <div class="error text-danger">@lang($errors->first('code')) </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <h5 class="table-group-title text-primary mb-2 mb-md-3"><span>@lang('Status')</span></h5>
                <div class="row">

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Status')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='status'>
                                        <input type="checkbox" name="status" class="custom-switch-checkbox"
                                               id="status"
                                               value="0" {{ $service_code->is_active == 0 ? 'checked': '' }} >

                                        <label class="custom-switch-checkbox-label" for="status">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        $(document).ready(function () {
            "use strict";
            $(document).on('click', '#more', function () {
                $("#moreField").fadeIn(1000);
            });
            $(document).on('click', '#less', function () {
                $("#moreField").fadeOut(1000);
            });


            $('#service_id').select2({
                selectOnClose: true
            });

        });
    </script>



@endpush

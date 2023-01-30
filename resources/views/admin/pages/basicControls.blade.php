@extends('admin.layouts.app')
@section('title')
    @lang('Basic Controls')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <form method="post" action="{{route('admin.updateBasicControls')}}" novalidate="novalidate"
                  class="needs-validation base-form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Site Title')</label>
                        <input type="text" name="site_title"
                               value="{{ old('site_title') ?? $control->site_title ?? 'Site Title' }}"
                               class="form-control ">

                        @error('site_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('TimeZone')</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="time_zone">
                            <option disabled>Select Timezone</option>
                            @foreach ($control->time_zone_all as $time_zone_local)
                                <option
                                    value="{{ $time_zone_local }}" {{ $time_zone_local == $control->time_zone ? 'selected' : '' }}>@lang($time_zone_local)</option>
                            @endforeach
                        </select>

                        @error('time_zone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Base Currency')</label>
                        <input type="text" name="currency" value="{{ old('currency') ?? $control->currency ?? 'USD' }}"
                               required="required" class="form-control ">

                        @error('currency')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Currency Symbol')</label>
                        <input type="text" name="currency_symbol"
                               value="{{ old('currency_symbol') ?? $control->currency_symbol ?? '$' }}"
                               required="required" class="form-control ">

                        @error('currency_symbol')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Fraction number')</label>
                        <input type="text" name="fraction_number"
                               value="{{ old('fraction_number') ?? $control->fraction_number ?? '2' }}"
                               required="required" class="form-control ">
                        @error('fraction_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Paginate Per Page')</label>
                        <input type="text" name="paginate" value="{{ old('paginate') ?? $control->paginate ?? '2' }}"
                               required="required" class="form-control ">
                        @error('paginate')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Minimum balance to apply to join as an agent')</label>
                        <input type="text" name="min_balance" value="{{ old('min_balance') ?? $control->min_balance ?? '500' }}"
                               required="required" class="form-control ">
                        @error('min_balance')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('1 Kilo points equal in USD')</label>
                        <input type="number" name="points_rate_per_kilo" value="{{ old('1 Kilo points equal in USD') ?? $control->points_rate_per_kilo ?? 10 }}"
                               required="required" class="form-control ">
                        @error('points_rate_per_kilo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Marketer Joining Fee')</label>
                        <input type="number" name="marketer_joining_fee" value="{{ old('Marketer Joining Fee') ?? $control->marketer_joining_fee ?? 0 }}"
                               required="required" class="form-control ">
                        @error('marketer_joining_fee')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Golden Marketer Joining Fee')</label>
                        <input type="number" name="golden_marketer_joining_fee" value="{{ old('Golden Marketer Joining Fee') ?? $control->golden_marketer_joining_fee ?? 0 }}"
                               required="required" class="form-control ">
                        @error('golden_marketer_joining_fee')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-sm-3 col-12">
                        <label class="font-weight-bold">@lang('Min Points Allowed To Replace')</label>
                        <input type="number" name="min_points_allowed_to_replace" value="{{ old('Min Points Allowed To Replace') ?? $control->min_points_allowed_to_replace ?? '10' }}"
                               required="required" class="form-control ">
                        @error('min_points_allowed_to_replace')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                </div>


                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><span><i
                            class="fas fa-save pr-2"></i> @lang('Save Changes')</span></button>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function () {
            "use strict";
            $('select[name=time_zone]').select2({
                selectOnClose: true
            });
        });


    </script>
@endpush


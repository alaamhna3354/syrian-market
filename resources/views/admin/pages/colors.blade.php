@extends('admin.layouts.app')
@section('title')
    @lang('Color Settings')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <form method="post" action="" novalidate="novalidate"
                  class="needs-validation base-form">
                @csrf
                <div class="row">

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Primary color')</label>
                        <input type="color" name="primaryColor"
                               value="{{ old('primaryColor') ?? @$control->primaryColor ?? '#a460f2' }}"
                               required="required" class="form-control ">
                        @error('primaryColor')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Subheading color')</label>
                        <input type="color" name="subheading"
                               value="{{ old('subheading') ?? @$control->subheading ?? '#204dcc' }}"
                               required="required" class="form-control ">
                        @error('subheading')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Background left color')</label>
                        <input type="color" name="bggrdleft"
                               value="{{ old('bggrdleft') ?? @$control->bggrdleft ?? '#7C35FF' }}"
                               required="required" class="form-control ">
                        @error('bggrdleft')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Background Right color')</label>
                        <input type="color" name="bggrdright"
                               value="{{ old('bggrdright') ?? @$control->bggrdright ?? '#5900ff' }}"
                               required="required" class="form-control ">
                        @error('bggrdright')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Button left color')</label>
                        <input type="color" name="btngrdleft"
                               value="{{ old('btngrdleft') ?? @$control->btngrdleft ?? '#af61f5' }}"
                               required="required" class="form-control ">
                        @error('btngrdleft')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Background left 2 color')</label>
                        <input type="color" name="bggrdleft2"
                               value="{{ old('bggrdleft2') ?? @$control->bggrdleft2 ?? '#8340ff' }}"
                               required="required" class="form-control ">
                        @error('bggrdleft2')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">@lang('Copyrights Background')</label>
                        <input type="color" name="copyrights"
                               value="{{ old('copyrights') ?? @$control->copyrights ?? '#1d43db' }}"
                               required="required" class="form-control ">
                        @error('copyrights')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                </div>


                <button type="submit" class=" btn-primary btn-block mt-3"><span><i
                            class="fas fa-save pr-2"></i> @lang('Save Changes')</span></button>
            </form>
        </div>
    </div>
@endsection


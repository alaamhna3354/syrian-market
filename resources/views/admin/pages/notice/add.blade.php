@extends('admin.layouts.app')
@section('title')
    @lang('Add Notice')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">

        <div class="card-header bg-white ">
            <h3 class="card-title">@lang('Add Notice')
                <a class="btn btn-primary btn-sm float-right"
                   href="{{route('admin.notice')}}"><i
                        class="fa fa-eye " aria-hidden="true"></i> @lang('All Notice')</a>
            </h3>
        </div>

        <div class="card-body">


            <form method="post" action=" {{route('admin.notice.create')}} " enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('Title')</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                   class="form-control">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="form-group ">
                            <label>@lang('Highlight Text')</label>
                            <input type="text" name="highlight_text" value="{{ old('highlight_text') }}"
                                   required="required" class="form-control">
                            @error('highlight_text')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <label class="d-block">@lang('Status')</label>
                            <div class="custom-switch-btn w-100">
                                <input type='hidden' value='1' name='status'>
                                <input type="checkbox" name="status" class="custom-switch-checkbox" id="status"
                                       value="0">
                                <label class="custom-switch-checkbox-label" for="status">
                                    <span class="custom-switch-checkbox-inner"></span>
                                    <span class="custom-switch-checkbox-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="category_description">@lang('details')</label>
                    <textarea class="form-control" id="summernote" rows="10" name="details">{{ old('details') }}</textarea>
                    <div class="invalid-feedback">@lang('Please fill in the description')</div>

                    @error('details')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                    <button type="submit" class=" btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                        <span>@lang('Save Notice')</span></button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">
@endpush
@push('js')
    <script src="{{ asset('assets/global/js/summernote.min.js')}}"></script>
    <script>
        "use strict";
        $(document).ready(function () {

                 $('#summernote').summernote({
                        callbacks: {
                            onBlurCodeview: function() {
                                let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                                $(this).val(codeviewHtml);
                            }
                        }
                });
        });
    </script>
@endpush

@extends('user.layouts.app')
@section('title')
    @lang($page_title)
@endsection
@section('content')


    <div class="container">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="active">@lang($page_title)</li>
        </ol>
        <div class="row my-3">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{route('user.ticket.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group ">
                                <label>@lang('Subject')</label>
                                <input class="form-control" type="text" name="subject" value="{{old('subject')}}" placeholder="@lang('Enter Subject')">
                                @error('subject')
                                <div class="error text-danger">@lang($message) </div>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label>@lang('Message')</label>
                                <textarea class="form-control" name="message" rows="5"  placeholder="@lang('Enter Message')">{{old('message')}}</textarea>
                                @error('message')
                                <div class="error text-danger">@lang($message) </div>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('Upload')</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input upload-box" id="upload"
                                               name="attachments[]"
                                               multiple>
                                        <label class="custom-file-label"
                                               for="inputGroupFile01">@lang('Choose file')</label>
                                    </div>

                                </div>

                                <p class="text-danger select-files-count"></p>

                                @error('attachments')
                                <div class="error text-danger">@lang($message) </div>
                                @enderror
                            </div>


                            <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                                <button type="submit"
                                        class=" btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                                    <span>@lang('Submit')</span></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

@push('js')

    <script>
        $(document).ready(function () {
            'use strict';
            $(document).on('change', '#upload', function () {
                var fileCount = $(this)[0].files.length;
                $('.select-files-count').text(fileCount + ' file(s) selected')
            })
        });
    </script>

@endpush

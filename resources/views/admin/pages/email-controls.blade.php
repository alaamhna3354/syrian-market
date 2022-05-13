@extends('admin.layouts.app')
@section('title')
    @lang('Email Controls')
@endsection
@section('content')
<div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> @lang('SHORTCODE') </th>
                        <th> @lang('DESCRIPTION') </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><pre>@lang(' [[name]] ')</pre></td>
                        <td> @lang("User's Name will replace here.") </td>
                    </tr>
                    <tr>
                        <td><pre>@lang(' [[message]] ')</pre></td>
                        <td>@lang("Application notification message will replace here.")</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <form action="" method= "POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('From Email')</label>
                            <input type="text" name="sender_email" class="form-control" placeholder="@lang('Email Address')" value="{{$control->sender_email}}">
                            @error('sender_email')
                            <span class="text-danger">{{ trans($message) }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('From Email Name')</label>
                            <input type="text" name="sender_email_name" class="form-control" placeholder="@lang('Email Address')" value="{{$control->sender_email_name}}">
                            @error('sender_email_name')
                            <span class="text-danger">{{ trans($message) }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-3 d-none">
                        <div class="form-group">
                            <label>{{trans('Send Email Method')}}</label>
                            <select name="email_method" class="form-control" >
                                <option value="sendmail" @if(old('email_method', @$control->email_configuration->name) == "sendmail")  selected @endif>@lang('PHP Mail')</option>
                                <option value="smtp" @if( old('email_method', @$control->email_configuration->name) == "smtp") selected @endif>@lang('SMTP')</option>
                            </select>

                            @error('email_method')
                            <span class="text-danger">{{ trans($message) }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row mt-4 d-none configForm" id="smtp">
                    <div class="col-md-12">
                        <h6 class="mb-2">{{trans('SMTP Configuration')}}</h6>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">{{trans('Host')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="@lang('Host or Email Address')" name="smtp_host" value="{{ old('smtp_host', $control->email_configuration->smtp_host ?? '') }}"/>
                        @error('smtp_host')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">{{trans('Port')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="@lang('Available port')" name="smtp_port" value="{{ old('smtp_port', $control->email_configuration->smtp_port ?? '') }}"/>
                        @error('smtp_port')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">{{trans('Encryption')}}</label>

                        <select name="smtp_encryption" class="form-control" >
                            <option value="tls" @if( old('smtp_encryption', @$control->email_configuration->smtp_encryption) == "tls") selected @endif>@lang('tls')</option>
                            <option value="ssl" @if( old('smtp_encryption', @$control->email_configuration->smtp_encryption) == "ssl") selected @endif>@lang('ssl')</option>
                        </select>

                        @error('smtp_encryption')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">{{trans('Username')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="@lang('username or Email')" name="smtp_username" value="{{ old('smtp_username', $control->email_configuration->smtp_username ?? '') }}"/>
                        @error('smtp_username')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">{{trans('Password')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="@lang('Password')" name="smtp_password" value="{{ old('smtp_password', $control->email_configuration->smtp_password ?? '') }}"/>
                        @error('smtp_password')
                        <span class="text-danger">{{ trans($message) }}</span>
                        @enderror
                    </div>
                </div>



                <div class="form-group ">
                    <label>@lang('Email Description')</label>
                    <textarea class="form-control summernote" name="email_description" id="summernote" placeholder="@lang('Email Description')" rows="20"><?php echo  $email_description ?></textarea>
                </div>
                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><span>@lang('Save Changes')</span> </button>
            </form>
        </div>
    </div>

@endsection


@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">
@endpush
@push('js-lib')
    <script src="{{ asset('assets/global/js/summernote.min.js')}}"></script>
@endpush
@push('js')
    <script>
        "use strict";
        $(document).ready(function() {

                 $('#summernote').summernote({
                        callbacks: {
                            onBlurCodeview: function() {
                                let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                                $(this).val(codeviewHtml);
                            }
                        }
                });
        });
        $('select[name=email_method]').on('change', function() {
            var method = $(this).val();

            $('.configForm').addClass('d-none');
            if(method != 'sendmail') {
                $(`#${method}`).removeClass('d-none');
            }
        }).change();


    </script>
@endpush

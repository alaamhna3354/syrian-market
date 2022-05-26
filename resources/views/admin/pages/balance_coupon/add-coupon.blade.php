@extends('admin.layouts.app')
@section('title')
    @lang('Category')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <form method="post" action=" {{ route('admin.balance-coupon.store') }} " enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <div class="image-input ">
                                <label for="image-upload" id="image-label"><i class="fas fa-upload"></i></label>
                                <input type="file" name="image" placeholder="Choose image" id="image">
                                <img id="image_preview_container" class="preview-image"
                                     src="{{ getFile(config('location.default')) }}"
                                     alt="preview image">
                            </div>

                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group ">
                            <label>@lang('Coupon Code')</label>
                            <input type="text" name="code" value="{{substr(md5(microtime()),rand(0,26),8)}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Code')</div>
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label>@lang('Balance')</label>
                            <input type="text" name="balance" value="{{old('balance')}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Balance')</div>
                            @error('balance')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label class="d-block">@lang('Status')</label>
                            <div class="custom-switch-btn w-md-25">
                                <input type='hidden' value='1' name='status'>
                                <input type="checkbox" name="status" class="custom-switch-checkbox" id="status"
                                       value="0">
                                <label class="custom-switch-checkbox-label" for="status">
                                    <span class="custom-switch-checkbox-inner"></span>
                                    <span class="custom-switch-checkbox-switch"></span>
                                </label>
                            </div>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                            <button type="submit"
                                    class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                                <span>@lang('Add Coupon')</span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function showExtraField() {
            var opt = document.getElementById('type').value;
            if (opt == "BALANCE" || opt == "OTHER") {
                $('#extra-field').attr('style', 'display : block;')

            } else {
                $('#extra-field').attr('style', 'display : none;')
            }
            console.log(opt)
        }

        "use strict";
        $(document).ready(function (e) {
            $('#type').select2({
                selectOnClose: true
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#image').on('change', function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#upload_image_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('photo')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('Image has been uploaded successfully');
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush


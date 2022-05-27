@extends('admin.layouts.app')
@section('title')
    @lang('Category')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <form method="post" action=" {{ route('admin.coupon.update',$coupon->id) }} " enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group ">
                            <label>@lang('Coupon Code')</label>
                            <input type="text" name="code" value="{{old('code',$coupon->code)}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Code')</div>
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label>@lang('Sale')</label>
                            <input type="text" name="sale" value="{{old('sale',$coupon->sale)}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Balance')</div>
                            @error('sale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label>@lang('Number Of Beneficiaries')</label>
                            <input type="number" name="number_of_beneficiaries" value="{{old('number_of_beneficiaries',$coupon->number_of_beneficiaries)}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Balance')</div>
                            @error('number_of_beneficiaries')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group ">
                            <label>@lang('From')</label>
                            <input type="datetime-local" name="from" value="{{old('from',$coupon->from != null ?date('Y-m-d\TH:i:s',strtotime($coupon->from)) : "")}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Code')</div>
                            @error('from')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label>@lang('To')</label>
                            <input type="datetime-local" name="to" value="{{old('from',$coupon->to != null ?date('Y-m-d\TH:i:s',strtotime($coupon->to)) : "")}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Code')</div>
                            @error('to')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Status')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='status'>
                                        <input type="checkbox" name="status" class="custom-switch-checkbox" id="status" value = "0" {{ $coupon->status == 0 ? 'checked': '' }} >
                                        <label class="custom-switch-checkbox-label" for="status">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="d-block">@lang('Percentage')</label>
                                    <div class="custom-switch-btn">
                                        <input type='hidden' value='1' name='is_percent'>
                                        <input type="checkbox" name="is_percent" class="custom-switch-checkbox" id="is_percent" value = "0" {{ $coupon->is_percent == 0 ? 'checked': '' }} >
                                        <label class="custom-switch-checkbox-label" for="is_percent">
                                            <span class="custom-switch-checkbox-inner"></span>
                                            <span class="custom-switch-checkbox-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{old('id',$coupon->id)}}" required="required" class="form-control form-control-sm">
                    <div class="col-sm-6 col-md-12">
                        <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                            <button type="submit"
                                    class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                                <span>@lang('Update Coupon')</span></button>
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


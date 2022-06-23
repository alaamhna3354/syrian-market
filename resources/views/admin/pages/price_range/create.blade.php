@extends('admin.layouts.app')
@section('title')
    @lang('Price Range')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <form method="post" action=" {{ route('admin.price_range.store') }} " enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group ">
                            <label>@lang('Name')</label>
                            <input type="text" name="name" value="{{old('name')}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Name')</div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label>@lang('Min Total Amount')</label>
                            <input type="text" name="min_total_amount" value="{{old('min_total_amount')}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Min Total Amount')</div>
                            @error('min_total_amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group ">
                            <label>@lang('Limit Days')</label>
                            <input type="number" name="limit_days" value="{{old('limit_days')}}"
                                   class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the Limit Days')</div>
                            @error('limit_days')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-12">
                        <div class="submit-btn-wrapper mt-md-5 text-center text-md-left">
                            <button type="submit"
                                    class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                                <span>@lang('Create Price Range')</span></button>
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


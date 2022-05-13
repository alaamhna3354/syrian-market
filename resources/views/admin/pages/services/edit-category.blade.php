@extends('admin.layouts.app')
@section('title')
    @lang('Category')
@endsection
@section('content')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
        <div class="card-body">
            <form method="post" action=" {{ route('admin.category.update') }} " enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <div class="image-input ">
                                <label for="image-upload" id="image-label"><i class="fas fa-upload"></i></label>
                                <input type="file" name="image" placeholder="Choose image" id="image">
                                <img src="{{ getFile(config('location.category.path').$category->image)}}" alt="category thum" id="image_preview_container" class="img-fluid preview-image">


                            </div>

                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group ">
                            <label>@lang('Category Title')</label>
                            <input type="text" name="category_title" value="{{old('category_title',$category->category_title)}}" required="required" class="form-control form-control-sm">
                            <div class="invalid-feedback">@lang('Please fill in the site title')</div>
                            @error('category_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_description">@lang('Category Description')</label>
                            <textarea class="form-control" id="category_description" rows="5" name="category_description">{{old('category_description',$category->category_description)}}</textarea>
                            <div class="invalid-feedback">@lang('Please fill in the category description')</div>

                            @error('category_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label class="d-block">@lang('Status')</label>
                            <div class="custom-switch-btn w-md-25">
                                <input type='hidden' value='1' name='status'>
                                <input type="checkbox" name="status" class="custom-switch-checkbox" id="status" value = "0" {{ $category->status == 0 ? 'checked': '' }} >
                                <label class="custom-switch-checkbox-label" for="status">
                                    <span class="custom-switch-checkbox-inner"></span>
                                    <span class="custom-switch-checkbox-switch"></span>
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{old('id',$category->id)}}" required="required" class="form-control form-control-sm">
                        <div class="submit-btn-wrapper mt-md-5 mt-0 text-center text-md-left">
                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3"><span>@lang('Update Category')</span> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
     <script>
         "use strict";
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $('#image').on('change',function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#upload_image_form').on('submit',function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:'POST',
                    url: "{{ url('photo')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                    },
                    error: function(data){
                    console.log(data);
                    }
                });
            });

        });
     </script>
@endpush

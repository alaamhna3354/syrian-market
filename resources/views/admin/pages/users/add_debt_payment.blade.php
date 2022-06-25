@extends('admin.layouts.app')
@section('title')
    @lang('Add Debt Payment')
@endsection
@section('content')


    <div class="card card-primary card-form m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body ">
            <form action="{{route('admin.pay-a-debt',$user->id)}}" method="POST" class="form">
                @csrf
                <h5 class="table-group-title text-info mb-2 mb-md-3"><span>@lang('Add Debt Payment')</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>@lang('Total amount')</label>
                            <input type="text" name="amount" value="{{ old('amount') }}"
                                   placeholder="@lang('Total amount')" class="form-control">
                            @if($errors->has('amount'))
                                <div class="error text-danger">@lang($errors->first('amount')) </div>
                            @endif
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

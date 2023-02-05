@extends('user.layouts.app')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection
@section('content')
    <div class="container">
        <ol class="breadcrumb center-items">
            <li><a href="{{route('user.home')}}">@lang('Home')</a></li>
            <li class="custom-breadcrumb-li"><a href="{{route('user.addFund')}}"
                                                class="text-white">@lang('Add Fund')</a></li>
            <li class="active">@lang(optional($order->gateway)->name)</li>
        </ol>

        <div class="row my-3">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body" style="background: #00000077;color: aliceblue;">
                        <div class="row">
                            <div class="col-md-12">
                                @if($order->gateway->payment_info)
                                    <span>@lang('Payment address')</span> : {{$order->gateway->payment_info}}
                                        <i class="fa fa-copy" style="font-size: 16px;"
                                           onclick="copy('{{$order->gateway->payment_info}}')"></i>

                                @endif
                                <h3 class="title text-center">{{trans('Please follow the instruction below')}}</h3>
                                <p class="text-center mt-2 ">{{trans('You have requested to deposit')}} <b
                                            class="text--base">{{getAmount($order->amount)}}
                                        {{$basic->currency}}</b> , {{trans('Please pay')}}
                                    <b class="text--base">{{getAmount($order->final_amount)}} {{$order->gateway_currency}}</b> {{trans('for successful payment')}}
                                </p>

                                <p class=" mt-2 ">
                                    <?php echo optional($order->gateway)->note; ?>
                                </p>

                                <form action="" method="post" enctype="multipart/form-data"
                                      class="form-row  preview-form">
                                    @csrf
                                    @if(optional($order->gateway)->parameters)
                                        @foreach($order->gateway->parameters as $k => $v)
                                            @if($v->type == "text")
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group  ">
                                                        <label>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                <span class="text--danger">*</span>  @endif </label>
                                                        <input type="text" name="{{$k}}"
                                                               class="form-control bg-transparent"
                                                               @if($v->validation == "required") required @endif>
                                                        @if ($errors->has($k))
                                                            <span class="text--danger">{{ trans($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif($v->type == "textarea")
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <label>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                <span class="text--danger">*</span>  @endif </label>
                                                        <textarea name="{{$k}}" class="form-control bg-transparent"
                                                                  rows="3"
                                                                  @if($v->validation == "required") required @endif></textarea>
                                                        @if ($errors->has($k))
                                                            <span class="text--danger">{{ trans($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif($v->type == "file")
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                                            <label>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                                    <span class="text--danger">*</span>  @endif </label>
                                                            <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                                 data-trigger="fileinput">
                                                                <img class="w-150px"
                                                                     src="{{ getFile(config('location.default')) }}"
                                                                     alt="..." width="200px">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail wh-200-150 "></div>

                                                            <div class="img-input-div">
                                                                <span class="btn btn-success btn-file">
                                                                    <span
                                                                            class="fileinput-new "> @lang('Select') {{$v->field_level}}</span>
                                                                    <span
                                                                            class="fileinput-exists"> @lang('Change')</span>
                                                                    <input type="file" name="{{$k}}" accept="image/*"
                                                                           @if($v->validation == "required") required @endif>
                                                                </span>
                                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                                   data-dismiss="fileinput"> @lang('Remove')</a>
                                                            </div>

                                                        </div>
                                                        @if ($errors->has($k))
                                                            <br>
                                                            <span
                                                                    class="text--danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif


                                    <div class="col-md-12 ">
                                        <div class=" form-group">
                                            <button type="submit" class="btn-primary btn  w-100 mt-3">
                                                <span>@lang('Confirm Now')</span>
                                            </button>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap-fileinput.css')}}">

@endpush

@push('js-lib')
    <script src="{{ asset('assets/global/js/bootstrap-fileinput.js') }}"></script>
@endpush
@push('js')
    <script>
        function copy($link) {
            console.log($link)
            /* Copy the text inside the text field */
            navigator.clipboard.writeText($link);
            Toastify({
                text: "تم النسخ",
                duration: 3000
            }).showToast();
        }
    </script>
@endpush
@extends('user.layouts.app')
@section('title', 'Warning')
@section('content')

    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <h1 class="text-center text-warning" style="margin-top: 30px;"><i class="fa fa-warning"></i>
                Warning
            </h1>
            <h4 class="text-center">Uh-ho! We are unable to process your Payment by this method.
                <br>This method is under construction!!
            </h4>
            <br>
            <h4 class="text-center">Select <b>bkash</b> as your payment method.</h4>
            <div class="col-md-8 col-md-offset-2">


            <div class="panel panel-info">
                <div class="panel-body">

                        <div class="text-center">
                                <a href="{{ route('deposit.confirm',["bkash",session()->get('id')]) }}">
                                    <img src="{{ asset('assets/upload/logo/bkash.png') }}" style="max-width: 100px;">
                                </a>
                        </div>
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

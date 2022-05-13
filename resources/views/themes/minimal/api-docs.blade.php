@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('content')

    <!-- POLICY -->
    <section id="policy">
        <div class="container">
            <h4 class="h4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">@lang(@$title)</h4>

        </div>


        <!--API DETAILS-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details">
                        <div class="card-header">

                            <h5 class="card-title text-white">@lang('API DETAILS')</h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>@lang('API URL')</h6>
                                    <p>{{ route('userApiKey') }}</p>
                                </div>
                                <div class="col-sm-12">
                                    <h6>@lang('API KEY')</h6>
                                    <p>
                                        @lang('Your API Key')
                                    </p>
                                </div>
                                <div class="col-sm-3">
                                    <h6>@lang('HTTP METHOD')</h6>
                                    <p>@lang('POST')</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6>@lang('RESPONSE FORMAT')</h6>
                                    <p>@lang('JSON')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--PLACE NEW ORDER-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details mb-0">
                        <div class="card-header">

                        <h5 class="card-title text-white">@lang('PLACE NEW ORDER')</h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase">@lang('key')</h6>
                                    <p>@lang('Your API key')</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase">@lang('action')</h6>
                                    <p>
                                        @lang('add')
                                    </p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase">@lang('service')</h6>
                                    <p>@lang('Service ID')</p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase">@lang('link')</h6>
                                    <p>@lang('Link to page')</p>
                                </div>

                                <div class="col-sm-3">
                                    <h6 class="text-lowercase">@lang('quantity')</h6>
                                    <p>@lang('Needed quantity')</p>
                                </div>

                                <div class="col-sm-3">
                                    <h6 class="text-lowercase">@lang('runs')
                                        <small class="text-muted">@lang('(optional)')</small>
                                    </h6>
                                    <p>@lang('Runs to deliver')</p>
                                </div>

                                <div class="col-sm-3">
                                    <h6 class="text-lowercase">@lang('interval')
                                        <small class="text-muted">@lang('(optional)')</small>
                                    </h6>
                                    <p>@lang('Interval in minutes')</p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text-white">
{
    "status": "success",
    "order": 116
}
</pre>
                    </div>
                </div>
            </div>
        </div>



        <!--STATUS ORDER-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details mb-0">
                        <div class="card-header">

                        <h5 class="card-title text-white">@lang('STATUS ORDER')</h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('key')</h6>
                                    <p>@lang('Your API key')</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('action')</h6>
                                    <p>
                                        @lang('status')
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('order')</h6>
                                    <p>@lang('Order ID')</p>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text-white">
{
    "status": "processing",
    "charge": "3.60",
    "start_count": 0,
    "remains": 0,
    "currency": "BDT"
}
</pre>
                    </div>

                </div>
            </div>
        </div>



        <!--MULTIPLE STATUS ORDER-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details mb-0">
                        <div class="card-header">

                        <h5 class="card-title text-white">@lang('MULTIPLE STATUS ORDER')</h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('key')</h6>
                                    <p>@lang('Your API key')</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('action')</h6>
                                    <p>
                                        @lang('status')
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('orders')</h6>
                                    <p>@lang('Order IDs separated by comma (array data)')</p>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="api-code mt-2 mb-5">
                        <p class="text-danger">//Response (error)</p>
                        <pre class="text-white">{
    "errors": {
        "key": ["The key field is required."],
        "action": ["The action field is required."]
    }
}</pre>


                        <p class="text-success">//response (result)</p>

                        <pre class="text-white">[
    {
        "order": 116,
        "status": "processing",
        "charge": "3.60",
        "start_count": 0,
        "remains": 0
    },
    {
        "order": 117,
        "status": "processing",
        "charge": null,
        "start_count": 0,
        "remains": 0
    }
]</pre>
                    </div>

                </div>
            </div>
        </div>


        <!--SERVICE LIST-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details mb-0">
                        <div class="card-header">
                        <h5 class="card-title text-white">@lang('SERVICE LIST')</h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('key')</h6>
                                    <p>@lang('Your API key')</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('action')</h6>
                                    <p>
                                        @lang('services')
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text-white">[
    {
        "service": 1,
        "name": "🙋‍♂️ Followers [Ultra-High Quality Profiles]",
        "category": "🥇 [VIP]\r\n",
        "rate": "4.80",
        "min": 100,
        "max": 10000
    },
    {
        "service": 11,
        "name": "🧨 Instagram Power Comments (100k+ Accounts) ➡️ [3 Comments]",
        "category": "💬 Instagram - Verified / Power Comments [ Own Service ]",
        "rate": "0.60",
        "min": 500,
        "max": 5000
    },
    {
        "service": 52,
        "name": "🎙️ Facebook Live Stream Views ➡️ [ 120 Min ]",
        "category": "🔵 Facebook - Live Stream Views\r\n",
        "rate": "57.60",
        "min": 50,
        "max": 2000
    }
]</pre>
                    </div>

                </div>
            </div>
        </div>


        <!--USER BALANCE-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details mb-0">
                        <div class="card-header">

                        <h5 class="card-title text-white">@lang('USER BALANCE')</h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('key')</h6>
                                    <p>@lang('Your API key')</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase">@lang('action')</h6>
                                    <p>
                                        @lang('balance')
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text-white">
{
  "status": "success",
  "balance": "0.03",
  "currency": "USD"
}
</pre>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- /POLICY -->



@endsection

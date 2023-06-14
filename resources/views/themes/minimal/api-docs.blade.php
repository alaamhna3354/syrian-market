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
                    <div class="card api-details" style="background-color: #0b0b0b">
                        <div class="card-header">

                            <h5 class="card-title text-white">API DETAILS</h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>API URL</h6>
                                    <p>{{ route('userApiKey') }}</p>
                                </div>
                                <div class="col-sm-12">
                                    <h6> API KEY </h6>
                                    <p>
                                         Your API Key
                                    </p>
                                </div>
                                <div class="col-sm-3">
                                    <h6> HTTP METHOD </h6>
                                    <p> POST </p>
                                </div>
                                <div class="col-sm-3">
                                    <h6> RESPONSE FORMAT </h6>
                                    <p> JSON </p>
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
                    <div class="card api-details mb-0" style="background-color: #0b0b0b">
                        <div class="card-header">

                        <h5 class="card-title text-white"> PLACE NEW ORDER </h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase"> key </h6>
                                    <p> Your API key </p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase"> action </h6>
                                    <p>
                                         add
                                    </p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase"> service </h6>
                                    <p> Service ID </p>
                                </div>
                                <div class="col-sm-3">
                                    <h6 class="text-lowercase"> link </h6>
                                    <p> Link to page,player name or account number </p>
                                    <p>if null keep it -1</p>
                                </div>

                                <div class="col-sm-3">
                                    <h6 class="text-lowercase"> quantity </h6>
                                    <p> Needed quantity </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text">
{
    "status": "success",
    "order": 12,
    "code": null,
    "details": null,
    "order_status": "processing",
    "price": 0.32
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
                    <div class="card api-details mb-0" style="background-color: #0b0b0b">
                        <div class="card-header">

                        <h5 class="card-title text-white"> STATUS ORDER </h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase"> key </h6>
                                    <p> Your API key </p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase"> action </h6>
                                    <p>
                                         status
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase"> order </h6>
                                    <p> Order ID </p>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text">
{
    "status": "completed",
    "currency": "USD",
    "order": 33200,
    "code": "12899088888",
    "details": null,
    "price": 1
}
</pre>
                    </div>

                </div>
            </div>
        </div>



{{--        <!--MULTIPLE STATUS ORDER-->--}}
{{--        <div class="container ">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="card api-details mb-0" style="background-color: #0b0b0b">--}}
{{--                        <div class="card-header">--}}

{{--                        <h5 class="card-title text-white"> MULTIPLE STATUS ORDER </h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-body content">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <h6 class="text-lowercase"> key </h6>--}}
{{--                                    <p> Your API key </p>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <h6 class="text-lowercase"> action </h6>--}}
{{--                                    <p>--}}
{{--                                         status--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <h6 class="text-lowercase"> orders </h6>--}}
{{--                                    <p> Order IDs separated by comma (array data) </p>--}}
{{--                                </div>--}}


{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="api-code mt-2 mb-5">--}}
{{--                        <p class="text-danger">//Response (error)</p>--}}
{{--                        <pre class="text-white">{--}}
{{--    "errors": {--}}
{{--        "key": ["The key field is required."],--}}
{{--        "action": ["The action field is required."]--}}
{{--    }--}}
{{--}</pre>--}}


{{--                        <p class="text-success">//response (result)</p>--}}

{{--                        <pre class="text-white">[--}}
{{--    {--}}
{{--        "order": 116,--}}
{{--        "status": "processing",--}}
{{--        "charge": "3.60",--}}
{{--        "start_count": 0,--}}
{{--        "remains": 0--}}
{{--    },--}}
{{--    {--}}
{{--        "order": 117,--}}
{{--        "status": "processing",--}}
{{--        "charge": null,--}}
{{--        "start_count": 0,--}}
{{--        "remains": 0--}}
{{--    }--}}
{{--]</pre>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <!--SERVICE LIST-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details mb-0" style="background-color: #0b0b0b">
                        <div class="card-header">
                        <h5 class="card-title text-white"> SERVICE LIST </h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase"> key </h6>
                                    <p> Your API key </p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase"> action </h6>
                                    <p>
                                         services
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text">[
   {
        "service": 12,
        "name": "325 UC",
        "category": "pubg",
        "category_id": {
            "id": 1,
            "category_title": "pubg",
            "category_description": "لعبة بوبجي العالمية",
            "image": "62cdeeaabe8021657663146.jpeg",
            "status": "1",
            "type": "GAME",
            "special_field": null,
            "sort": null,
            "slug": "pubg"
        },
        "rate": "4.19",
        "min": 1,
        "max": 500,
        "is_available": 1
    },
    {
        "service": 13,
        "name": "660 UC",
        "category": "pubg",
        "category_id": {
            "id": 1,
            "category_title": "pubg",
            "category_description": "لعبة بوبجي العالمية",
            "image": "62cdeeaabe8021657663146.jpeg",
            "status": "1",
            "type": "GAME",
            "special_field": null,
            "sort": null,
            "slug": "pubg"
        },
        "rate": "8.3",
        "min": 1,
        "max": 500,
        "is_available": 1
    },
]</pre>
                    </div>

                </div>
            </div>
        </div>


        <!--USER BALANCE-->
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card api-details mb-0" style="background-color: #0b0b0b">
                        <div class="card-header">

                        <h5 class="card-title text-white"> USER BALANCE </h5>
                        </div>
                        <div class="card-body content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase"> key </h6>
                                    <p> Your API key </p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="text-lowercase"> action </h6>
                                    <p>
                                         balance
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="api-code mt-2 mb-5">
                        <p class="text-success">//Example response</p>
                        <pre class="text">
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

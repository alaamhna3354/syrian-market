<!-- WORK-WITH -->
<section id="work-with">
    <div class="container">
        <div class="heading-container">
            <h3 class="slogan">{{trans('We Accept')}}</h3>
        </div>

        <div class="workwith">
            @foreach($gateways as $gateway)
                <img src="{{getFile(config('location.gateway.path').$gateway->image)}}" class="m-2" alt="{{$gateway->name}}">
            @endforeach
        </div>
    </div>
</section>
<!-- /WORK-WITH -->

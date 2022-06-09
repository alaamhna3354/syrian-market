<div class="headerNav py-1">
    <div class="container-fluid px-md-5 ">
        <nav class="navbar navbar-expand-xl navbar-light" id="boltd">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{ getFile(config('location.logoIcon.path').'logo.png')}}" alt="homepage"
                     class="dark-logo"/>
            </a>
            <!-- Notification -->
            <div class="account" style="margin-inline-start: auto;">
                <a class="lin"
                   href="">{{config('basic.currency_symbol')}}</sup>{{getAmount(auth()->user()->balance)}}</a>
                <ul class="lang">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle lin" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           style="background-color: transparent;">
                            <i class="fa fa-globe"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach(getLanguges() as $language)
                                <a class="dropdown-item" href="{{route('language',[$language->short_name])}}">
                                    {{$language->name}}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <div class="fixed-icon  ">
                    <!-- rfixedicon -->
                    <i class="fa fa-bars"></i>
                </div>
            </div>
            <!-- End Notification -->
        </nav>
    </div>
</div>

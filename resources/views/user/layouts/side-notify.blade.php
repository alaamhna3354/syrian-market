<!-- <div class="fixed-icon rfixedicon ">
    <i class="fa fa-bars"></i>
</div> -->

<div class="fixedsidebar ">
    <!-- rfixed -->
<!--<div class="fs-header d-flex align-items-center justify-content-between">
         <h5 class="text-white">@lang("What's new on $basic->site_title")</h5>
        <div class="btn-close close-sidebar">&times;</div>
    </div>-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex justify-content-center logo-side">
            <a class="navbar-brand" href="{{route('home')}}" style="margin:0">
                <img src="{{ getFile(config('location.logoIcon.path').'logo.png')}}" alt="homepage"
                     class="dark-logo"/>
            </a>
        </div>
        <hr>
        <ul class="navbar-nav ml-auto  align-items-end align-items-sm-center">
            <li class="nav-item d-flex align-items-center">
                <i class="fa fa-home m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.home')  ? 'active' : '' }}"
                   href="{{ route('user.home') }}">@lang('Home') </a>

            </li>
            @if(Auth::user()->is_agent == 1 && Auth::user()->is_approved == 0)
                <li class="nav-item d-flex align-items-center">
                    <i class="fab fa-product-hunt m-2"></i>
                    <a class="nav-link {{ Request::routeIs('user.products')  ? 'active' : '' }}"
                       href="{{ route('user.products') }}">@lang('products') </a>
                </li>
            @endif

            <li class="nav-item d-flex align-items-center">
            <i class="fas fa-list-alt m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.order.index*')  ? 'active' : '' }}"
                   href="{{route('user.order.index')}}">@lang('Orders')</a>
            </li>
            {{--<li class="nav-item dropdown {{ Request::routeIs('user.order*') ? 'active' : '' }}">--}}
            {{--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"--}}
            {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--@lang('Order')--}}
            {{--<i data-feather="chevron-down" class="svg-icon"></i>--}}
            {{--</a>--}}
            {{--<div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
            {{--<a class="dropdown-item {{menuActive('user.order.create')}}" href="{{ route('user.order.create') }}">@lang('New Order')</a>--}}
            {{--<a class="dropdown-item {{menuActive('user.order.mass')}}" href="{{ route('user.order.mass') }}">@lang('Mass Order')</a>--}}
            {{--<a class="dropdown-item {{menuActive('user.order.index')}}" href="{{ route('user.order.index') }}">@lang('All Order')</a>--}}
            {{--</div>--}}
            {{--</li>--}}

            {{--<li class="nav-item">--}}
            {{--<a class="nav-link {{ Request::routeIs('user.service*')  ? 'active' : '' }}"--}}
            {{--href="{{ route('user.service.show') }}">@lang('Services') </a>--}}
            {{--</li>--}}
            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-piggy-bank m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.addFund*')  ? 'active' : '' }}"
                   href="{{route('user.addFund')}}">@lang('Add Fund')</a>
            </li>
            @if(Auth::user()->parent != null)
                <li class="nav-item d-flex align-items-center">
                    <i class="fas fa-indent m-2"></i>
                    <a class="nav-link {{ Request::routeIs('user.debts')  ? 'active' : '' }}"
                       href="{{route('user.debts')}}">@lang('Debts')</a>
                </li>
            @endif
            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-hand-holding-usd m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.use-balance-coupon') ? 'active' : '' }}"
                   href="{{ route('user.use-balance-coupon') }}">@lang('Use Balance Coupon') </a>
            </li>

            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-credit-card m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.fund-history') ? 'active' : '' }}"
                   href="{{ route('user.fund-history') }}">@lang('Fund History')</a>
            </li>

            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-table m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.transaction') ? 'active' : '' }}"
                   href="{{ route('user.transaction') }}">@lang('Transactions') </a>
            </li>
{{--            @if(auth()->user()->user_id == 0 || auth()->user()->user_id == null)--}}
            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-edit m-2"></i>
                <a class="nav-link {{ Request::routeIs('registerAsAgent') ? 'active' : '' }}"
                   href="{{ route('registerAsAgent') }}">@lang('Sign up As Agent') </a>
            </li>
{{--            @endif--}}

            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link {{ Request::routeIs('user.use-balance-coupon') ? 'active' : '' }}"--}}
            {{--href="{{ route('user.use-balance-coupon') }}">@lang('Use Balance Coupon') </a>--}}
            {{--</li>--}}

            <li class="nav-item dropdown d-flex align-items-center">
                <i class="fa fa-globe m-2"></i>
                <a class="nav-link dropdown-toggle lin" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   style="background-color: transparent;">
                    @lang('Languages')
                    <i data-feather="chevron-down" class="svg-icon m-1"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach(getLanguges() as $language)
                        <a class="dropdown-item" href="{{route('language',[$language->short_name])}}">
                            {{$language->name}}
                        </a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown {{ (Request::routeIs('user.profile') || Request::routeIs('user.api.docs') || Request::routeIs('user.ticket*')) ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownUser"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img src="{{getFile(config('location.user.path').Auth::user()->image )}}"
                         alt="{{ Auth::user()->name }}" class="rounded-circle" width="40px">
                    <span>{{ Auth::user()->username }}</span>
                    <i data-feather="chevron-down" class="svg-icon"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                    <a class="dropdown-item {{menuActive('user.profile')}}" href="{{ route('user.profile') }}">
                        <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                        @lang('My Profile')</a>


                    {{--<a class="dropdown-item {{menuActive('user.api.docs')}}" href="{{ route('user.api.docs') }}">--}}
                    {{--<i data-feather="key" class="svg-icon mr-2 ml-1"></i> @lang('API Setting')--}}
                    {{--</a>--}}

                    <a class="dropdown-item {{menuActive('user.ticket.create')}}"
                       href="{{ route('user.ticket.create') }}">
                        <i class="fab fa-hire-a-helper mr-2 ml-1 icon-color"></i>@lang('Open Ticket')
                    </a>
                    <a class="dropdown-item {{menuActive('user.ticket.list')}}" href="{{ route('user.ticket.list') }}">
                        <i class="fas fa-ticket-alt mr-2 ml-1 icon-color"></i> @lang('Show Ticket')
                    </a>
                    @if(auth()->user()->is_debt == 1)
                    <a class="dropdown-item {{menuActive('user.use_spare_balance')}}" href="{{ route('user.use_spare_balance') }}">
                        <i class="fas fa-ticket-alt mr-2 ml-1 icon-color"></i> @lang('Use Spare Balance')
                    </a>
                    @endif


                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                            data-feather="power" class="svg-icon mr-2 ml-1"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

    </div>
</div>
<!-- <div class="fs-wrapper">
        @foreach($notices as $notice)

    <div class="content">
        <div class="featureDate">
            <div class="category categoryNew new">
@lang($notice->highlight_text)
        </div>
        <span>{{dateTime($notice->created_at,'d M, Y')}}</span>
            </div>

            <h3 class="featureTitle">
                @lang($notice->title)
        </h3>


        <div class="featureContent">
            <p>
@lang($notice->details)

        </p>
    </div>
</div>
@endforeach

    </div> -->
</div>

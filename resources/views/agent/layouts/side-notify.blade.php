<div class="fixedsidebar ">

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
            <li class="nav-item d-flex align-items-center">

                <i class="fab fa-jedi-order m-2"></i>
                <style>
                    .fa-jedi-order::before {
                    content: "\f50e";
                    }
                </style>
                <a class="nav-link {{ Request::routeIs('agent.products')  ? 'active' : '' }}"
                   href="{{ route('agent.products') }}">@lang('products') </a>
            </li>
            <li class="nav-item dropdown {{ (Request::routeIs('agent.users') || Request::routeIs('agent.user.create') || Request::routeIs('agent.users.orders')) ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownUser"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <i class="fa fa-users m-2"></i>
                    <span>@lang('Users')</span>
                    <i data-feather="chevron-down" class="svg-icon"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                    <a class="dropdown-item {{menuActive('agent.users')}}" href="{{ route('agent.users') }}">
                        <i class="fa fa-users m-2"></i>
                        @lang('Users') </a>

                    <a class="dropdown-item {{menuActive('agent.user.create')}}" href="{{ route('agent.user.create') }}">
                        <i class="fa fa-user-plus m-2"></i>@lang('Add User')
                    </a>
                    <a class="dropdown-item {{menuActive('agent.users.orders')}}" href="{{ route('agent.users.orders') }}">
                        <i class="fa fa-shopping-cart m-2"></i> @lang('Users Orders')
                    </a>
                    <a class="dropdown-item {{menuActive('agent.user.add-balance')}}" href="{{ route('agent.user.add-balance') }}">
                        <i class="fas fa-hand-holding-usd m-2"></i> @lang('Add Balance To User')
                    </a>
                    <a class="dropdown-item {{menuActive('agent.add-debt-payment')}}" href="{{ route('agent.add-debt-payment') }}">
                        <i class="fas fa-piggy-bank m-2"></i> @lang('Add Debt Payment')
                    </a>
                    <a class="dropdown-item {{menuActive('agent.debt.index*')}}" href="{{ route('agent.debt.index') }}">
                        <i class="far fa-address-book m-2"></i> @lang('Users Debts')
                    </a>
                </div>
            </li>
            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-list-alt m-2"></i>
                <a class="nav-link {{ Request::routeIs('agent.order.index*')  ? 'active' : '' }}"
                   href="{{route('agent.order.index')}}">@lang('Orders')</a>
            </li>


            <li class="nav-item d-flex align-items-center">
            <i class="fas fa-clipboard-list m-2"></i>
                <a class="nav-link {{ Request::routeIs('agent.debt.my-debt')  ? 'active' : '' }}"
                   href="{{route('agent.debt.my-debt')}}">@lang('Debts')</a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-piggy-bank m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.addFund*')  ? 'active' : '' }}"
                   href="{{route('agent.addFund')}}">@lang('Add Fund')</a>
            </li>

            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-hand-holding-usd m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.use-balance-coupon') ? 'active' : '' }}"
                   href="{{ route('agent.use-balance-coupon') }}">@lang('Use Balance Coupon') </a>
            </li>

            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-credit-card m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.fund-history') ? 'active' : '' }}"
                   href="{{ route('agent.fund-history') }}">@lang('Fund History')</a>
            </li>

            <li class="nav-item d-flex align-items-center">
                <i class="fas fa-table m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.transaction') ? 'active' : '' }}"
                   href="{{ route('agent.transaction') }}">@lang('Transactions') </a>
            </li>

            <li class="nav-item d-flex align-items-center">
                <i class="fa fa-gift m-2"></i>
                <a class="nav-link {{ Request::routeIs('user.points') ? 'active' : '' }}"
                   href="{{ route('user.points') }}">@lang('My Points')
                    <sup style="color:#fe5917">  @lang('New') </sup>
                </a>

            </li>


            <li class="nav-item dropdown d-flex align-items-center">
                <i class="fa fa-globe m-2"></i>
                <a class="nav-link dropdown-toggle lin" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;">
                    @lang('languages')
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
            <li class="nav-item dropdown {{ (Request::routeIs('agent.profile') || Request::routeIs('agent.api.docs') || Request::routeIs('agent.ticket*')) ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownUser"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img src="{{getFile(config('location.user.path').Auth::user()->image )}}"
                         alt="{{ Auth::user()->name }}" class="rounded-circle" width="40px">
                    <span>{{ Auth::user()->username }}</span>
                    <i data-feather="chevron-down" class="svg-icon"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                    <a class="dropdown-item {{menuActive('agent.profile')}}" href="{{ route('agent.profile') }}">
                        <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                        @lang('My Profile')</a>


                    {{--<a class="dropdown-item {{menuActive('user.api.docs')}}" href="{{ route('user.api.docs') }}">--}}
                    {{--<i data-feather="key" class="svg-icon mr-2 ml-1"></i> @lang('API Setting')--}}
                    {{--</a>--}}

                    <a class="dropdown-item {{menuActive('agent.ticket.create')}}" href="{{ route('agent.ticket.create') }}">
                        <i class="fab fa-hire-a-helper mr-2 ml-1 icon-color"></i>@lang('Open Ticket')
                    </a>
                    <a class="dropdown-item {{menuActive('agent.ticket.list')}}" href="{{ route('agent.ticket.list') }}">
                        <i class="fas fa-ticket-alt mr-2 ml-1 icon-color"></i> @lang('Show Ticket')
                    </a>

                    @if(auth()->user()->is_debt == 1)
                        <a class="dropdown-item {{menuActive('agent.use_spare_balance')}}" href="{{ route('agent.use_spare_balance') }}">
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

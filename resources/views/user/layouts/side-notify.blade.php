<div class="fixed-icon ">
    <i class="fa fa-arrow-left"></i>
</div>

<div class="fixedsidebar ">
    <!--<div class="fs-header d-flex align-items-center justify-content-between">
         <h5 class="text-white">@lang("What's new on $basic->site_title")</h5>
        <div class="btn-close close-sidebar">&times;</div>
    </div>-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <ul class="navbar-nav ml-auto  align-items-end align-items-sm-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('user.home')  ? 'active' : '' }}"
                           href="{{ route('user.home') }}">@lang('Home') </a>
                    </li>

                    <li class="nav-item  ">
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
                    <li class="nav-item  ">
                        <a class="nav-link {{ Request::routeIs('user.addFund*')  ? 'active' : '' }}"
                           href="{{route('user.addFund')}}">@lang('Add Fund')</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ Request::routeIs('user.use-balance-coupon') ? 'active' : '' }}"
                           href="{{ route('user.use-balance-coupon') }}">@lang('Use Balance Coupon') </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ Request::routeIs('user.fund-history') ? 'active' : '' }}"
                           href="{{ route('user.fund-history') }}">@lang('Fund History')</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ Request::routeIs('user.transaction') ? 'active' : '' }}"
                           href="{{ route('user.transaction') }}">@lang('Transactions') </a>
                    </li>

                    {{--<li class="nav-item ">--}}
                        {{--<a class="nav-link {{ Request::routeIs('user.use-balance-coupon') ? 'active' : '' }}"--}}
                           {{--href="{{ route('user.use-balance-coupon') }}">@lang('Use Balance Coupon') </a>--}}
                    {{--</li>--}}


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

                            <a class="dropdown-item {{menuActive('user.ticket.create')}}" href="{{ route('user.ticket.create') }}">
                                <i class="fab fa-hire-a-helper mr-2 ml-1 icon-color"></i>@lang('Open Ticket')
                            </a>
                            <a class="dropdown-item {{menuActive('user.ticket.list')}}" href="{{ route('user.ticket.list') }}">
                                <i class="fas fa-ticket-alt mr-2 ml-1 icon-color"></i> @lang('Show Ticket')
                            </a>


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

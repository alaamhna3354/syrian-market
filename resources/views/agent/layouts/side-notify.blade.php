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
                <i class="fa fa-users m-2"></i>
                <a class="nav-link {{ Request::routeIs('agent.users')  ? 'active' : '' }}"
                   href="{{ route('agent.users') }}">@lang('Users') </a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <i class="fa fa-user-plus m-2"></i>
                <a class="nav-link {{ Request::routeIs('agent.user.create')  ? 'active' : '' }}"
                   href="{{ route('agent.user.create') }}">@lang('Add User') </a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <i class="fa fa-user-plus m-2"></i>
                <a class="nav-link {{ Request::routeIs('agent.user.add-balance')  ? 'active' : '' }}"
                   href="{{ route('agent.user.add-balance') }}">@lang('Add Balance To User') </a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <i class="fa fa-shopping-cart m-2"></i>
                <a class="nav-link {{ Request::routeIs('agent.users.orders')  ? 'active' : '' }}"
                   href="{{ route('agent.users.orders') }}">@lang('Users Orders') </a>
            </li>
        </ul>
        <div class="side-fotter d-flex justify-content-around">
            <div class="dropdown-divider"></div>
            <a class="logout-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i data-feather="power" class="fa fa-power-off"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a class="logout-item {{menuActive('user.profile')}}" href="{{ route('user.profile') }}">
                <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
            </a>
            <a class="logout-item {{menuActive('user.ticket.list')}}" href="{{ route('user.ticket.list') }}">
                <i class="fas fa-ticket-alt mr-2 ml-1 icon-color"></i>
            </a>
            <div class="push-notification dropdown " id="pushNotificationArea">
                <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                   id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <span><i class="far fa-bell bell-font"></i></span>
                    <span class="badge notify-no rounded-circle" style="background-color: #fe5916;color:#fff" v-cloak>@{{ items.length }}</span>
                </a>
                <div class="right-dropdown dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                    <ul class="list-style-none">
                        <li>
                            <div class="scrollable message-center notifications position-relative">
                                <!-- Message -->
                                <a v-for="(item, index) in items"
                                   @click.prevent="readAt(item.id, item.description.link)"
                                   href="javascript:void(0)"
                                   class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn-success text-white rounded-circle btn-circle">
                                    <i :class="item.description.icon" class="text-white"></i>
                                </span>
                                    <div class="d-inline-block v-middle pl-2">
                                        <span class="font-12  d-block text-white" v-cloak
                                              v-html="item.description.text"></span>
                                        <span style="opacity: 0.6;" class="font-12  d-block text-white text-truncate"
                                              v-cloak>@{{ item.formatted_date }}</span>
                                    </div>
                                </a>
                            </div>
                        </li>

                        <li>
                            <a class="nav-link pt-3 text-center text-white notification-clear-btn"
                               href="javascript:void(0);"
                               v-if="items.length > 0" @click.prevent="readAll">
                                <strong>@lang('Clear all')</strong>
                            </a>
                            <a class="nav-link pt-3 text-center text-white" href="javascript:void(0);"
                               v-else>
                                <strong>@lang('No Data found')</strong>
                            </a>


                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</div>

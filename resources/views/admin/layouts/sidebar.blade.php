<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if(auth()->user()->role==='Super' || auth()->user()->role==='Admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Dashboard')</span>
                        </a>
                    </li>

                    <li class="list-divider"></li>
                    {{--Manage Service--}}
                    <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Service')</span></li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.service.add')}}"
                           aria-expanded="false">
                            <i data-feather="plus-circle" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Add Services')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.service.show')}}"
                           aria-expanded="false">
                            <i data-feather="list" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Show Services')</span>
                        </a>
                    </li>

                    <li class="list-divider"></li>

                    {{--Manage Category--}}
                    <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Category')</span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.category.add')}}"
                           aria-expanded="false">
                            <i data-feather="plus-circle" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Add Category')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.category.show')}}"
                           aria-expanded="false">
                            <i data-feather="list" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Show Category')</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>


                    {{--Manage Service Codes--}}
                    <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Service Codes')</span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.service_codes.add')}}"
                           aria-expanded="false">
                            <i data-feather="plus-circle" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Add Service Code')</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.service_codes.add-multi')}}"
                           aria-expanded="false">
                            <i data-feather="plus-circle" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Add Multiple Service Code')</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.service_codes.show')}}"
                           aria-expanded="false">
                            <i data-feather="list" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Show Service Code')</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>


                    {{--Manage Balance Coupon--}}
                    <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Balance Coupon')</span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.balance-coupon.create')}}"
                           aria-expanded="false">
                            <i data-feather="plus-circle" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Add Balance Coupon')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.balance-coupon')}}"
                           aria-expanded="false">
                            <i data-feather="list" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Show Balance Coupon')</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>

                    {{--Manage Price Range--}}
                    <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Price Range')</span></li>
                    {{--                <li class="sidebar-item">--}}
                    {{--                    <a class="sidebar-link sidebar-link" href="{{route('admin.price_range.create')}}" aria-expanded="false">--}}
                    {{--                        <i data-feather="plus-circle" class="feather-icon"></i>--}}
                    {{--                        <span class="hide-menu">@lang('Add Price Range')</span>--}}
                    {{--                    </a>--}}
                    {{--                </li>--}}

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.price_range.index')}}"
                           aria-expanded="false">
                            <i data-feather="list" class="feather-icon"></i>
                            <span class="hide-menu">@lang('Show Price Range')</span>
                        </a>
                    </li>
                    <li class="list-divider"></li>

                @endif
                {{--Manage Coupon--}}
                {{--                <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Coupon')</span></li>--}}
                {{--                <li class="sidebar-item">--}}
                {{--                    <a class="sidebar-link sidebar-link" href="{{route('admin.coupon.create')}}" aria-expanded="false">--}}
                {{--                        <i data-feather="plus-circle" class="feather-icon"></i>--}}
                {{--                        <span class="hide-menu">@lang('Add Coupon')</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

                {{--                <li class="sidebar-item">--}}
                {{--                    <a class="sidebar-link sidebar-link" href="{{route('admin.coupon')}}"--}}
                {{--                       aria-expanded="false">--}}
                {{--                        <i data-feather="list" class="feather-icon"></i>--}}
                {{--                        <span class="hide-menu">@lang('Show Coupon')</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="list-divider"></li>--}}


                Manage API Providers
                {{--<li class="nav-small-cap"><span class="hide-menu">@lang('Api Providers')</span></li>--}}
                {{--<li class="sidebar-item">--}}
                {{--<a class="sidebar-link sidebar-link" href="{{route('admin.provider.api-provider.create')}}"--}}
                {{--aria-expanded="false"><i class="fas fa-external-link-alt "></i><span--}}
                {{--class="hide-menu">@lang('Add Provider')</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="{{route('admin.provider.api-provider.index')}}"
                aria-expanded="false">
                <i class="fas fa-list-alt"></i>
                <span class="hide-menu">@lang('Api Providers')</span>
                </a>
                </li>

                {{--<li class="list-divider"></li>--}}


                {{--Manage Orders--}}
                <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Orders')</span></li>

                <li class="sidebar-item {{menuActive(['admin.order','admin.order-search'],3)}}">
                    <a class="sidebar-link has-arrow {{menuActive(['admin.order','admin.order-search'])}}"
                       href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hide-menu">@lang('Orders')</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level base-level-line {{menuActive(['admin.order','admin.order-search'],1)}}">

                        <li class="sidebar-item {{menuActive(['admin.order','admin.order-search'])}}">
                            <a href="{{route('admin.order')}}"
                               class="sidebar-link {{menuActive(['admin.order','admin.order-search'])}} ">
                                <span class="hide-menu">@lang('All Orders')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('admin.awaiting')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Awaiting')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('admin.pending')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Pending')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('admin.processing')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Processing')</span>
                            </a>
                        </li>
                        {{--<li class="sidebar-item">--}}
                        {{--<a href="{{route('admin.progress')}}" class="sidebar-link">--}}
                        {{--<span class="hide-menu">@lang('In progress')</span>--}}
                        {{--</a>--}}
                        {{--</li>--}}

                        <li class="sidebar-item">
                            <a href="{{route('admin.completed')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Completed')</span>
                            </a>
                        </li>

                        {{--<li class="sidebar-item">--}}
                        {{--<a href="{{route('admin.partial')}}" class="sidebar-link">--}}
                        {{--<span class="hide-menu">@lang('Partial')</span>--}}
                        {{--</a>--}}
                        {{--</li>--}}

                        <li class="sidebar-item">
                            <a href="{{route('admin.canceled')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Canceled')</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a href="{{route('admin.refunded')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Refunded')</span>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="list-divider"></li>

                @if(auth()->user()->role==='Super' || auth()->user()->role==='Admin')
                    {{--Manage User--}}
                    <li class="nav-small-cap"><span class="hide-menu">@lang('Manage User')</span></li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.users') }}" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="hide-menu">@lang('All User')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.agents') }}" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="hide-menu">@lang('All Agents')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.users.email-send') }}"
                           aria-expanded="false">
                            <i class="fas fa-envelope-open"></i>
                            <span class="hide-menu">@lang('Send Email')</span>
                        </a>
                    </li>

                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Marketer')</span></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.marketers') }}"
                           aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="hide-menu">@lang('All Marketers')
                                <sup style="font-weight: bold;background-color: red;" class="mr-3">@lang('New')</sup>
                            </span>

                        </a>
                    </li>
                    <li class="list-divider"></li>


                    <li class="nav-small-cap"><span class="hide-menu">@lang('Payment Settings')</span></li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.payment.methods')}}"
                           aria-expanded="false">
                            <i class="fas fa-credit-card"></i>
                            <span class="hide-menu">@lang('Payment Methods')</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{menuActive(['admin.deposit.manual.index','admin.deposit.manual.create','admin.deposit.manual.edit'],3)}}">
                        <a class="sidebar-link" href="{{route('admin.deposit.manual.index')}}"
                           aria-expanded="false">
                            <i class="fa fa-university"></i>
                            <span class="hide-menu">@lang('Manual Gateway')</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{menuActive(['admin.payment.pending'],3)}}">
                        <a class="sidebar-link" href="{{route('admin.payment.pending')}}" aria-expanded="false">
                            <i class="fas fa-spinner"></i>
                            <span class="hide-menu">@lang('Deposit Request')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.payment.log')}}"
                           aria-expanded="false">
                            <i class="fas fa-history"></i>
                            <span class="hide-menu">@lang('Payment Log')</span>
                        </a>
                    </li>


                    <li class="nav-small-cap"><span class="hide-menu">@lang('Transaction')</span></li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.user-transaction') }}"
                           aria-expanded="false">
                            <i class="fas fa-exchange-alt"></i>
                            <span class="hide-menu">@lang('Transaction')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.user-inventory') }}"
                           aria-expanded="false">
                            <i class="fas fa-exchange-alt"></i>
                            <span class="hide-menu">@lang('Inventory')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.user-points.transaction') }}"
                           aria-expanded="false">
                            <i class="fas fa-exchange-alt"></i>
                            <span class="hide-menu">@lang('Points Transactions')
                                <sup style="font-weight: bold;background-color: red;" class="mr-3">@lang('New')</sup>
                            </span>
                        </a>
                    </li>

                    <li class="nav-small-cap"><span class="hide-menu">@lang('Support Tickets')</span></li>


                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.ticket')}}" aria-expanded="false">
                            <i class="fas fa-ticket-alt"></i>
                            <span class="hide-menu">@lang('All Tickets')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.ticket',['open']) }}"
                           aria-expanded="false">
                            <i class="fas fa-spinner"></i>
                            <span class="hide-menu">@lang('Open Ticket')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.ticket',['closed']) }}"
                           aria-expanded="false">
                            <i class="fas fa-times-circle"></i>
                            <span class="hide-menu">@lang('Closed Ticket')</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.ticket',['answered']) }}"
                           aria-expanded="false">
                            <i class="fas fa-reply"></i>
                            <span class="hide-menu">@lang('Answered Ticket')</span>
                        </a>
                    </li>


                    {{--<li class="nav-small-cap"><span class="hide-menu">@lang('Subscriber')</span></li>--}}
                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link sidebar-link" href="{{route('admin.subscriber.index')}}" aria-expanded="false">--}}
                    {{--<i class="fas fa-envelope-open"></i>--}}
                    {{--<span class="hide-menu">@lang('Subscriber List')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}


                    <li class="nav-small-cap"><span class="hide-menu">@lang('Controls')</span></li>
                    @if(auth()->user()->role=='Super')
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{ route('admin.admins.index') }}"
                               aria-expanded="false">
                                <i class="fas fa-users"></i>
                                <span class="hide-menu">@lang('All Admin') <sup
                                            style="font-weight: bold;background-color: red;"
                                            class="mr-3">@lang('New')</sup></span>
                            </a>
                        </li>
                    @endif
                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link sidebar-link" href="{{route('admin.basic-controls')}}" aria-expanded="false">--}}
                    {{--<i class="fas fa-cogs"></i>--}}
                    {{--<span class="hide-menu">@lang('Basic Controls')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{route('admin.basicControls')}}"
                           aria-expanded="false">
                            <i class="fas fa-cogs"></i>
                            <span class="hide-menu">@lang('Basic Controls')</span>
                        </a>
                    </li>
                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link sidebar-link" href="{{route('admin.color-settings')}}" aria-expanded="false">--}}
                    {{--<i class="fas fa-paint-brush"></i>--}}
                    {{--<span class="hide-menu">@lang('Color Settings')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}


                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link sidebar-link" href="{{route('admin.notice')}}" aria-expanded="false">--}}
                    {{--<i class="fas fa-bullhorn"></i>--}}
                    {{--<span class="hide-menu">@lang('Notice')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
                    {{--<i class="fas fa-envelope"></i>--}}
                    {{--<span class="hide-menu">@lang('Email Settings')</span>--}}
                    {{--</a>--}}
                    {{--<ul aria-expanded="false" class="collapse first-level base-level-line">--}}
                    {{--<li class="sidebar-item">--}}
                    {{--<a href="{{route('admin.email-controls')}}" class="sidebar-link">--}}
                    {{--<span class="hide-menu">@lang('Email Controls')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="sidebar-item">--}}
                    {{--<a href="{{route('admin.email-template.show')}}" class="sidebar-link">--}}
                    {{--<span class="hide-menu">@lang('Email Template') </span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}

                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
                    {{--<i class="fas fa-mobile-alt"></i>--}}
                    {{--<span class="hide-menu">@lang('SMS Settings')</span>--}}
                    {{--</a>--}}
                    {{--<ul aria-expanded="false" class="collapse first-level base-level-line">--}}
                    {{--<li class="sidebar-item">--}}
                    {{--<a href="{{ route('admin.sms.config') }}" class="sidebar-link">--}}
                    {{--<span class="hide-menu">@lang('SMS Controls')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="sidebar-item">--}}
                    {{--<a href="{{ route('admin.sms-template') }}" class="sidebar-link">--}}
                    {{--<span class="hide-menu">@lang('SMS Template')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}


                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
                    {{--<i class="fas fa-bell"></i>--}}
                    {{--<span class="hide-menu">@lang('Push Notification')</span>--}}
                    {{--</a>--}}
                    {{--<ul aria-expanded="false" class="collapse first-level base-level-line">--}}
                    {{--<li class="sidebar-item">--}}
                    {{--<a href="{{route('admin.notify-config')}}" class="sidebar-link">--}}
                    {{--<span class="hide-menu">@lang('Configuration')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li class="sidebar-item">--}}
                    {{--<a href="{{ route('admin.notify-template.show') }}" class="sidebar-link">--}}
                    {{--<span class="hide-menu">@lang('Template')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}


                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{  route('admin.language.index') }}"
                           aria-expanded="false">
                            <i class="fas fa-language"></i>
                            <span class="hide-menu">@lang('Manage Language')</span>
                        </a>
                    </li>


                    {{--<li class="nav-small-cap"><span class="hide-menu">@lang('Theme Settings')</span></li>--}}


                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link sidebar-link" href="{{route('admin.logo-seo')}}" aria-expanded="false">--}}
                    {{--<i class="fas fa-image"></i><span--}}
                    {{--class="hide-menu">@lang('Manage Logo & SEO')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="sidebar-item">--}}
                    {{--<a class="sidebar-link sidebar-link" href="{{route('admin.breadcrumb')}}" aria-expanded="false">--}}
                    {{--<i class="fas fa-file-image"></i><span--}}
                    {{--class="hide-menu">@lang('Manage Breadcrumb')</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}


                    <li class="sidebar-item {{menuActive(['admin.template.show*'],3)}}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <span class="hide-menu">@lang('Manage Content')</span>
                        </a>
                        <ul aria-expanded="false"
                            class="collapse first-level base-level-line {{menuActive(['admin.template.show*'],1)}}">

                            @foreach(array_diff(array_keys(config('templates')),['message','template_media']) as $name)
                                <li class="sidebar-item {{ menuActive(['admin.template.show'.$name]) }}">
                                    <a class="sidebar-link {{ menuActive(['admin.template.show'.$name]) }}"
                                       href="{{ route('admin.template.show',$name) }}">
                                        <span class="hide-menu">@lang(ucfirst(kebab2Title($name)))</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>


                    {{--<li class="sidebar-item {{menuActive(['admin.content.create','admin.content.show*'],3)}}">--}}
                    {{--<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
                    {{--<i class="fas fa-clipboard-list"></i>--}}
                    {{--<span class="hide-menu">@lang('Content Settings')</span>--}}
                    {{--</a>--}}
                    {{--<ul aria-expanded="false" class="collapse first-level base-level-line {{menuActive(['admin.content.create','admin.content.show*'],1)}}">--}}
                    {{--@foreach(array_diff(array_keys(config('contents')),['message','content_media']) as $name)--}}
                    {{--<li class="sidebar-item {{ menuActive(['admin.content.show.',$name]) }}">--}}
                    {{--<a class="sidebar-link {{ menuActive(['admin.content.show.',$name]) }}"--}}
                    {{--href="{{ route('admin.content.index',$name) }}">--}}
                    {{--<span class="hide-menu">@lang(ucfirst(kebab2Title($name)))</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--@endforeach--}}
                    {{--</ul>--}}
                    {{--</li>--}}

                    <li class="sidebar-menu-item">
                        <a class="nav-link " onclick="showRate()">
                            <i class="menu-icon la la-list"></i>
                            <span class="menu-title">@lang('Exchange Rate')</span>
                        </a>
                    </li>
                    <li>
                        <div class="col-sm-12" id="rate" style="display: none">
                            <form name="add-blog-post-form" id="add-blog-post-form" method="post"
                                  action="{{route('admin.basic-controls.exchange_rate')}}">
                                @csrf
                                <input type="text" class="form-control has-error bold " name="rate" required
                                       placeholder="@lang('Enter Rate')"
                                       value="{{config('basic.exchange_rate')}}">
                                <button class="btn btn--dark" type="submit">@lang('Update')</button>
                            </form>
                        </div>
                    </li>
                    <li class="list-divider"></li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<script>
    function showRate() {
        document.getElementById("rate").style.display = "block";
    }
</script>

<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

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
                    <a class="sidebar-link sidebar-link" href="{{route('admin.service.add')}}" aria-expanded="false">
                        <i data-feather="plus-circle" class="feather-icon"></i>
                        <span class="hide-menu">@lang('Add Services')</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.service.show')}}" aria-expanded="false">
                        <i data-feather="list" class="feather-icon"></i>
                        <span class="hide-menu">@lang('Show Services')</span>
                    </a>
                </li>

                <li class="list-divider"></li>

                {{--Manage Category--}}
                <li class="nav-small-cap"><span class="hide-menu">@lang('Manage Category')</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.category.add')}}" aria-expanded="false">
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


                {{--Manage API Providers--}}
                <li class="nav-small-cap"><span class="hide-menu">@lang('Api Providers')</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.provider.api-provider.create')}}"
                       aria-expanded="false"><i class="fas fa-external-link-alt "></i><span
                            class="hide-menu">@lang('Add Provider')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.provider.api-provider.index')}}"
                       aria-expanded="false">
                        <i class="fas fa-list-alt"></i>
                        <span class="hide-menu">@lang('Api Providers')</span>
                    </a>
                </li>

                <li class="list-divider"></li>


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
                        <li class="sidebar-item">
                            <a href="{{route('admin.progress')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('In progress')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('admin.completed')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Completed')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('admin.partial')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Partial')</span>
                            </a>
                        </li>

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


                {{--Manage User--}}
                <li class="nav-small-cap"><span class="hide-menu">@lang('Manage User')</span></li>

                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ route('admin.users') }}" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="hide-menu">@lang('All User')</span>
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


                <li class="nav-small-cap"><span class="hide-menu">@lang('Payment Settings')</span></li>

                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.payment.methods')}}"
                       aria-expanded="false">
                        <i class="fas fa-credit-card"></i>
                        <span class="hide-menu">@lang('Payment Methods')</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.payment.log')}}" aria-expanded="false">
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


                <li class="nav-small-cap"><span class="hide-menu">@lang('Subscriber')</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.subscriber.index')}}" aria-expanded="false">
                        <i class="fas fa-envelope-open"></i>
                        <span class="hide-menu">@lang('Subscriber List')</span>
                    </a>
                </li>


                <li class="nav-small-cap"><span class="hide-menu">@lang('Controls')</span></li>

                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.basic-controls')}}" aria-expanded="false">
                        <i class="fas fa-cogs"></i>
                        <span class="hide-menu">@lang('Basic Controls')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.color-settings')}}" aria-expanded="false">
                        <i class="fas fa-paint-brush"></i>
                        <span class="hide-menu">@lang('Color Settings')</span>
                    </a>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.notice')}}" aria-expanded="false">
                       <i class="fas fa-bullhorn"></i>
                        <span class="hide-menu">@lang('Notice')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        <span class="hide-menu">@lang('Email Settings')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a href="{{route('admin.email-controls')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Email Controls')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.email-template.show')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Email Template') </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-mobile-alt"></i>
                        <span class="hide-menu">@lang('SMS Settings')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a href="{{ route('admin.sms.config') }}" class="sidebar-link">
                                <span class="hide-menu">@lang('SMS Controls')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('admin.sms-template') }}" class="sidebar-link">
                                <span class="hide-menu">@lang('SMS Template')</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="hide-menu">@lang('Push Notification')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item">
                            <a href="{{route('admin.notify-config')}}" class="sidebar-link">
                                <span class="hide-menu">@lang('Configuration')</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('admin.notify-template.show') }}" class="sidebar-link">
                                <span class="hide-menu">@lang('Template')</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{  route('admin.language.index') }}"
                       aria-expanded="false">
                        <i class="fas fa-language"></i>
                        <span class="hide-menu">@lang('Manage Language')</span>
                    </a>
                </li>



                <li class="nav-small-cap"><span class="hide-menu">@lang('Theme Settings')</span></li>


                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.logo-seo')}}" aria-expanded="false">
                        <i class="fas fa-image"></i><span
                            class="hide-menu">@lang('Manage Logo & SEO')</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{route('admin.breadcrumb')}}" aria-expanded="false">
                        <i class="fas fa-file-image"></i><span
                            class="hide-menu">@lang('Manage Breadcrumb')</span>
                    </a>
                </li>


                <li class="sidebar-item {{menuActive(['admin.template.show*'],3)}}">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="hide-menu">@lang('Manage Content')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line {{menuActive(['admin.template.show*'],1)}}">

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


                <li class="sidebar-item {{menuActive(['admin.content.create','admin.content.show*'],3)}}">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="hide-menu">@lang('Content Settings')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line {{menuActive(['admin.content.create','admin.content.show*'],1)}}">
                        @foreach(array_diff(array_keys(config('contents')),['message','content_media']) as $name)
                            <li class="sidebar-item {{ menuActive(['admin.content.show.',$name]) }}">
                                <a class="sidebar-link {{ menuActive(['admin.content.show.',$name]) }}"
                                   href="{{ route('admin.content.index',$name) }}">
                                    <span class="hide-menu">@lang(ucfirst(kebab2Title($name)))</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>


                <li class="list-divider"></li>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

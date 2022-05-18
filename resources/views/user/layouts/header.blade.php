<div class="headerNav py-1">
    <div class="container-fluid px-md-5 ">

        <nav class="navbar navbar-expand-xl navbar-light  mx-lg-5" id="boltd">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{ getFile(config('location.logoIcon.path').'logo.png')}}" alt="homepage"
                     class="dark-logo" />
            </a>
            <!-- <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

            


            <!-- Notification -->
            <div class="account" style="margin-inline-start: auto;">
            <a href="">$0.14</a>
            <i class="fab fa-xbox"></i>
            </div>
            <div class="push-notification dropdown " id="pushNotificationArea" style="margin: 0 0 0 10px;">

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
                                                <span class="btn btn-success text-white rounded-circle btn-circle">
                                                    <i :class="item.description.icon" class="text-white"></i>
                                                </span>

                                    <div class="d-inline-block v-middle pl-2">
                                        <span class="font-12  d-block text-muted"  v-cloak v-html="item.description.text"></span>
                                        <span class="font-12  d-block text-muted text-truncate"  v-cloak>@{{ item.formatted_date }}</span>
                                    </div>
                                </a>

                            </div>
                        </li>

                        <li>
                            <a class="nav-link pt-3 text-center text-dark notification-clear-btn" href="javascript:void(0);"
                               v-if="items.length > 0" @click.prevent="readAll">
                                <strong>@lang('Clear all')</strong>
                            </a>
                            <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);"
                               v-else>
                                <strong>@lang('No Data found')</strong>
                            </a>

                        </li>
                    </ul>
                </div>


            </div>
            <!-- End Notification -->


        </nav>

    </div>

</div>

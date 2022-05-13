<!DOCTYPE html>
<html  lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<head>
    @include('user.layouts.head')
</head>
<body>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full" class="mini-sidebar ">

    @include('user.layouts.header')

    @include('user.layouts.side-notify')

    <div class="page-wrapper d-block">
        @yield('content')
    </div>
    <footer class="footer text-center text-muted">
        <p>{{trans('Copyright')}} © {{date('Y')}} {{trans(config('basic.site_title'))}}. {{trans('All Rights Reserved')}}</p>
    </footer>

</div>




<script src="{{asset('assets/global/js/jquery.min.js') }}"></script>
<script src="{{asset('assets/global/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/global/js/bootstrap.min.js') }}"></script>
@stack('js-lib')
<script src="{{ asset('assets/admin/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('assets/admin/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/sidebarmenu.js')}}"></script>
<script src="{{ asset('assets/global/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/admin-mart.js')}}"></script>
<script src="{{ asset('assets/admin/js/custom.js')}}"></script>



<script src="{{ asset('assets/global/js/axios.min.js') }}"></script>
<script src="{{ asset('assets/global/js/vue.min.js') }}"></script>
<script src="{{ asset('assets/global/js/pusher.min.js') }}"></script>

@include('user.layouts.notification')
@stack('js')



<script>
    "use strict";
    if(!localStorage.sidenote || localStorage.sidenote == 'true'){
        $('.fixed-icon').removeClass('rfixedicon');
        $('.fixedsidebar').removeClass('rfixed');
    }

    $(document).on('click', '.close-sidebar',function () {
        $('.fixed-icon').addClass('rfixedicon');
        $('.fixedsidebar').addClass('rfixed');
        localStorage.setItem("sidenote", false);
    });

    $(document).on('click', '.fixed-icon', function () {

        $('.fixed-icon').toggleClass('rfixedicon');
        $('.fixedsidebar').toggleClass('rfixed');

        if (typeof(Storage) !== "undefined") {
            if(localStorage.sidenote == 'true'){
                localStorage.setItem("sidenote", false);
            }else{
                localStorage.setItem("sidenote", true);
            }
        }
    });
</script>


<script>
    'use strict';
    let pushNotificationArea = new Vue({
        el: "#pushNotificationArea",
        data: {
            items: [],
        },
        beforeMount() {
            this.getNotifications();
            this.pushNewItem();
        },
        methods: {
            getNotifications() {
                let app = this;
                axios.get("{{ route('user.push.notification.show') }}")
                    .then(function (res) {
                        app.items = res.data;
                    })
            },
            readAt(id, link) {
                let app = this;
                let url = "{{ route('user.push.notification.readAt', 0) }}";
                url = url.replace(/.$/, id);
                axios.get(url)
                    .then(function (res) {
                        if (res.status){
                            app.getNotifications();
                            if (link != '#') {
                                window.location.href = link
                            }
                        }
                    })
            },
            readAll() {
                let app = this;
                let url = "{{ route('user.push.notification.readAll') }}";
                axios.get(url)
                    .then(function (res) {
                        if (res.status){
                            app.items = [];
                        }
                    })
            },
            pushNewItem(){let app = this;
                // Pusher.logToConsole = true;
                let pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                    encrypted: true,
                    cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                });
                let channel = pusher.subscribe('user-notification.' + "{{ Auth::id() }}");
                channel.bind('App\\Events\\UserNotification', function (data) {
                    app.items.unshift(data.message);
                });
                channel.bind('App\\Events\\UpdateUserNotification', function (data) {
                    app.getNotifications();
                });
            }
        }
    });
</script>

</body>
</html>

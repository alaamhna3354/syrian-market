<!DOCTYPE html>
<html  lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<head>
    @include('agent.layouts.head')
</head>
<body>
<div id="main-wrapper" class="d-flex flex-wrap" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full" class="mini-sidebar ">

    @include('agent.layouts.header')


@include('agent.layouts.side-notify')

    <div class="page-wrapper main-page d-block wid-res" style="width:100%">
        @yield('content')
    </div>

    <footer class="footer text-center text-white">
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

@include('agent.layouts.notification')
@stack('js')



<script>
    "use strict";
    if(!localStorage.sidenote || localStorage.sidenote == 'true'){
        $('.fixed-icon').removeClass('rfixedicon');
        $('.fixedsidebar').removeClass('rfixed');
        // $('.main-page').removeClass('wid-res');
    }

    $(document).on('click', '.close-sidebar',function () {
        $('.fixed-icon').addClass('rfixedicon');
        $('.fixedsidebar').addClass('rfixed');
        // $('.main-page').addClass('wid-res');
        localStorage.setItem("sidenote", false);
    });

    $(document).on('click', '.fixed-icon', function () {

        $('.fixed-icon').toggleClass('rfixedicon');
        $('.fixedsidebar').toggleClass('rfixed');
        $('.main-page').toggleClass('wid-res');
        if (typeof(Storage) !== "undefined") {
            if(localStorage.sidenote == 'true'){
                localStorage.setItem("sidenote", false);
            }else{
                localStorage.setItem("sidenote", true);
            }
        }
    });
</script>
<style>
.wid-res{
    width: calc(100% - 250px) !important;
    margin-inline-start: 250px !important;
}
@media (max-width:768px) {
    .wid-res{
        width: 100%  !important;
    margin-inline-start: 0 !important;

    }
}
</style>

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

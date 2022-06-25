<div class="headerNav py-1">
    <div class="container-fluid px-md-5 ">

        <nav class="navbar navbar-expand-xl navbar-light" id="boltd">
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
            <div id="coverProgress"></div>
            <div id="contentProgress" >
            <div class="mb-2 d-flex progressText">
                <div class="d-flex mb-3">
                <div class="level">
                    <img src="{{asset($themeTrue.'imgs/level.jpg')}}" alt="">
                    <span >@lang('3')</span>
                    <h2>@lang('المستوى')</h2>
                </div>

                </div>
                </div>
                <div class="d-flex">
                    <h4>@lang('عليك الشراء ب')</h4>
                    <h4 id="progressText" class="progressTextcolor">30$</h4>
                    <h4>@lang('للانتقال للمستوى التالي')</h4>
                </div>
                <div id="myProgress" data-progress="70">
                    <div id="myBar"></div>
                </div>
                <div class="d-flex mt-3">
                    <h4>@lang(' عليك الشراء ب')</h4>
                    <h4 id="progressText" class="progressTextcolor"> 10$ </h4>
                    <h4>@lang('للحفاظ على مستواك خلال 24 ساعة')</h4>
                </div>
                <div id="myProgress2" data-progress="90">
                    <div id="myBar2"></div>
                </div>
            </div>
            <img id="showProgress" src="{{asset($themeTrue.'imgs/iconl-level.png')}}" alt="" style="width: 35px;cursor: pointer">
            <!-- <i class="fas fa-id-card" id="showProgress" style="color: #fe5917;cursor: pointer;margin-inline-end: 5px;"></i> -->
            <a class="lin" href="">{{config('basic.currency_symbol')}}</sup>{{getAmount(auth()->user()->balance)}}</a>
           
                       
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

               
                <a v-for="(item, index) in items"
                   @click.prevent="readAt(item.id, item.description.link)"
                   href="javascript:void(0)"
                   class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                <span class="btn-success text-white rounded-circle btn-circle">
                                    <i :class="item.description.icon" class="text-white"></i>
                                </span>

                    <div class="d-inline-block v-middle pl-2">
                        <span class="font-12  d-block text-white"  v-cloak v-html="item.description.text"></span>
                        <span style="opacity: 0.6;" class="font-12  d-block text-white text-truncate" v-cloak>@{{ item.formatted_date }}</span>
                    </div>
                </a>

            </div>
        </li>

        <li>
            <a class="nav-link pt-3 text-center text-white notification-clear-btn" href="javascript:void(0);"
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
            <div class="fixed-icon  ">
                <i class="fa fa-bars"></i>
            </div>
            <!-- End Notification -->
        </nav>
    </div>
</div>
@push('js')
<script>
    $("#showProgress").on("click", function() {
    $('#contentProgress').addClass('active');
    $('#coverProgress').show();
    
    var i = 0;
    var x = 0;
    var progress = $('#myProgress').attr("data-progress");
    var progress2 = $('#myProgress2').attr("data-progress");
    // myProgress 1
    if (i == 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
        if (width >= progress) {
            clearInterval(id);
            i = 0;
        } else {
            width++;
            elem.style.width = width + "%";
        }
        }
    }
    // myProgress 2
    if (x == 0) {
        x = 1;
        var elem2 = document.getElementById("myBar2");
        var width2 = 1;
        var id2 = setInterval(frame2, 10);
        function frame2() {
        if (width2 >= progress2) {
            clearInterval(id2);
            x = 0;
        } else {
            width2++;
            elem2.style.width = width2 + "%";
        }
        }
        
    }
    });
    $("#coverProgress").on("click", function() {
    $('#contentProgress').removeClass('active');
    $('#coverProgress').hide();
    });
    
    </script>
@endpush
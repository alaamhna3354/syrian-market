<?php
header("Content-Type:text/css");

function hex2rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)';
    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }
    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }
    //Return rgb(a) color string
    return $output;
}


if (isset($_GET['primaryColor']) AND $_GET['primaryColor'] != '') {
    $primaryColor = hex2rgba("#" . $_GET['primaryColor']);
}else{
    $primaryColor = hex2rgba('#a460f2');
}


if (isset($_GET['subheading']) AND $_GET['subheading'] != '') {
    $subheading = hex2rgba("#" . $_GET['subheading']);
    $bggrdright2 = hex2rgba("#" . $_GET['subheading'],1);
    $bggrdright3 = hex2rgba("#" . $_GET['subheading'],0.76);
}else{
    $subheading = hex2rgba('#204dcc');
    $bggrdright2 = hex2rgba('#204DCC',1);
    $bggrdright3 = hex2rgba('#204DCC',0.76);
}



if (isset($_GET['bggrdleft']) AND $_GET['bggrdleft'] != '') {
    $bggrdleft = hex2rgba("#" . $_GET['bggrdleft'], 0.95);
    $bgrectsml = hex2rgba("#" . $_GET['bggrdleft'],1);
}else{
    $bggrdleft = hex2rgba('#7C35FF',0.95);
    $bgrectsml = hex2rgba("#7C35FF",1);
}




if (isset($_GET['bggrdright']) AND $_GET['bggrdright'] != '') {
    $bggrdright = hex2rgba("#" . $_GET['bggrdright'], 0.95);
    $btngrdright = hex2rgba("#" . $_GET['bggrdright'],1);
    $bgrectsmr = hex2rgba("#" . $_GET['bggrdright'],1);
}else{
    $bggrdright = hex2rgba('#5900FF',0.95);
    $btngrdright = hex2rgba('#5900FF',1);
    $bgrectsmr = hex2rgba('#5900FF',1);
}


if (isset($_GET['bggrdleft2']) AND $_GET['bggrdleft2'] != '') {
    $bggrdleft2 = hex2rgba("#" . $_GET['bggrdleft2'], 1);
    $bggrdleft3 = hex2rgba("#" . $_GET['bggrdleft2'],0.76);
}else{
    $bggrdleft2 = hex2rgba("#AF61F5",1);
    $bggrdleft3 = hex2rgba('#AF61F5',0.76);
}



if (isset($_GET['btngrdleft']) AND $_GET['btngrdleft'] != '') {
    $btngrdleft = hex2rgba("#" . $_GET['btngrdleft'],1);
}else{
    $btngrdleft = hex2rgba('#8340FF',1);
}


if (isset($_GET['copyrights']) AND $_GET['copyrights'] != '') {
    $copyrights = hex2rgba("#" . $_GET['copyrights'],1);
}else{
    $copyrights = hex2rgba('#1d43db',1);
}

?>

#main-wrapper[data-layout=vertical][data-sidebartype=full] .page-wrapper {
margin-left: 0;
}
#main-wrapper[data-layout=vertical] .topbar .top-navbar .navbar-header[data-logobg=skin6], #main-wrapper[data-layout=horizontal] .topbar .top-navbar .navbar-header[data-logobg=skin6] {
background: #f9fbfd;

border-bottom: 1px solid #edf2f9;
}

.topbar .navbar-collapse {
padding: 0 10px 0 0;
border-bottom: 1px solid #edf2f9;
border-left: 1px solid transparent;
}


.topbar .top-navbar .navbar-header {
box-shadow: unset;
-webkit-box-shadow: unset;
-moz-box-shadow: unset;
}

.card {
border-bottom: 1px solid #ab5e21;
background: transparent;
box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.2);
-webkit-box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.2);
}

.headerNav{
border-bottom: 1px solid rgba(162,176,190,.15);
box-shadow: 0 10px 10px 0 rgba(0,0,0,.15);
-webkit-box-shadow: 0 10px 10px 0 rgba(0,0,0,.15);
-moz-box-shadow: 0 10px 10px 0 rgba(0,0,0,.15);
width: 100%;
}
.headerNav .navbar {
display: flex;
}
.push-notification {
position: relative;
/*right: 12px;*/
/*top: 18px;*/
}
.headerNav .push-notification .notify-no {
position: absolute;
top: 0;
right: 4px;
line-height: 11px;
padding: 4px 6px;
}

.list-style-none .scrollable{
max-height: 250px;
overflow: auto;
}
/* width */
.list-style-none .scrollable::-webkit-scrollbar {
width: 3px;
}

/* Track */
.list-style-none .scrollable::-webkit-scrollbar-track {
background: #f1f1f1;
}

/* Handle */
.list-style-none .scrollable::-webkit-scrollbar-thumb {
background: <?php echo  $subheading;?>;
}

/* Handle on hover */
.list-style-none .scrollable::-webkit-scrollbar-thumb:hover {
background: #555;
}

.bell-font{
font-size: 1.25rem;
color: #b8c3d5;
}


.dropdown-item .active > .icon-color{
    color: #fff;
}

.dropdown-item .active > i.icon-color {
color: #fff;
}


@media screen and (max-width: 991px){
.headerNav .navbar {
display: flex;
align-items: center;
}

.headerNav .push-notification {
order: 2;
position: relative;
top: initial;
right: initial;
}
.headerNav .navbar-toggler {
order: 3;
}
.headerNav .navbar-collapse {
order: 4;
width: 100%;
align-items: flex-end !important;
text-align: right;
}
.headerNav .navbar-collapse .navbar-nav {
align-items: flex-end !important;
}
.headerNav .navbar{
padding-right: 0px;
}


}



.waves-effect,
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
color: #fff;
background-color: <?php echo $bggrdright3;?>;
border-radius: 6px;
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZhYzYxZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmYjhiMWUiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(left, <?php echo  $subheading;?> 0%, <?php echo $bggrdleft3;?> 100%);
background: -webkit-linear-gradient(left, <?php echo  $subheading;?> 0%,<?php echo $bggrdleft3;?> 100%);
background: linear-gradient(to right, #fe5917 0%,rgba(255, 171, 64, 0.76) 100%);
}


.btn-primary:not(:disabled):not(.disabled).active,
.btn-primary:not(:disabled):not(.disabled):active,
.show>.btn-primary.dropdown-toggle {
color: #fff;
border-color: <?php echo  $subheading;?>;
background: -moz-linear-gradient(left, <?php echo  $subheading;?> 0%, <?php echo $bggrdleft3;?> 100%);
background: -webkit-linear-gradient(left, <?php echo  $subheading;?> 0%,<?php echo $bggrdleft3;?> 100%);
background: linear-gradient(to right, <?php echo  $subheading;?> 0%,<?php echo $bggrdleft3;?> 100%);
}

#boltd .navbar-nav .nav-item a.nav-link,
#boltd .navbar-nav .nav-item a.nav-link{
display: inline-block;
padding: 8px 20px;
color: #000;
font-weight: 500;
border-radius: 6px;

}
#boltd .navbar-nav .nav-item  a.nav-link.active{
color: <?php echo  $primaryColor;?>;
background: transparent;
}

.dropdown-item.active, .dropdown-item:active {
background-color:<?php echo  $primaryColor;?>;
}

#boltd .navbar-nav li.nav-item.dropdown{
border-radius: 6px;
}
#boltd .navbar-nav li.nav-item.dropdown.active .nav-link{
color: #000;
}

#boltd .navbar-nav li.nav-item.dropdown.active .nav-link {
color:<?php echo  $primaryColor; ?>;
}

#boltd .navbar-nav li.nav-item.dropdown.active{
color: <?php echo  $subheading;?>;
background: transparent;
}
@media (min-width: 768px){

#main-wrapper[data-layout=vertical][data-sidebar-position=fixed][data-sidebartype=mini-sidebar] .topbar .top-navbar .navbar-collapse, #main-wrapper[data-layout=vertical][data-sidebartype=mini-sidebar] .page-wrapper {
margin-left: 0;
}
}

.topbar .top-navbar .navbar-header .navbar-brand {
padding: 0;
}
.navbar-brand img {
max-height: 50px !important;
}
.gateway-img{
width: 100%;
height: auto;
}

.card img.gateway{
height:  auto;
width: 100%;
}
.deposit-footer{
padding: .5rem 10px;
}
#main-wrapper {
min-height: 100vh;
background: white;
}
.page-wrapper {

box-shadow: unset;
}
.footer{
<!-- position: absolute; -->
bottom:0;
display: flex;
justify-content: center;
width: 100%;
background-color: #000;
}
.footer p{
padding-top:10px;
margin:0;
}
@media (max-width: 575px) {
.footer{
position:relative;
}
}


.breadcrumb.center-items{
display:inline-block;
margin:0 auto;
}
.breadcrumb{
display: inline-block;
padding: 0;
margin: 0;
background: transparent;
overflow: hidden;
}
.breadcrumb li{
float: left;
padding: 8px 15px 8px 50px;
background: linear-gradient(to right, <?php echo  $subheading;?> 0%,<?php echo $bggrdleft3;?> 100%);
font-size: 14px;
color: #fff;
position: relative;
}
.breadcrumb li:first-child{ background: #e9eef1; }
.breadcrumb li:last-child{
background: #fe5917;
margin-right: 18px;
}
.breadcrumb li:before{ display: none; }
.breadcrumb li:after{
content: "";
display: block;
border-left: 18px solid <?php echo $bggrdleft3;?>;
border-top: 18px solid transparent;
border-bottom: 18px solid transparent;
position: absolute;
top: 0;
right: -18px;
z-index: 1;
}
.breadcrumb li:first-child:after{ border-left-color: #e9eef1; }
.breadcrumb li:last-child:after{ border-left-color: #fe5917; }
.breadcrumb li a{
font-size: 14px;
font-weight: 500;
color: #151719;
}
@media only screen and (max-width: 479px){
.breadcrumb li{ padding: 8px 15px 8px 30px; }
}


.width-40p{
width: 40px;
}


.image-input {
position: relative;
width: 100%;
min-height: 300px;
background: #f0f8ff;
}

.image-input #image {
position: absolute;
opacity: 0;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 10;
cursor: pointer;
}

.image-input #image-label {
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
padding: 70px 100px;
z-index: 5;
opacity: 0.3;
cursor: pointer;
background-color: #fff;
font-size: 25px;
border: 2px dashed #000;
margin: auto;
text-align: center;
}

.image-input .preview-image {
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
max-width: 150px;
}



.sideNavTicket{
background: #dfe7f3;
color: #dbe5d8;
/*color: #307fb0;*/
/*color: #edf1eb;;*/
}

.chat-list .chat-item .chat-content .msg {
background-color: #eef5ff;
font-size: 14px;
max-width: 95%;
}

li.chat-item.list-style-none.replied.mt-3.text-right {
display: flex;
flex-direction: row-reverse;
}

.chat-list .chat-item.replied .chat-img {
margin-left: 15px;
}

.chat-list .chat-item.replied .chat-content .msg{
background-color: #e4fbf8;
text-align: left;
}


.button-wrapper {
position: relative;
background: rebeccapurple;
top: -5px;
}

.button-wrapper span.label {
position: relative;
z-index: 0;
background: #00bfff;
cursor: pointer;
color: #fff;
font-size: 18px;
}

#upload {
opacity: 0;
cursor: pointer;

}
.new-file-upload {
position: relative;
padding: 0;
display: flex;
align-items: center;
justify-content: center;
line-height: initial;
overflow: hidden;
width: 42px;
height: 42px;
border-radius: 50%;
background-color: <?php echo $bggrdright3;?>;
cursor: pointer;
}
.new-file-upload input[type=file] {
position: absolute;
top: 0;
left: 0;
width: 42px;
height: 42px;
border-radius: 50%;
cursor: pointer;
}
.new-file-upload span,
.new-file-upload span::before{
cursor: pointer;
}
.upload-btn{
position: relative;
}
.new-file-upload a{
color: #fff;
}

.select-files-count{
position: absolute;
font-size: 12px;
white-space: nowrap;
right: 20px;
}


.ticket-box{
background: #f9fbfd;
}
.deposit-footer{
padding: .75rem 10px;
}
.error {
font-size: 13px;
}
.copytext{
cursor: pointer;
}

.copyBoard{
background: #e9eef1;
color: #1c2d41;
}

.api-details {
margin-top: 20px;
background: #fff;
border-radius: 12px;
overflow: hidden;
-webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
}
.api-details .content {
padding: 20px 20px;
color: #171717;
font-size: 14px;
}
.api-details h5 {
background: #9ca3ad;
margin: 0;
padding: 20px 20px;
color: #fff;
font-size: 17px;
}
.api-details .content h6 {
text-transform: uppercase;
margin-bottom: 2px;
font-size: 14px;
font-weight: 700;
line-height: 1.2;
}
.api-details .content p {
font-weight: 400;
line-height: 1.5;
}

.api-code {
background: url(../../../../assets/images/dots.png) no-repeat 30px 30px #11064a;
border-radius: 12px;
color: #fff;
position: relative;
padding: 60px 30px 30px;
margin-top: 40px;
}


table tr {
background-color: #171717c4;
border: 1px solid #ddd;
padding: .35em;
}


table th {
font-size: .85em;
letter-spacing: .1em;
}
.table td, .table th {
padding: .625em;
vertical-align: top;
border-top: none;
}

.right-dropdown.dropdown-menu.dropdown-menu-right.mailbox.animated.bounceInDown.show {
width: 380px;
}
@media screen and (max-width: 600px) {
table {
border: 0;
}

table thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}

table tr {
/*border-bottom: none;*/
display: block;
margin-bottom: .625em;
}

table td {
border-bottom: none;
display: block;
font-size: .8em;
text-align: right;
}

table td::before {
content: attr(data-label);
float: left;
font-weight: bold;
}

table td:last-child {
border-bottom: 0;
}
}





/*---- FIXEDSIDEBAR ----*/




@media screen and (max-width: 360px){
.fixedsidebar {
    top: 125px;
}
.fixed-icon {
    top: 125px;
}
}
.fixed-icon i{
    color: #fff;
}


/* width */
.fixedsidebar::-webkit-scrollbar {
width: 3px;
}

/* Track */
.fixedsidebar::-webkit-scrollbar-track {
background: #f1f1f1;
}

/* Handle */
.fixedsidebar::-webkit-scrollbar-thumb {
background: #555;
}

/* Handle on hover */
.fixedsidebar::-webkit-scrollbar-thumb:hover {
background: #555;
}

.fs-header {
position: fixed;
width: 400px;
padding: 10px 7.5px;
background-color: #545051 ;
}
.fs-header h3{
color: #fff;
}
.btn-close {
display: inline-block;
padding: 0 8px;
color: #fff;
font-size: 16px;
cursor: pointer;
}
.fs-wrapper {
height: 100%;
padding: 63px 8px 0;
background: #f7f7f7;
}
.fs-wrapper .content{
margin: 5px;
padding: 10px;
border: 0;
font: inherit;
vertical-align: baseline;
-webkit-box-sizing: border-box;
box-sizing: border-box;
background: #fff;
box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
}


.featureDate {
font-size: 14px;
color: #8da2b5;
margin-bottom: 8px;
display: -ms-inline-flexbox;
display: flex;
flex-wrap: nowrap;
text-transform: capitalize;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
width: 100%;
white-space: nowrap;

}
.category {
display: inline-block;
background: <?php echo $btngrdleft;?>;
padding: 4px 6px;
font-size: 10px;
color: #fff;
border-radius: 10px;
margin-right: 5px;
overflow: hidden;
text-transform: uppercase;
-o-text-overflow: ellipsis;
text-overflow: ellipsis;
max-width: 100%;
vertical-align: middle;
white-space: nowrap;
}
.featureDate span {
display: inline-block;
vertical-align: baseline;
}
.featureDate .date, .featureDate span {
color: #8da2b5 !important;
}
.category.categoryNew, .catItem .ico.new {
background: #3ec25f !important;
}

.feature h3, h2.featureTitle {
font-size: 16px;
font-weight: 700;
margin-bottom: 15px;
line-height: 1.4;
}
.featureTitle {
font-size: 20px !important;
color: #000;
}
.featureContent {
font-size: 16px;
line-height: 1.4;
}

.featureContent p {
line-height: inherit;
margin-bottom: 15px;
padding: 0;
border: 0;
font-size: 100%;
font: inherit;
line-height: inherit;
vertical-align: baseline;
-webkit-box-sizing: border-box;
box-sizing: border-box;
}
#Notiflix-Icon-Success,
#Notiflix-Icon-Failure,
#Notiflix-Icon-Warning
{
fill: #fff !important;
}

span.font-12.d-block.text-muted.text-truncate {
color: #333 !important;
}

[v-cloak] {
display: none;
}
@media screen and (max-width:575px){

.fixedsidebar{
max-width: 280px;
}
.btn-close.close-sidebar {
position: absolute;
top: 0;
left: 65%;
}

}
html[dir=rtl],
html[dir=rtl] body{
text-align: right;
}
html[dir=rtl] .dropdown-menu {
text-align: right;
}

html[dir=rtl] .btn-primary{
margin-right: 5px;
}
html[dir=rtl] a.show-hide-icon.float-right{
float: left !important;
}

html[dir=rtl] button.btn.btn-default.btn-sm.text-white.float-right.waves-effect.generateBtn {
float: left !important;
}

html[dir=rtl] .modal-header .close {
padding: 0;
margin: 0;
}
html[dir=rtl] .upload-btn{
margin-left: 5px;
}
html[dir=rtl] li.chat-item.list-style-none.replied.mt-3.text-right .chat-content.d-inline-block.pr-3 .font-weight-medium{
text-align: left;
}
html[dir=rtl] li.chat-item.list-style-none.replied.mt-3.text-right .chat-time.d-block.font-10.mt-0.mr-0.mb-3{
text-align: left;
}

html[dir=rtl] .d-flex.d-lg-flex.d-md-block.align-items-center .ml-auto.mt-md-3.mt-lg-0{
margin-right: 50%;
}
.order-details-column{
width: 10%!important;
}

/*html[dir=rtl] .push-notification {*/
/*left: 12px;*/
/*}*/
/*html[dir=rtl] .headerNav .push-notification .notify-no {*/

/*}*/
html[dir=rtl] .breadcrumb.center-items {
display: flex !important;
}
html[dir=rtl] .breadcrumb li {
padding: 8px 50px 8px 8px;
}
html[dir=rtl] .breadcrumb li:last-child {
margin-right: 0;
}
html[dir=rtl] .breadcrumb li::before {
content: "";
display: block;
border-right: 18px solid #e9eef1;
border-left: 18px solid transparent;
border-top: 18px solid transparent;
border-bottom: 18px solid transparent;
position: absolute;
top: 0;
left: -36px;
z-index: 1;
}
html[dir=rtl] .breadcrumb li.active::before {
/*display: none;*/
border-right: 18px solid #fe5917;
}
html[dir=rtl] .breadcrumb li.custom-breadcrumb-li::before {
border-right: 18px solid <?php echo  $subheading;?>;
}
html[dir=rtl] .breadcrumb li::after{
display: none;
}




.admin-fa_icon  span.opacity-7.text-muted .fa,
.admin-fa_icon  span.opacity-7.text-muted .fas,
.admin-fa_icon  span.opacity-7.text-muted .far,
.admin-fa_icon  span.opacity-7.text-muted .fab,
.admin-fa_icon  span.opacity-7.text-muted .feather
{
color: <?php echo $primaryColor;?> !important;
}


@media (max-width: 375px) {
.admin-fa_icon .card .card-body {
padding: 25px 12px;
}
}


.admin-fa_icon h4.card-title{
font-weight: 500;
display: inline-block;
font-size: 24px;
color: #34395e;
}
.user-service-list .card-body{
padding: 15px 10px 0px 10px;
}

.user-service-list .card-body .table tr:nth-child(even) {
    background-color: #171717c4;
}

.user-service-list .card-body .table tr:nth-child(odd) {
    background-color: #171717c4;
}



.user-service-list .card-body.table td,
.user-service-list .card-body .table th {
padding: 5px;
vertical-align: top;
border-top: none;
font-size: 16px;
line-height: 1.4;
}
.user-service-list .card-body thead th {
background-color: #C1C7D0;
border-color: #C1C7D0;
color: #000;
}

.user-service-list .table td,
.user-service-list .table th{
    padding: .25em;
}
.bg-transparent{
background: transparent !important;
}




@media (max-width: 1440px){
#boltd .navbar-nav .nav-item a.nav-link, #boltd .navbar-nav .nav-item a.nav-link {
display: inline-block;
padding: 8px 14px;
color: #fff;
font-weight: 500;
border-radius: 6px;}
}
}


@media (max-width: 1366px){
#boltd .navbar-nav .nav-item a.nav-link, #boltd .navbar-nav .nav-item a.nav-link {
display: inline-block;
padding: 8px 8px;
color: #fff;
font-weight: 500;
border-radius: 6px;}
}
}




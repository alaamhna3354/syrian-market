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

:root {
--allcolor: #666666;
--wcolor: #ffffff;
--pcolor: #666666;
--h1h6: #232323;
--h1h6w: #ffffff;
--heading: #e2e3e5;
--subheading: <?php echo  $subheading; ?>;
--slogan: #232323;
--linkcolor: #1a2b47;
--allbg: #ffffff;
--secbg: #f3f7fd;
--bggrdleft: <?php echo  $bggrdleft; ?>;
--bggrdright: <?php echo  $bggrdright; ?>;
--bggrdleft2: <?php echo  $bggrdleft2; ?>;
--bggrdright2: <?php echo  $bggrdright2; ?>;
--bggrdleft3: <?php echo  $bggrdleft3; ?>;
--bggrdright3: <?php echo  $bggrdright3; ?>;
--btngrdleft: <?php echo  $btngrdleft; ?>;
--btngrdright: <?php echo  $btngrdright; ?>;
--bgbtnrm: #f3f7fd;
--border: #dfdfdf;
--allborder: #dfdfdf;
--wborder: #ffffff;
--allshadow: 0 1px 66.5px 3.5px rgba(223, 223, 223, 0.97);
--shadowblack: 0 1px 66.5px 3.5px rgba(0, 0, 0, 0.15);
--blogshadow: 0 1px 15px 3px rgba(0, 0, 0, 0.15);
--bgrectlg: #f0f6ff;
--bgrectsml: <?php echo  $bgrectsml; ?>;
--bgrectsmr: <?php echo  $bgrectsmr; ?>;
--recttop: 160px;
--rectleft: -214px;
--rectrotate: -45deg;
--copyrights: <?php echo  $copyrights; ?>;
}
*,
*:before,
*:after {
margin: 0;
padding: 0;
-webkit-box-sizing: inherit;
-moz-box-sizing: inherit;
box-sizing: inherit;
}
html {
position: relative;
float: left;
width: 100%;
height: 100%;
color: var(--allcolor);
font-size: 16px;
line-height: normal;
background-color: var(--allbg);
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
overflow-x: hidden;
}
body {
position: relative;
float: left;
width: 100%;
height: auto;
clear: both;
color: var(--allcolor);
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
line-height: normal;
letter-spacing: normal;
line-height: 24px;
background-color: var(--allbg);
-webkit-text-size-adjust: 100%;
-webkit-overflow-scrolling: touch;
-webkit-font-smoothing: antialiased !important;
overflow-x: hidden;
}
hr {
display: block;
height: 0;
margin: 100px 0;
padding: 0;
border: 0;
border-top: 1px solid #ffffff;
}
audio,
canvas,
img,
video {
display: initial;
margin: 0;
padding: 0;
border: 0;
vertical-align: middle;
}
p {
margin: 0;
padding: 0;
color: var(--pcolor);
font-size: 14px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
line-height: normal;
letter-spacing: normal;
}
a,
a:active,
a:hover,
a:focus {
text-decoration: none !important;
outline: none;
}
h1,
h2,
h3,
h4,
h5,
h6 {
margin: 0 !important;
padding: 0 !important;
color: var(--h1h6);
font-size: initial ;
font-weight: normal;
font-family: 'Poppins', sans-serif !important;
line-height: normal !important;
letter-spacing: 0 !important;
}
button,
button:hover,
button:focus {
border: 0;
background: none;
outline: none;
box-shadow: none;
cursor: pointer;
}
figure {
display: block;
margin: 0;
padding: 0;
border: 0;
}
figcaption{
color: #5e6d77;
font-size: 18px;
font-weight: 700;
font-family: 'Nunito', sans-serif;
line-height: normal;
letter-spacing: normal;
}
label{
margin: 0;
padding: 0;
color: #5e6d77;
font-size: 14px;
font-weight: 600;
font-family: 'Nunito', sans-serif;
line-height: normal;
letter-spacing: normal;
}
.label {
margin-bottom: 5px;
color: #5e6d77;
font-size: 14px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
line-height: 1.5;
letter-spacing: 0;
}
ul {
margin: 0 !important;
padding: 0 !important;
list-style: none;
}
ol {
margin: 0 !important;
padding: 0 0 0 15PX !important;
}
input,
select,
textarea {
color: #ffffff;
outline: 0;
}
input::-webkit-input-placeholder,
textarea::-webkit-input-placeholder {
color: #666666 !important;
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0.5px;
line-height: 22px;
opacity: 1;
}
input:-moz-placeholder,
textarea:-moz-placeholder {
color: #666666 !important;
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0.5px;
line-height: 22px;
opacity: 1;
}
input::-moz-placeholder,
textarea::-moz-placeholder {
color: #666666 !important;
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0.5px;
line-height: 22px;
opacity: 1;
}
input:-ms-input-placeholder,
textarea:-ms-input-placeholder {
color: #666666 !important;
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0.5px;
line-height: 22px;
opacity: 1;
}
.select-redesign select:required:invalid {
color: #666666 !important;
}
.select-resesign select option[value=""][disabled] {
display: none !important;
}
.form-control:focus {
box-shadow: none;
}
.textarea-control {
display: block;
width: 100%;
max-height: 100px;
padding: 10px 15px;
color: #666666;
font-size: 14px;
font-family: 'Nunito', sans-serif;
border: 1px solid #dfdfdf;
border-radius: 4px;
background-color: #ffffff;
}
.textarea-control:focus {
border-color: #80bdff !important;
}
nav,
header,
section,
footer {
position: relative;
float: left;
width: 100%;
clear: both;
}
.p {
color: var(--pcolor);
font-size: 16px;
font-weight: 400;
letter-spacing: normal;
line-height: 24px;
}
.text {
color: var(--pcolor);
font-size: 16px;
font-weight: 400;
line-height: 28px;
}
.pheading {
color: #204dcc;
font-size: 16px;
font-weight: 600;
font-family: 'Poppins', sans-serif;
letter-spacing: normal;
line-height: normal;
}
.h1 {
position: relative;
color: var(--h1h6);
font-size: 56px;
font-weight: 700;
line-height: 1.3 !important;
}
.h2 {
position: relative;
color: var(--h1h6);
font-size: 48px;
font-weight: 700;
}
.h3 {
position: relative;
color: var(--h1h6);
font-size: 36px;
font-weight: 600;
}
.h4 {
position: relative;
color: var(--h1h6);
font-size: 30px;
font-weight: 600;
}
.h5 {
position: relative;
color: var(--h1h6);
font-size: 24px;
font-weight: 600;

}
.h6 {
position: relative;
color: var(--h1h6);
font-size: 18px;
font-weight: 600;
}
.heading-container {
margin-bottom: 50px;
position: relative;
display: flex;
flex-direction: column;
flex-wrap: wrap;
align-items: center;
justify-content: center;
}
.heading {
position: relative;
display: inline-block;
color: var(--heading);
font-size: 120px;
font-weight: 700;
font-family: 'Poppins', sans-serif;
line-height: 1 !important;
letter-spacing: normal;

}
.sub-heading {
position: absolute;
top: 65%;
left: 50%;
width: auto;
height: auto;
color: var(--subheading);
font-size: 16px;
font-weight: 500;
font-family: 'Poppins', sans-serif;
line-height: 1 !important;
letter-spacing: normal;

-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
-moz-transform: translate(-50%, -50%);
-o-transform: translate(-50%, -50%);
transform: translate(-50%, -65%);
}
.slogan {
position: relative;
margin-top: 25px !important;
padding-bottom: 60px !important;
color: var(--h1h6);
font-size: 36px;
font-weight: 600;
font-family: 'Poppins', sans-serif;
line-height: 1 !important;
letter-spacing: normal;
}
.slogan::after {
content: '';
position: absolute;
bottom: 0;
left: 50%;
width: 204px;
height: 6px;
border: 0;
border-radius: 3px;
background: linear-gradient(90deg, var(--bggrdleft2) 40%, var(--bggrdright2) 60%);
transform: translate(-50%, 0%);
}
.heading-left > .sub-heading {
top: 65%;
left: 25%;
-webkit-transform: translate(-25%, -65%);
-ms-transform: translate(-25%, -65%);
-moz-transform: translate(-25%, -65%);
-o-transform: translate(-25%, -65%);
transform: translate(-25%, -65%);
}
.btn,
.btn:hover,
.btn:focus {
display: inline-block;
padding: 16px 50px;
color: var(--wcolor);
font-size: 15px;
font-weight: 500;
font-family: 'Poppins', sans-serif;
line-height: normal;
letter-spacing: normal;
text-align: center;

white-space: nowrap;
vertical-align: middle;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
border: 0;
border-radius: 4px;
outline: 0;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
box-shadow: none;
transition: color 0.35s ease-in-out, background-color 0.35s ease-in-out, border-color 0.35s ease-in-out, box-shadow 0.35s ease-in-out;
}
.btn:not(:disabled):not(.disabled).active,
.btn:not(:disabled):not(.disabled):active {
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
}
.btn-readmore,
.btn-priceplan {
position: relative;
display: inline-block;
padding: 12px 20px;
color: #204dcc;
font-size: 15px;
font-weight: 500;
font-family: 'Poppins', sans-serif;
line-height: normal;
letter-spacing: normal;

z-index: 0;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.btn-readmore:hover,
.btn-readmore:focus,
.btn-priceplan:hover,
.btn-priceplan:focus {
color: var(--wcolor) !important;
}
.btn-readmore::after,
.btn-priceplan::after {
content: '';
position: absolute;
top: 0;
left: 0;
width: 30%;
height: 100%;
border: 0;
border-radius: 10px;
background-color: var(--bgbtnrm);
z-index: -1;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.btn-readmore:hover::after,
.btn-priceplan:hover::after {
width: 100%;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.btn-hero,
#banner-wrap .btn,
.form-content .btn,
.comment-form .btn,
.reply .btn,
.error-content .btn {
position: relative;
display: inline-block;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.btn-hero::before,
#banner-wrap .btn::before,
.form-content .btn::before,
.comment-form .btn::before,
.reply .btn::before,
.error-content .btn::before {
content: '';
position: absolute;
top: -4px;
left: -4px;
width: 0;
height: 0;
opacity: 0;
border: 2px solid transparent;
border-top: 2px solid #f87863;
border-left: 2px solid #f87863;
border-top-left-radius: 4px;
background-color: transparent;
-webkit-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-moz-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-ms-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-o-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;

}
.btn-hero::after,
#banner-wrap .btn::after,
.form-content .btn::after,
.comment-form .btn::after,
.reply .btn::after,
.error-content .btn::after {
content: '';
position: absolute;
right: -4px;
bottom: -4px;
width: 0;
height: 0;
opacity: 0;
border: 2px solid transparent;
border-right: 2px solid #f87863;
border-bottom: 2px solid #f87863;
border-bottom-right-radius: 4px;
background-color: transparent;
-webkit-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-moz-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-ms-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-o-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;

}
.btn-hero:hover::before,
#banner-wrap .btn:hover::before,
.form-content .btn:hover::before,
.comment-form .btn:hover::before,
.reply .btn:hover::before,
.error-content .btn:hover::before {
width: 31.5px;
height: 31.5px;
opacity: 1;
-webkit-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-moz-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-ms-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-o-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
}
.btn-hero:hover::after,
#banner-wrap .btn:hover::after,
.form-content .btn:hover::after,
.comment-form .btn:hover::after,
.reply .btn:hover::after,
.error-content .btn:hover::after {
width: 31.5px;
height: 31.5px;
opacity: 1;
-webkit-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-moz-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-ms-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
-o-transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
transition: opacity 0.35s ease-in-out, width 0.35s ease-in-out, height 0.35s ease-in-out;
}
.toggle-wrapper {
margin-bottom: 75px;
display: flex;
align-items: center;
justify-content: center;
}
.switch {
position: relative;
display: block;
width: 220px;
height: 50px;
border: 0;
border-radius: 4px;
}
.switch input {
opacity: 0;
width: 0;
height: 0;
}
.toggle-switch {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
padding: 0 30px;
display: flex;
align-items: center;
justify-content: space-between;
color: #666666;
font-size: 15px;
font-weight: 500;
font-family: 'Poppins', sans-serif;
letter-spacing: normal;
line-height: 50px;
text-align: right;
border: 0;
border-radius: 4px;
background-color: #e2e3e5;
}
.toggle-switch::before {
position: absolute;
content: "Monthly";
width: 50%;
height: 100%;
bottom: 0;
left: 0;
color: #ffffff;
font-size: 15px;
font-weight: 500;
font-family: 'Poppins', sans-serif;
letter-spacing: normal;
line-height: 50px;
text-align: center;
border: 0;
border-radius: 4px;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
-webkit-transition: transform 0.35s ease;
-moz-transition: transform 0.35s ease;
-ms-transition: transform 0.35 ease;
-o-transition: transform 0.35s ease;
transition: transform 0.35s ease;
}
.toggle-switch-content::before {
content: 'Yearly' !important;
}
.switch input:checked + .toggle-switch {
background-color: #e2e3e5;
}
.switch input:focus + .toggle-switch {
box-shadow: none;
}
.switch input:checked + .toggle-switch:before {
-webkit-transform: translateX(100%);
-moz-transform: translateX(100%);
-ms-transform: translateX(100%);
-o-transform: translateX(100%);
transform: translateX(100%);
}
.m-0 {
margin: 0 !important;
}
.mt-0 {
margin-top: 0 !important;
}
.mt-5 {
margin-top: 5px !important;
}
.mt-10 {
margin-top: 10px !important;
}
.mt-15 {
margin-top: 15px !important;
}
.mt-20 {
margin-top: 20px !important;
}
.mt-25 {
margin-top: 25px !important;
}
.mt-30 {
margin-top: 30px !important;
}
.mt-40 {
margin-top: 40px !important;
}
.mr-0 {
margin-right: 0 !important;
}
.mr-5 {
margin-right: 5px !important;
}
.mr-10 {
margin-right: 10px !important;
}
.mr-15 {
margin-right: 15px !important;
}
.mr-25 {
margin-right: 25px !important;
}
.mb-0 {
margin-bottom: 0 !important;
}
.mb-5 {
margin-bottom: 5px !important;
}
.mb-10 {
margin-bottom: 10px !important;
}
.mb-15 {
margin-bottom: 15px !important;
}
.mb-20 {
margin-bottom: 20px !important;
}
.mb-25 {
margin-bottom: 25px !important;
}
.mb-30 {
margin-bottom: 30px !important;
}
.mb-40 {
margin-bottom: 40px !important;
}
.mb-50 {
margin-bottom: 50px !important;
}
.ml-0 {
margin-left: 0 !important;
}
.ml-5 {
margin-left: 5px !important;
}
.ml-10 {
margin-left: 10px !important;
}
.ml-15 {
margin-left: 15px !important;
}
.ml-20 {
margin-left: 20px !important;
}
.p-0 {
padding: 0 !important;
}
.pt-0 {
padding-top: 0 !important;
}
.pt-5 {
padding-top: 5px !important;
}
.pt-10 {
padding-top: 10px !important;
}
.pt-15 {
padding-top: 15px !important;
}
.pt-20 {
padding-top: 20px !important;
}
.pt-25 {
padding-top: 25px !important;
}
.pt-30 {
padding-top: 30px !important;
}
.pt-40 {
padding-top: 40px !important;
}
.pt-50 {
padding-top: 50px !important;
}
.pr-0 {
padding-right: 0 !important;
}
.pr-5 {
padding-right: 5px !important;
}
.pr-10 {
padding-right: 10px !important;
}
.pr-15 {
padding-right: 15px !important;
}
.pr-20 {
padding-right: 20px !important;
}
.pr-25 {
padding-right: 25px !important;
}
.pr-30 {
padding-right: 30px !important;
}
.pl-0 {
padding-left: 0 !important;
}
.pl-5 {
padding-left: 5px !important;
}
.pl-10 {
padding-left: 10px !important;
}
.pl-15 {
padding-left: 15px !important;
}
.pl-20 {
padding-left: 20px !important;
}
.pl-25 {
padding-left: 25px !important;
}
.pl-30 {
padding-left: 30px !important;
}
.pl-65 {
padding-left: 65px !important;
}
.pb-0 {
padding-bottom: 0 !important;
}
.pb-5 {
padding-bottom: 5px !important;
}
.pb-10 {
padding-bottom: 10px !important;
}
.pb-15 {
padding-bottom: 15px !important;
}
.pb-20 {
padding-bottom: 20px !important;
}
.pb-25 {
padding-bottom: 25px !important;
}
.pb-30 {
padding-bottom: 30px !important;
}
.border {
border: 0 !important;
border-bottom: 1px solid var(--border) !important;
}
.br-4 {
border-radius: 4px !important;
}
.img-br-6 {
border-radius: 6px !important;
}
.f-initial {
float: initial !important;
}
.w-100 {
width: 100% !important;
}
.h-100 {
height: 100% !important;
}
.img-w {
width: 100%;
}
.lineheight-30 {
line-height: 30px !important;
}
.sec-bg {
background: initial !important;
background-image: initial !important;
background-color: var(--secbg) !important;
}
.bg-grey {
background-color: #f1f1f1 !important;
}
.bx-shadow {
box-shadow: var(--shadowblack) !important;
}
.blog-shadow {
box-shadow: var(--blogshadow) !important;
}
.shadow-none {
box-shadow: none !important;
}
.shape-rectangle {
position: absolute;
top: 160px;
left: -214px;
max-width: 407px;
max-height: 144px;
z-index: 0;
-webkit-transform: rotate(-45deg);
-moz-transform: rotate(-45deg);
-ms-transform: rotate(-45deg);
-o-transform: rotate(-45deg);
transform: rotate(-45deg);
-webkit-transition: transform 0.35s ease;
-moz-transition: transform 0.35s ease;
-ms-transition: transform 0.35s ease;
-o-transition: transform 0.35s ease;
transition: transform 0.35s ease;
}
.shape-rectangle .rectangle-lg {
position: relative;
width: 407px;
height: 144px;
border: 0;
border-radius: 72px;
background-color: var(--bgrectlg);
z-index: 2;
}
.shape-rectangle .rectangle-sm {
position: absolute;
top: 50%;
right: 25%;
width: 333px;
height: 106px;
border: 0;
border-radius: 53px;
background: linear-gradient(145deg, var(--bgrectsml) 0%, var(--bgrectsmr) 100%);
z-index: 3;
transform: translate(-10%, 25%);
-webkit-transition: transform 0.35s ease;
-moz-transition: transform 0.35s ease;
-ms-transition: transform 0.35s ease;
-o-transition: transform 0.35s ease;
transition: transform 0.35s ease;
}
.shape-circle {
position: absolute;
top: -127px;
right: 0;
width: 104px;
height: 254px;
z-index: 0;
background-color: var(--bgrectlg);
clip-path: circle(127px at 124% 50%);
}
.circle {
position: relative;
width: 100%;
height: 100%;
background: <?php echo  $primaryColor?>;
clip-path: circle(76px at 124% 50%);
}
.left-shape.shape-circle {
right: initial;
left: 0;
-webkit-transform: rotate(-180deg);
-moz-transform: rotate(-180deg);
-ms-transform: rotate(-180deg);
-o-transform: rotate(-180deg);
transform: rotate(-180deg);
}
.wrapper {
position: relative;
padding: 24px;
z-index: 0;
}
.wrapper:before {
content: '';
position: absolute;
top: 0;
right: 0;
width: 128px;
height: 108px;
border: 0;
border-radius: 10px;
background: linear-gradient(109deg, var(--bggrdleft3) 0%, var(--bggrdright3) 100%);
z-index: -1;
}
.wrapper:after {
content: '';
position: absolute;
bottom: 0;
left: 0;
width: 83px;
height: 71px;
border: 0;
border-radius: 10px;
background: linear-gradient(109deg, var(--bggrdleft3) 0%, var(--bggrdright3) 100%);
z-index: 1;
}
.text-wrapper {
position: relative;
float: left;
width: 100%;
clear: both;
padding-left: 30px;
}
.text-block {
position: relative;
float: left;
width: 100%;
clear: both;
padding-top: 0;
padding-left: 40px;
}
/*--------------------------------------------------------------------
CARD DESIGN
----------------------------------------------------------------------*/
.card-img-top {
border-top-right-radius: 4px;
border-top-left-radius: 4px;
}
.card-img-br-0 {
border-radius: 0 !important;
}
.card-type-1.card {
height: 100%;
padding: 68px 33px;
border: 0;
border-radius: 0;
background-color: var(--allbg);
box-shadow: var(--allshadow);
}
.card-icon {
position: relative;
text-align: center;
}
.card-icon > img {
width: auto;
max-width: 100%;
}
.card-type-1 > .card-body {
padding: 0 0;
text-align: center;
}
.card-type-1 > .card-body > .card-title {
margin: 20px 0 !important;
color: var(--h1h6);
font-size: 22px;
font-weight: 600;
}
.card-type-1 > .card-body > .card-text {
font-size: 15px;
font-weight: 400;
line-height: 28px;
}
.card-type-1 > .card-body > .btn-readmore {
margin-top: 40px;
}
.card-type-4.card {
padding: 40px 15px;
border: 0;
border-radius: 0;
background-color: var(--allbg);
box-shadow: var(--allshadow);
}
.card-type-4 > .card-body {
padding: 0 0;
text-align: center;
}
.card-type-4 > .card-body > .card-title {
margin: 20px 0 !important;
color: var(--h1h6);
font-size: 18px;
font-weight: 600;
}
.card-type-4 > .card-body > .card-text {
font-size: 15px;
font-weight: 400;
line-height: 28px;
}
/*--------------------------------------------------------------------
MODAL DESIGN [VIDEO]
----------------------------------------------------------------------*/
#modal-video {
display: none;
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
float: left;
width: 100%;
height: 100vh;
background-color: rgba(0, 0, 0, 0.75);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
overflow: hidden;
z-index: 999999;
}
#modal-video.modal-open {
display: block;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
-webkit-overflow: hidden;
overflow: hidden;
}
.modal-wrapper {
width: 100%;
height: 100%;
padding: 60px 15px;
display: flex;
flex-direction: column;
flex-wrap: wrap;
align-items: center;
justify-content: center;
}
.modal-content {
position: relative;
margin: 0 auto;
padding: 0 0;
width: 100%;
height: 100%;
max-width: 1110px;
border: 0;
border-radius: 4px;
background-color: #ffffff;
}
.modal-container {
width: 100%;
height: 100%;
}
.btn-close {
position: absolute;
top: -35px;
right: -1px;
width: auto;
height: auto;
padding-top: 5px;
padding-left: 5px;
padding-bottom: 5px;
border-radius: 0;
color: #ffffff;
font-size: 30px;
font-weight: 500;
font-family: 'Nunito', sans-serif;
line-height: 1;
text-align: center;
cursor: pointer;
background-color: transparent;
z-index: 99999;
}
/*--------------------------------------------------------------------
PAGE STYLES - HOME PAGE 01
----------------------------------------------------------------------*/
/*---- NAVBAR ----*/
#navbar {
position: relative;
background-color: #ffffff;
box-shadow: 2px 5px 13px rgba(235, 234, 231, 0.7);
}
#navbar .navbar {
padding: 27px 0;
}
#navbar .navbar .navbar-brand {
padding-top: 0;
padding-bottom: 0;
}
#navbar .navbar .navbar-brand img {
max-width: 200px;
max-height: 46px;
}
#smmnavbar {
justify-content: flex-end;
}
#smmnavbar .nav-link {
color: #232323;
padding: 0 15px;
font-size: 16px;
font-weight: 600;
font-family: 'Poppins', sans-serif;
line-height: normal;
letter-spacing: normal;
vertical-align: middle;
}
#smmnavbar .nav-registration {
margin-left: 150px !important;
}
#smmnavbar .nav-link.active{
color: <?php echo $primaryColor; ?>;
}
#smmnavbar .nav-registration .nav-link {
position: relative;
padding: 11px 30px;
color: #232323;
font-size: 16px;
font-weight: 600;
font-family: 'Poppings', sans-serif;
line-height: normal;
letter-spacing: normal;
border: 0;
border-radius: 4px;
background-color: transparent;
-webkit-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
vertical-align: middle;
}
#smmnavbar .nav-registration .nav-link span {
position: relative;
z-index: 1;
}
#smmnavbar .nav-registration .nav-link::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 0;
height: 100%;
color: #ffffff;
font-size: 16px;
font-weight: 600;
font-family: 'Poppins', sans-serif;
line-height: 40px;
text-align: center;
border: 0;
border-radius: 4px;
background: linear-gradient(65deg, var(--btngrdleft) 0%, var(--btngrdright) 100%);
-webkit-transition: width 0.35s ease-in-out;
-ms-transition: width 0.35s ease-in-out;
-moz-transition: width 0.35s ease-in-out;
-o-transition: width 0.35s ease-in-out;
transition: width 0.35s ease-in-out;
z-index: 0;
}
#smmnavbar .nav-registration .nav-link:hover,
#smmnavbar .nav-registration .active.nav-link {
color: #ffffff;
}
#smmnavbar .nav-registration .nav-link:hover::before,
#smmnavbar .nav-registration .active.nav-link::before {
width: 100%;
-webkit-transition: width 0.35s ease-in-out;
-ms-transition: width 0.35s ease-in-out;
-moz-transition: width 0.35s ease-in-out;
-o-transition: width 0.35s ease-in-out;
transition: width 0.35s ease-in-out;
}
@media (max-width: 1199px) {

.menu-icon {
position: relative;
width: 100%;
height: 100%;
display: inline-flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
}
.menu-icon span {
position: relative;
margin-bottom: 6px;
display: inline-block;
width: 30px;
height: 4px;
border: 0;
border-radius: 3px;
background-color: #232323;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.menu-icon span::after {
content: '';
display: inline-block;
position: absolute;
top: 0;
left: 0;
width: 0;
height: 100%;
border: 0;
border-radius: 3px;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
-webkit-transition: width 0.35s ease-in-out;
-moz-transition: width 0.35s ease-in-out;
-ms-transition: width 0.35s ease-in-out;
-o-transition: width 0.35s ease-in-out;
transition: width 0.35s ease-in-out;
}
.menu-icon span:last-child {
margin-bottom: 0;
}
.custom-toggler .menu-icon span::after,
.menu-icon:hover span::after {
width: 100%;
-webkit-transition: width 0.35s ease-in-out;
-moz-transition: width 0.35s ease-in-out;
-ms-transition: width 0.35s ease-in-out;
-o-transition: width 0.35s ease-in-out;
transition: width 0.35s ease-in-out;
}
#smmnavbar .nav-registration .nav-link::before,
#smmnavbar .nav-registration .active.nav-link::before {
display: none;
}
}
/*---- HERO ----*/
#hero {
position: relative;
background-color: #ffffff;
}
#hero-banner {
position: relative;
float: left;
width: 100%;
clear: both;
}
.hero-fig {
position: absolute;
top: 0;
right: 0;
max-width: 715px;
height: 670px;
z-index: 0;
}
.hero-fig > img {
width: 100%;
height: 100%;
clip-path: circle(60% at 61.10% 37.18%);
}
.hero-fig-overlay {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 1;
clip-path: circle(60% at 61.10% 37.18%);
background: linear-gradient(147deg, var(--bggrdleft) 0%, var(--bggrdright) 100%);
}
.hero-fig-img {
position: absolute;
top: 60px;
left: 50px;
border: 29px solid #ffffff;
border-radius: 50%;
z-index: 3;
}
.hero-fig-img img {
border-radius: 50%;
}
.hero-content {
margin-top: 130px;
}

.hero-fig-img img {
max-width: 375px;
}
/*---- FEATURE ----*/
#feature {
position: relative;
margin-top: 132px;
margin-bottom: 75px;
padding-top: 109px;
}
/*---- ABOUT-US ----*/
#about-us {
margin: 75px 0;
background-color: var(--allbg);
}
.youtube-wrapper {
position: absolute;
top: 24px;
left: 24px;
width: calc(100% - 48px);
height: calc(100% - 48px);
border: 0;
border-radius: 4px;
background: linear-gradient(90deg, rgba(0, 0, 0, 0.15) 0%, rgba(0, 0, 0, 0.15) 100%);

}
.youtube-wrapper .btn-container {
width: 100%;
height: 100%;
display: flex;
align-items: center;
justify-content: center;
}
.youtube-wrapper .btn-container .btn-play {
position: relative;
display: flex;
align-items: center;
justify-content: center;
width: 75px;
height: 75px;
padding: 15px;
border-radius: 50%;
background: #f87863;
cursor: pointer;
}
.youtube-wrapper .btn-container .btn-play::after {
content: '';
position: absolute;
width: calc(100% + 25px);
height: calc(100% + 25px);
border: 20px solid;
border-radius: 50%;
border-color: rgba(248, 120, 99, 0.95);
transition: all 1.75s ease-in-out;
}
.youtube-wrapper .btn-container .btn-play i {
color: #ffffff;
font-size: 28px;
}
.grow-play::after {
-webkit-animation: grow-play 1.9s ease-in-out infinite;
-moz-animation: grow-play 1.9s ease-in-out infinite;
-ms-animation: grow-play 1.9s ease-in-out infinite;
-o-animation: grow-play 1.9s ease-in-out infinite;
animation: grow-play 1.9s ease-in-out infinite;
}
@keyframes grow-play {
0% {
width: 100%;
height: 100%;
opacity: 1;
-webkit-transition: width 0.5s ease-in-out;
-moz-transition: width 0.5s ease-in-out;
-ms-transition: width 0.5s ease-in-out;
-o-transition: width 0.5s ease-in-out;
transition: width 0.5s ease-in-out;
}
50% {
width: calc(100% + 25px);
height: calc(100% + 25px);
opacity: 0;
-webkit-transition: width 1s ease-in-out;
-moz-transition: width 1s ease-in-out;
-ms-transition: width 1s ease-in-out;
-o-transition: width 1s ease-in-out;
transition: width 1s ease-in-out;
}
100% {
width: 100%;
height: 100%;
opacity: 0;
-webkit-transition: width 1.5s ease-in-out;
-moz-transition: width 1.5s ease-in-out;
-ms-transition: width 1.5s ease-in-out;
-o-transition: width 1.5s ease-in-out;
transition: width 1.5s ease-in-out;
}
}
/*---- HOW-IT-WORKS ----*/
#how-it-works {
margin: 75px 0;
}
.how-it-works {
margin-top: 60px;
display: flex;
flex-flow: row wrap;
align-items: center;
justify-content: space-between;
}
.how-it-works .content-wrapper {
position: relative;
flex: 0 0 calc(((100%)/4) - 60px);
padding: 30px 15px;
text-align: center;
border: 0;
border-radius: 4px;
background-color: var(--allbg);
-webkit-box-shadow: var(--allshadow);
-moz-box-shadow: var(--allshadow);
box-shadow: var(--allshadow);
}
.how-it-works .content-wrapper::after {
content: '\ea94';
position: absolute;
font-family: IcoFont;
color: <?php echo $primaryColor;?>;
font-size: 45px;
top: 50%;
right: -62.5px;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
-ms-transform: translateY(-50%);
-o-transform: translateY(-50%);
transform: translateY(-50%);
}
.how-it-works .content-wrapper:last-child::after {
display: none;
}
.how-it-works .content-wrapper .icon i {
color: <?php echo $primaryColor;?>;
font-size: 36px;
}
/*---- SERVICES ----*/
#services {
margin: 75px 0;
padding: 150px 0 0;
background-image: url(../images/bg_service.png);
background-position: top center;
background-size: contain;
background-repeat: no-repeat;
background-color: var(--allbg);
}
/*---- VISION ----*/
#vision {
position: relative;
margin: 75px 0;
}
.progress-container {
position: relative;
float: left;
width: 100%;
margin-top: 30px;
}
.progress-container .single-progressbar {
margin-bottom: 13px;
padding-bottom: 15px;
border-bottom: 1px solid #dfdfdf;
text-align: left;
}
.progress-container .single-progressbar:last-child {
margin-bottom: 0;
}
.progress-container .single-progressbar .title {
color: #232323;
font-size: 14px;
font-weight: 700;
font-family: 'Nunito', sans-serif;
line-height: 28px;
letter-spacing: 0;

}
.progress-container .single-progressbar .progressbar {
position: relative;
width: 100%;
margin-top: 0;
margin-bottom: 0;
background-color: #e9ecef;
}
.progress-container .single-progressbar .proggress {
width: 0;
height: 4px;
background-color: initial !important;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%) !important;
}
.progress-container .single-progressbar .percentCount {
float: right;
margin-top: -38px;
color: #232323;
font-size: 14px;
font-weight: 700;
font-family: 'Nunito', sans-serif;
line-height: 28px;
letter-spacing: 0;

}
/*---- COUNTER ----*/
#counter {
margin: 75px 0;
background-color: var(--allbg);
}
.counter-wrap {
position: relative;
float: left;
width: 100%;
padding: 100px 0;
border: 0;
border-top-left-radius: 100px;
border-bottom-right-radius: 100px;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
}
.counting {
text-align: center;
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
}
.counter-heading {
display: flex;
align-items: center;
justify-content: space-between;
}
.counting .h2 {
color: var(--wcolor);
}
.counting p {
color: var(--wcolor);
font-size: 16px;
font-weight: 600;
font-family: 'Poppins', sans-serif;
line-height: normal;
letter-spacing: 0.75px;

}
/*---- FEATURED-WORK ----*/
#featured-work {
margin: 75px 0;
background-color: var(--allbg);
}
.thumbnail {
position: relative;
margin-bottom: 30px;
border: 0;
border-radius: 4px;
-webkit-overflow: hidden;
-ms-overflow-style: none;
overflow: hidden;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.thumbnail img {
width: 100%;
border-radius: 4px;
-webkit-transform: scale(1, 1);
-moz-transform: scale(1, 1);
-ms-transform: scale(1, 1);
-o-transform: scale(1, 1);
transform: scale(1, 1);
-webkit-transition: transform 0.35s ease-in-out;
-moz-transition: transform 0.35s ease-in-out;
-ms-transition: transform 0.35s ease-in-out;
-o-transition: transform 0.35s ease-in-out;
transition: transform 0.35s ease-in-out;
}
.thumbnail-overlay {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
display: flex;
align-items: center;
justify-content: center;
border: 0;
border-radius: 4px;
-webkit-transform: scale(0, 0);
-moz-transform: scale(0, 0);
-ms-transform: scale(0, 0);
-o-transform: scale(0, 0);
transform: scale(0, 0);
background: linear-gradient(109deg, var(--bggrdleft3) 0%, var(--bggrdright3) 100%);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.thumbnail:hover {
box-shadow: 0 0 30px 10px rgb(0, 0, 0, 0.15);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.thumbnail:hover img {
-webkit-transform: scale(1.1, 1.1);
-moz-transform: scale(1.1, 1.1);
-ms-transform: scale(1.1, 1.1);
-o-transform: scale(1.1, 1.1);
transform: scale(1.1, 1.1);
}
.thumbnail:hover .thumbnail-overlay {
-webkit-transform: scale(1, 1);
-moz-transform: scale(1, 1);
-ms-transform: scale(1, 1);
-o-transform: scale(1, 1);
transform: scale(1, 1);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.thumbnail-overlay a,
.thumbnail-overlay a:hover,
.thumbnail-overlay a:focus {
padding: 5px 5px;
color: #ffffff;
font-size: 24px;

}
#featured-work .row .col-md-4:nth-child(4) .thumbnail,
#featured-work .row .col-md-4:nth-child(5) .thumbnail,
#featured-work .row .col-md-4:nth-child(6) .thumbnail {
margin-bottom: 0;
}
/*---- BANNER-WRAP ----*/
#banner-wrap {
margin: 75px 0;
padding: 75px 0;
background-size: cover;
background-position: center center;
background-repeat: no-repeat;
}
#banner-wrap .content {
width: 100%;
height: 100%;
display: flex;
flex-flow: column wrap;
align-items: flex-start;
justify-content: center;
}
#banner-wrap .content .h3 {
color: var(--wcolor);
line-height: 48px !important;
}
#banner-wrap .content p {
margin: 40px 0 !important;
color: var(--wcolor);
font-size: 24px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: 2;
}
#banner-wrap .content .btn {
color: #204dcc;
background: #ffffff !important;
}
#banner-wrap .img-container {
position: relative;
text-align: right;
z-index: 0;
display: flex;
flex-flow: row nowrap;
align-items: center;
justify-content: flex-end;
border-radius: 50%;
}
#banner-wrap .img-container img {
display: block;
float: right;
border-radius: 50%;
}
#banner-wrap .img-container:before {
content: '';
position: absolute;
top: calc(0% + 20px);
right: calc(0% + 50px);
width: 100%;
height: 100%;
background-color: #e17375;
z-index: -1;
border-radius: 50%;
max-width: 386px;
}
/*---- PRICING ----*/
#pricing {
margin: 75px 0;
background-color: var(--allbg);
}
#pricing .shape-rectangle {
top: initial;
bottom: 3.5%;
}
#pricing .shape-circle {
top: 25%;
}
.price-plan {
position: relative;
width: 100%;
height: auto;
padding: 36px 34px;
text-align: center;
border: 0;
border-radius: 0;
background-color: var(--allbg);
box-shadow: var(--allshadow);
overflow: hidden;
}
.basic,
.platinum {
margin-top: 38px;
}
.basic:after,
.advance:after,
.platinum:after {
content: '';
position: absolute;
bottom: -20px;
left: -20px;
width: 79px;
height: 79px;
border: 0;
border-top-right-radius: 50%;
border-bottom-right-radius: 50%;
background-color: #af61f5;
-webkit-transform: rotate(-45deg);
-moz-transform: rotate(-45deg);
-ms-transform: rotate(-45deg);
-o-transform: rotate(-45deg);
transform: rotate(-45deg);

}
.advance:after {
background-color: #79d8e5;
}
.platinum:after {
background-color: #f87863;
}
.basic > .h1,
.advance > .h1,
.platinum > .h1 {
color: #af61f5;
font-size: 42px;
font-weight: 600;
line-height: 2 !important;
}
.advance > .h1 {
color: #79d8e5;
}
.platinum > .h1 {
color: #f87863;
}
.basic > .h5,
.advance > .h5,
.platinum > .h5 {
margin-bottom: 40px !important;
color: #af61f5;
text-align: left;
}
.advance > .h5 {
color: #79d8e5;
}
.platinum > .h5 {
color: #f87863;
}
.price-plan p {
margin-bottom: 10px !important;
color: #666666;
font-size: 15px;
line-height: 2;
}
.price-plan > .h6 {
color: #666666;
font-size: 16px;
font-weight: 500;
line-height: 2 !important;
}
.price-plan > .separator {
margin: 30px 0;
border-bottom: 1px solid #dfdfdf;
}
.price-plan .btn-container {
margin: 20px 0;
text-align: right;
}
.basic .btn-priceplan {
color: #af61f5;
}
.advance .btn-priceplan {
color: #79d8e5;
}
.platinum .btn-priceplan {
color: #f87863;
}
/*---- TESTIMONIAL ----*/
#testimonial {
margin: 75px 0;
background-color: var(--allbg);
}
.testimonial-slider {
position: relative;
float: left;
width: 100%;
clear: both;
}
.testimonial-img-150 {
width: 150px;
}
.circle-layout {
width: 100%;
height: 100%;
display: flex;
align-items: center;
justify-content: center
}
.circle-indicators.carousel-indicators {
position: relative;
}
.circle-indicators {
display: block;
width: 100%;
height: 100%;
max-width: 459px;
max-height: 459px;
border: 1px solid #dfdfdf;
border-radius: 50%;
}
.circle-indicators li {
position: absolute;
display: inline-block;
margin: initial;
padding: initial;
width: initial;
height: initial;
text-indent: initial;
background-color: transparent;
border: 0;
border-radius: 50%;
cursor: pointer;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.circle-indicators li:hover {
box-shadow: 0 0 15px 2px rgba(0, 0, 0, 0.35);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.circle-indicators .nav-place-1 {
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-moz-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
-o-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
}
.circle-indicators .nav-place-2 {
top: 0;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-moz-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
-o-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
}
.circle-indicators .nav-place-3 {
top: 50%;
right: 0;
-webkit-transform: translate(50%, -50%);
-moz-transform: translate(50%, -50%);
-ms-transform: translate(50%, -50%);
-o-transform: translate(50%, -50%);
transform: translate(50%, -50%);
}
.circle-indicators .nav-place-4 {
bottom: 0;
left: 50%;
-webkit-transform: translate(-50%, 50%);
-moz-transform: translate(-50%, 50%);
-ms-transform: translate(-50%, 50%);
-o-transform: translate(-50%, 50%);
transform: translate(-50%, 50%);
}
.circle-indicators .nav-place-5 {
top: 50%;
left: 0;
-webkit-transform: translate(-50%, -50%);
-moz-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
-o-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
}
.circle-indicators .active {
box-shadow: 0 0 15px 2px rgba(0, 0, 0, 0.35);
background-color: transparent;
}

.circle-indicators > li > img{
border-radius: 50%;
}
.item-icon {
display: inline-block;
margin-bottom: 30px;
padding: 15px 15px;
border: 0;
border-radius: 50%;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2));
}
.item-icon i {
color: var(--wcolor);
font-size: 56px;
}
.clients-title > h6 {
color: var(--h1h6);
font-size: 18px;
font-weight: 600;
line-height: 28px !important;
}
.carousel-control {
position: relative;
float: left;
width: 100%;
clear: both;
display: flex;
align-items: center;
justify-content: flex-start;
}
.carousel-control .carousel-control-prev,
.carousel-control .carousel-control-next {
position: initial;
width: auto;
color: #666666;
font-size: 36px;
line-height: 28px;
opacity: 1;
}
.carousel-control .carousel-control-prev:hover,
.carousel-control .carousel-control-next:hover {
color: #204dcc;
}
/*---- TEAM ----*/
#team {
margin: 75px 0;
padding: 150px 0 0;
background-image: url(../images/home/bg_service.png);
background-position: top center;
background-size: contain;
background-repeat: no-repeat;
background-color: var(--allbg);
}
.carousel-container .owl-stage-outer {
width: calc(100% + 30px);
}
.carousel-container .owl-dots .owl-dot {
display: inline-block;
margin: 0 7.5px !important;
padding: 5px !important;
border: 1px solid #204dcc;
border-radius: 50%;
background-color: #ffffff;
}
.carousel-container .owl-dots .owl-dot span {
margin: 0;
background: #ffffff;
}
.carousel-container .owl-dots .owl-dot.active span {
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
}
.team-card.card {
position: relative;
border: 0;
border-radius: 0;
background-color: transparent;
}
.team-card.card .fig-container {
position: relative;
width: 100%;
height: 100%;
-webkit-overflow-scrolling: hidden;
-ms-overflow-style: none;
overflow: hidden;
}
.team-card.card .fig-container img {
max-width: 100%;
}
.carousel-container .owl-carousel .owl-item img {
display: initial;
width: auto;
max-width: 100%;
}
.team-card .card-social {
position: absolute;
top: 30px;
right: 60px;
display: flex;
flex-direction: column;
flex-wrap: wrap;
align-items: flex-end;
justify-content: flex-end;
-webkit-transform: scale(1, 0);
-moz-transform: scale(1, 0);
-ms-transform: scale(1, 0);
-o-transform: scale(1, 0);
transform: scale(1, 0);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.social-icon {
margin-bottom: 10px;
display: inline-flex;
align-items: center;
justify-content: center;
width: 30px;
height: 30px;
color: #204dcc;
font-size: 16px;
border: 0;
border-radius: 4px;
background-color: #ffffff;
}
.social-icon:last-child {
margin-bottom: 0;
}
.team-card .overlay-bg {
position: relative;
width: calc(100% - 30px);
padding: 0;
text-align: center;
border: 0;
border-radius: 0;
background-color: #ffffff;
box-shadow: 0 8px 20px 4px rgba(0, 0, 0, 0.15);
-webkit-transform: translate(30px, -50%);
-moz-transform: translate(30px, -50%);
-ms-transform: translate(30px, -50%);
-o-transform: translate(30px, -50%);
transform: translate(30px, -50%);
z-index: 0;
}
.team-card .overlay-bg::after {
content: '';
position: absolute;
top: 0;
left: 0;
width: 0;
height: 100%;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
-webkit-transition: width 0.5s ease-in-out;
-moz-transition: width 0.5s ease-in-out;
-ms-transition: width 0.5s ease-in-out;
-o-transition: width 0.5s ease-in-out;
transition: width 0.5s ease-in-out;
z-index: 1;
}
.team-card .card-body {
position: relative;
padding: 35px 0;
background-color: transparent;
z-index: 2;
}
.team-card .card-body .card-title {
margin-bottom: 10px !important;
color: #232323;
font-size: 25px;
font-weight: 600;
line-height: 1 !important;
}
.team-card .card-body .card-text {
color: #232323;
font-size: 16px;
font-weight: 600;
}
.team-card:hover .card-social {
-webkit-transform: scale(1, 1);
-moz-transform: scale(1, 1);
-ms-transform: scale(1, 1);
-o-transform: scale(1, 1);
transform: scale(1, 1);
height: auto;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.team-card:hover .overlay-bg::after {
width: 100%;
-webkit-transition: width 0.35s ease-in-out;
-moz-transition: width 0.35s ease-in-out;
-ms-transition: width 0.35s ease-in-out;
-o-transition: width 0.35s ease-in-out;
transition: width 0.35s ease-in-out;
}
.team-card:hover .card-body .card-title,
.team-card:hover .card-body .card-text {
color: #ffffff;
}
/*---- WEBSCORE ----*/
#webscore {
margin: 75px 0;
padding-top: 253px;
background-color: var(--allbg);
}
.webscore-wrapper {
position: relative;
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/home/score_home.jpg');
background-position: left bottom;
background-size: 100% 412px;
background-repeat: no-repeat;
background-color: #ffffff;
}
.webscore-container {
display: flex;
}
.webscore-form {
padding: 85px 50px;
border: 0;
border-top-left-radius: 100px;
border-bottom-right-radius: 100px;
background-color: #f87863;
-webkit-transform: translate(15%, -75%);
-moz-transform: translate(15%, -75%);
-ms-transform: translate(15%, -75%);
-o-transform: translate(15%, -75%);
transform: translate(15%, -75%);
box-shadow: 10px 10px 0 0 #ffffff;
}
.webscore-form .h2 {
margin-bottom: 40px !important;
color: #ffffff;
}
.webscore-form form .form-group:first-child .form-control {
border-right: 0;
border-top-right-radius: 0;
border-bottom-right-radius: 0;
}
.webscore-form form .form-group:nth-child(2) .form-control {
border-right: 0;
border-radius: 0;
}
.webscore-form .form-control {
height: 55px;
padding: 14.5px 15px;
border: 1px solid #dfdfdf;
border-radius: 4px;
outline: 0;
box-shadow: none;
}
.webscore-form .form-control:focus {
box-shadow: none;
}
.webscore-form .btn {
height: 55px;
padding: 14px 30px;
font-size: 18px;
font-weight: 600;
font-family: 'Poppins', sans-serif;

border-top-left-radius: 0;
border-bottom-left-radius: 0;
}
.webscore-form input::-webkit-input-placeholder {
color: #232323 !important;
font-size: 18px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0;
opacity: 1;
}
.webscore-form input:-moz-placeholder {
color: #232323 !important;
font-size: 18px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0;
opacity: 1;
}
.webscore-form input::-moz-placeholder {
color: #232323 !important;
font-size: 18px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0;
opacity: 1;
}
.webscore-form input:-ms-input-placeholder {
color: #232323 !important;
font-size: 18px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0;
opacity: 1;
}
/*---- BLOG ----*/
#blog {
margin: 75px 0;
background-color: var(--allbg);
}
.card-blog.card {
border: 0;
border-radius: 4px;
background-color: #ffffff;
box-shadow: var(--allshadow);
}
.card-blog .fig-container {
position: relative;
}
.card-blog .fig-container img {
border-top-right-radius: 4px;
border-top-left-radius: 4px;
width: 100%;
}
.card-blog .published-date {
position: absolute;
right: 25px;
bottom: 0;
width: 55px;
height: 55px;
display: flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
border: 0;
border-top-left-radius: 15px;
border-bottom-right-radius: 15px;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
-webkit-transform: translate(0%, 50%);
-moz-transform: translate(0%, 50%);
-ms-transform: translate(0%, 50%);
-o-transform: translate(0%, 50%);
transform: translate(0%, 50%);
}
.card-blog .published-date span {
color: #ffffff;
font-size: 16px;
font-weight: 600;
font-family: 'Poppins', sans-serif;
letter-spacing: normal;
line-height: 1.2;
}
.card-blog .card-body {
padding: 30px 25px;
background-color: #ffffff;
}
.card-blog .card-body .card-text {
color: #666666;
font-size: 18px;
font-weight: 500;
font-family: 'Poppins', sans-serif;

}
.card-blog .card-body .card-title {
margin: 15px 0 !important;
color: var(--h1h6);
font-size: 24px;
font-weight: 600;
letter-spacing: normal;
line-height: 1;
}
/*---- WORK-WITH ----*/
#work-with {
margin: 75px 0;
background-color: var(--allbg);
}
.workwith {
display: flex;
flex-flow: row wrap;
align-items: center;
justify-content: space-between;
}
.workwith img {
max-width: 120px;
}
/*---- FOOTER ----*/
#footer {
position: relative;
margin: 275px 0 0;
padding: 75px 0 0;
background: linear-gradient(180deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
}
.footer-shape {
position: absolute;
top: 0;
left: 0;
width: 100%;
-webkit-transform: translate(0%, -90%) rotateY(-180deg);
-moz-transform: translate(0%, -90%) rotateY(-180deg);
-ms-transform: translate(0%, -90%) rotateY(-180deg);
-o-transform: translate(0%, -90%) rotateY(-180deg);
transform: translate(0%, -90%) rotateY(-180deg);
}
.footer-shape .shape-fill {
fill: var(--bggrdleft2);
}
.footer-address li i {
color: var(--wcolor);
font-size: 24px;
}
.footer-address li span {
color: var(--wcolor);
font-size: 18px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: normal;
}
.footer-address .media .media-icon i {
color: var(--wcolor);
font-size: 48px;
}
.footer-address .media .media-text {
color: var(--wcolor);
font-size: 18px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: normal;
}
.subscribe-form {
position: relative;
}
.subscribe-form .form-control {
display: block;
max-height: 50px;
padding: 16px 20px;
color: #666666;
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: 0.5px;
line-height: 16px;
border: 0;
border-radius: 5px;
background-color: #ffffff;
box-shadow: none !important;
}
.subscribe-form .btn {
position: absolute;
top: 0;
right: 0;
padding: 13.5px 24px;
max-height: 50px;
border: 0;
border-top-left-radius: 0;
border-bottom-left-radius: 0;
}
.footer-brand img {
max-width: 200px;
}
.footer-brand p {
margin: 40px 0 !important;
color: #ffffff;
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: 28px;
}
.footer-social .social-icon {
margin-right: 15px;
}
.footer-links h5 {
padding-top: 17px !important;
color: #ffffff;
font-size: 20px;
font-weight: 800;
letter-spacing: 0.5px !important;
line-height: 1 !important;
}
.footer-links .nav-link {
padding: 0;
color: #ffffff;
font-size: 16px;
font-size: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: 28px;
}
.copy-rights {
margin-top: 150px;
padding: 30px 0;
background: var(--copyrights);
text-align: center;
}
.copy-rights p {
color: #ffffff;
font-size: 14px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: normal;
}
.copy-rights p a,
.copy-rights p a:hover,
.copy-rights p a:focus {
color: #ffffff;
font-size: 14px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: normal;
}
/*--------------------------------------------------------------------
PAGE STYLES - LOGIN & SIGN UP
----------------------------------------------------------------------*/
#page-banner.login-signup-page {
background-position: center center;
background-size: cover;
}
#login-signup {
margin: 150px 0;
background-color: var(--allbg);
}
.login-info-wrapper,
.contact-info-wrapper {
position: relative;
min-height: 450px;
padding: 60px 40px;
border: 0;
border-top-left-radius: 50px;
border-top-right-radius: 10px;
border-bottom-left-radius: 10px;
border-bottom-right-radius: 50px;
background-color: #ffffff;
box-shadow: var(--shadowblack);
z-index: 0;
}
.login-info-wrapper ul {
list-style: initial !important;
}
.form-content .form-control {
padding: 0 0 10px;
border: 0;
border-bottom: 1px solid #204dcc;
border-radius: 0;
outline: 0;
}
.form-content .form-control:focus {
box-shadow: none;
}
.btn-forgetpass,
.btn-forgetpass:hover,
.btn-signup,
.btn-signup:hover,
.btn-back,
.btn-back:hover {
color: #666666;
font-size: 15px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
}
.regain {
display: none;
}
/*--------------------------------------------------------------------
PAGE STYLES - HOME PAGE 02
----------------------------------------------------------------------*/
/*---- HERO-BANNER ----*/
#hero-banner.theme-2 {
/*! height: calc(100vh - 139px); */

/*background-position: top left;
background-size: 50% 100%;
background-repeat: no-repeat;*/
background-color: #ebf5f3;
}
#hero-banner.theme-2::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 50%;
height: 100%;
background-image: linear-gradient(90deg, rgba(51, 50, 50, 0.5) 100%, rgba(51, 50, 50, 0) 100%), url('../images/home02/home_bg.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
background-color: #ebf5f3;
}
#hero-banner.theme-2 .hero-content {
display: flex;
flex-flow: column wrap;
align-items: flex-start;
justify-content: center;
}
#hero-banner.theme-2 .hero-content .h1 {
color: var(--h1h6w);
}
#hero-banner.theme-2 .hero-content .p {
color: var(--wcolor);
}
.hero-form {
padding: 150px 0 150px 85px;
display: flex;
flex-flow: row wrap;
align-items: center;
justify-content: flex-start;
}
.hero-form .form-content {
padding: 40px 30px;
border: 0;
border-top-left-radius: 30px;
border-top-right-radius: 6px;
border-bottom-left-radius: 6px;
border-bottom-right-radius: 30px;
background-color: #ffffff;
box-shadow: var(--allshadow);
}
.form-block {
position: relative;
float: left;
width: 100%;
clear: both;
}
.form-block .form-icon {
position: absolute;
top: 0;
left: 0;
width: 50px;
height: 50px;
display: flex;
align-items: center;
justify-content: center;
border: 0;
border-top-left-radius: 6px;
border-bottom-left-radius: 6px;
background-color: #ffffff;
box-shadow: 0px 2px 30.4px 1.6px rgba(234, 233, 233, 1);
}
.form-block .textarea-icon {
border-bottom-left-radius: 0;
}
.form-block .form-control {
max-height: 50px;
padding: 13px 20px;
border: 0;
border-radius: 6px;
background-color: #f3f7fd;
}
.form-block .form-control:focus {
box-shadow: none;
}
.form-block textarea.form-control {
max-height: 210px;
}
/*---- FEATURE ----*/
#feature.theme-2 {
margin-top: 150px;
margin-bottom: 75px;
padding-top: 0;
background-color: var(--allbg);
}
/*---- COUNTER-SERVICE ----*/
#counter-service {
margin: 75px 0;
padding-top: 150px;
background: linear-gradient(90deg, var(--bggrdleft2) 0%, var(--bggrdright2));
background-size: 100% 70%;
background-position: top left;
background-repeat: no-repeat;
}
#counter-service .counter-wrap {
border: 0;
border-radius: 0;
background: initial;
}
/*---- SHOWCASE ----*/
#showcase {
margin-top: 75px;
margin-bottom: 45px;
background-color: var(--allbg);
}
.controls {
margin: 0 0 50px;
padding: 0;
text-align: center;
background-color: transparent;
}
.controls .control {
margin-right: 15px;
padding: 5px 10px;
color: #204dcc;
font-size: 18px;
font-weight: 400;
font-family: 'Poppins', sans-serif;
letter-spacing: normal;
line-height: normal;
border: 0;
border-radius: 4px;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.mixitup-control-active,
.controls .control:hover {
color: #ffffff !important;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%) !important;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.controls .control:last-child {
margin-right: 0;
}
.showcase {
position: relative;
padding: 0;
-webkit-column-count: 3;
-moz-column-count: 3;
column-count: 3;
-webkit-column-gap: 30px;
-moz-column-gap: 30px;
column-gap: 30px;
}
.showcase .mix::before,
.showcase .mix::after {
display: none;
}
.showcase .mix {
margin-bottom: 0;
border: 0;
border-radius: 0;
}
.mix {
display: inline-block;
vertical-align: top;
width: 100%;
background: #fff;
border-top: 0;
border-radius: 0;
margin-bottom: 0;
position: relative;
backface-visibility: hidden;
will-change: transform, opacity;
}
@media screen and (min-width: 349px) {
.showcase {
-webkit-column-count: 1;
-moz-column-count: 1;
column-count: 1;
}
}
@media screen and (min-width: 576px) {
.showcase {
-webkit-column-count: 2;
-moz-column-count: 2;
column-count: 2;
}
}
@media screen and (min-width: 768px) {
.showcase {
-webkit-column-count: 2;
-moz-column-count: 2;
column-count: 2;
}
}
@media screen and (min-width: 1200px) {
.showcase {
-webkit-column-count: 3;
-moz-column-count: 3;
column-count: 3;
}
}
/*---- PRICING ----*/
.theme-2 .priceplan-wrapper {
position: relative;
}
.theme-2 .priceplan-wrapper::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
opacity: 0;
transform: initial;
border: 0;
border-radius: 0;
-webkit-transition: opacity 0.35s ease-in-out;
-moz-transition: opacity 0.35s ease-in-out;
-ms-transition: opacity 0.35s ease-in-out;
-o-transition: opacity 0.35s ease-in-out;
transition: opacity 0.35s ease-in-out;
}
.theme-2 .price-plan {
z-index: 1;
}
.theme-2 .priceplan-wrapper:hover::before {
opacity: 1;
-webkit-transition: opacity 0.35s ease-in-out;
-moz-transition: opacity 0.35s ease-in-out;
-ms-transition: opacity 0.35s ease-in-out;
-o-transition: opacity 0.35s ease-in-out;
transition: opacity 0.35s ease-in-out;
}
.theme-2 .priceplan-wrapper:hover .price-plan {
background-color: transparent;
}
.theme-2 .price-plan:hover .h1,
.theme-2 .price-plan:hover .h5,
.theme-2 .price-plan:hover .h6,
.theme-2 .price-plan:hover p {
color: #ffffff;
}
.theme-2 .price-plan:hover .btn-priceplan:hover {
color: #204dcc !important;
}
.theme-2 .price-plan:hover .btn-priceplan:after {
background: #f3f7fd !important;
}
.theme-2 .basic > .h5,
.theme-2 .advance > .h5,
.theme-2 .platinum > .h5 {
text-align: center;
}
.circular-price {
position: relative;
margin-bottom: 40px;
padding: 15px;
width: 182px;
height: 182px;
display: inline-flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
border: 1px solid #dfdfdf;
border-radius: 50%;
background-color: rgba(255, 255, 255, 0);
z-index: 1;
}
.circular-price::before {
content: '';
position: absolute;
top: 50%;
left: -85px;
width: 84px;
border-bottom: 1px solid #dfdfdf;
}
.circular-price::after {
content: '';
position: absolute;
top: 50%;
right: -85px;
width: 84px;
border-bottom: 1px solid #dfdfdf;
}
.basic > .circular-price > .h1,
.advance > .circular-price > .h1,
.platinum > .circular-price > .h1 {
color: #af61f5;
font-size: 36px;
font-weight: 600;
line-height: 2 !important;
}
.advance > .circular-price > .h1 {
color: #79d8e5;
}
.platinum > .circular-price > .h1 {
color: #f87863;
}
.basic > .circular-price > .h6,
.advance > .circular-price > .h6,
.platinum > .circular-price > .h6 {
color: #666666;
font-size: 14px;
font-weight: 500;
line-height: 1 !important;
}
.theme-2 .price-plan .btn-container {
text-align: center;
}
.theme-2 .basic::after,
.theme-2 .advance::after,
.theme-2 .platinum::after {
display: none;
}
/*---- FOOTER ----*/
#footer.theme-2 {
margin-top: 75px;
}
/*--------------------------------------------------------------------
PAGE STYLES - ABOUT PAGE
----------------------------------------------------------------------*/
#page-banner {
position: relative;
margin-bottom: 75px;
background-repeat: no-repeat;
background-color: #ffffff;
}
.aboutus-page::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 499px;
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/about/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
background-color: #ffffff;
}
.page-content {
position: relative;
float: left;
width: 100%;
clear: both;
}
.page-header {
position: relative;
padding: 100px 0;
display: flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
text-align: center;
}
.page-header .h2 {
color: var(--h1h6w);
}
.page-header .breadcrumb {
padding: 0 !important;
background-color: transparent;
}
.breadcrumb-item + .breadcrumb-item::before {
display: inline-block;
padding-right: .5rem;
padding-left: .5rem;
color: #fff;
content: "\ea7b";
font-family: IcoFont;
}
.page-header .breadcrumb a {
color: #ffffff;
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
}
.counter-wrap-2 {
position: relative;
float: left;
width: calc(100% - 20px);
padding: 100px 0;
border: 0;
border-top-left-radius: 100px;
border-bottom-right-radius: 100px;
background: initial;
background-color: #f87863;
box-shadow: 20px 20px 0 0px #4752d7;
}
/*--------------------------------------------------------------------
PAGE STYLES - TEAM PAGE
----------------------------------------------------------------------*/
#page-banner.team-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
#team.sec-bg {
padding: 150px 0 120px !important;
}
#work {
margin: 45px 0 75px;
background-color: var(--allbg);
}
.card-number {
display: flex;
align-items: center;
justify-content: center;
}
.card-number p {
width: 83px;
height: 83px;
display: inline-flex;
align-items: center;
justify-content: center;
color: #333;
font-size: 30px;
font-weight: 700;
font-family: 'Poppins', sans-serif;
letter-spacing: normal;
line-height: normal;
border: 0;
border-radius: 6px;
background-color: #ccc;
}
.branding-1 {
color: #af61f5 !important;
background-color: #f9e6ff !important;
}
.branding-2 {
color: #5ecfdf !important;
background-color: #dff7f9 !important;
}
.branding-3 {
color: #fdc2b8 !important;
background-color: #ffe6e2 !important;
}
.branding-4 {
color: #56ffa4 !important;
background-color: #e1ffef !important;
}
#work .card-wrapping .card-block:nth-of-type(even) {
margin-top: 50px;
}
/*--------------------------------------------------------------------
PAGE STYLES - SERVICE PAGE 01
----------------------------------------------------------------------*/
#page-banner.services-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
#services.theme-2 {
margin: 75px 0 45px;
padding: 0;
background-image: initial !important;
background-color: var(--allbg);
}
#all-services {
margin: 75px 0;
padding: 150px 0 120px;
background-color: #f3f7fd;
}
.service-media {
padding: 30px 30px;
border: 0;
border-radius: 10px;
background-color: #ffffff;
box-shadow: var(--allshadow);
}
.number-icon {
width: 45px;
height: 45px;
display: inline-flex;
align-items: center;
justify-content: center;
color: #ffffff;
font-size: 14px;
font-weight: 500;
font-family: 'Poppins', sans-serif;
border: 0;
border-radius: 4px;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2));
}
/*--------------------------------------------------------------------
PAGE STYLES - SERVICE PAGE 02
----------------------------------------------------------------------*/
#page-banner.servicessmm-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
.service-media .h6 {
line-height: 1 !important;
}
.service-media p {
line-height: 1.5;
}
/*--------------------------------------------------------------------
PAGE STYLES - SERVICE PAGE 03
----------------------------------------------------------------------*/
#page-banner.servicesseo-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
.list-ul {
position: relative;
margin: 0;
padding: 0;
list-style: none;
list-style-position: inside;
}
.list-ul .list-li {
position: relative;
margin-bottom: 10px;
}
.list-ul .list-li:last-child {
margin-bottom: 0;
}
.list-ul .list-li::before {
content: "\2022";
padding-right: 8px;
color: #2f59cf;
}
.list-ul .list-li p,
.list-ul .list-li .p {
display: inline-block;
}
.list-ul .list-li-img {
position: relative;
margin-bottom: 20px;
}
.list-ul .list-li-img:last-child {
margin-bottom: 0;
}
.list-ul .list-li-img p,
.list-ul .list-li-img .p {
display: inline-block;
padding-left: 8px;
}
/*--------------------------------------------------------------------
PAGE STYLES - SERVICE PAGE 04
----------------------------------------------------------------------*/
#page-banner.servicesppc-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
/*--------------------------------------------------------------------
PAGE STYLES - CASESTUDY PAGE
----------------------------------------------------------------------*/
#page-banner.casestudy-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
#casestudy {
margin: 75px 0 45px;
background-color: var(--allbg);
}
.gallery {
-webkit-column-count: 3;
-moz-column-count: 3;
column-count: 3;
-webkit-column-gap: 30px;
-moz-column-gap: 30px;
column-gap: 30px;
-webkit-column-width: auto;
-moz-column-width: auto;
column-width: auto;
}
.gallery .gallery-item img {
width: 100%;
}
/*--------------------------------------------------------------------
PAGE STYLES - PRICING PAGE
----------------------------------------------------------------------*/
#page-banner.pricing-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
/*--------------------------------------------------------------------
PAGE STYLES - BLOG ALL PAGES
----------------------------------------------------------------------*/
#page-banner.blog-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
.blog-sidebar {
position: relative;
background-color: var(--allbg);
}
.post-search {
padding: 15px 20px;
color: var(--allcolor);
font-size: 16px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
border: 1px solid #dfdfdf;
border-radius: 4px;
background-color: #ffffff;
}
.author-card.card {
padding: 50px 40px;
border: 0;
border-radius: 6px;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
}
.author-card .fig-container img {
border: 10px solid #ffffff;
border-radius: 50%;
}
.author-card .card-title {
color: #ffffff;
font-size: 24px;
font-weight: 700;
}
.author-card .card-text {
color: #ffffff;
font-size: 16px;
}
.author-card .card-social .social-icon {
margin-right: 10px;
margin-bottom: 0;
}
.author-card .card-social .social-icon:last-child {
margin-right: 0;
}
.badge-ul {
position: relative;
}
.badge-ul .li-badge {
margin-bottom: 15px;
display: flex;
align-items: center;
justify-content: space-between;
}
.badge-ul .li-badge:last-child {
margin-bottom: 0;
}
.badge-ul .li-badge .badge {
color: #666666;
font-size: 14px;
font-weight: 400;
padding: 10px 12px;
border: 0;
border-radius: 0;
border-top-right-radius: 4px;
border-bottom-left-radius: 4px;
background-color: #f1f1f1;
}
.popular-post .media {
margin-bottom: 30px;
}
.popular-post .media:last-child {
margin-bottom: 0;
}
.popular-post .media .media-body {
overflow: hidden;
}
.popular-post .media .h6 {
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}
.popular-post-img{
max-width: 80px !important;
max-height: 60px !important;
}
.list-archive li {
margin-bottom: 15px;
}
.list-archive li:last-child {
margin-bottom: 0;
}
.list-archive li a {
color: #666666;
}
.list-archive .list-li::before {
content: '\eaca';
color: #666666;
font-family: IcoFont;
}
.post-gallery > div {
margin-bottom: 17px;
}
.post-gallery > div:last-child {
margin-bottom: 0;
}
.post-gallery > div > a {
flex: 0 0 calc(((100%)/3) - 10px);
margin-bottom: 15px;
}
.post-gallery > div > a > img {
width: 100%;
}
.tag-link {
display: inline-block;
margin: 0 10px 10px 0;
padding: 10px 14px;
float: left;
color: #666666;
font-size: 14px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: normal;
border: 0;
border-radius: 0;
border-top-right-radius: 6px;
border-bottom-left-radius: 6px;
background-color: #f1f1f1;
}
#pagination {
margin-top: 120px;
display: flex;
align-items: center;
justify-content: center;
}
.page-item {
margin-left: 10px;
}
.page-item:first-child {
margin-left: 0;
}
.page-link i {
color: #666666;
font-weight: 700;
}
.page-link,
.page-link:hover,
.page-link:focus {
padding: 7.5px 15px;
color: #666666;
font-size: 18px;
font-weight: 700;
font-family: 'Nunito', sans-serif;
margin-left: initial !important;
border: 1px solid #dfdfdf;
border-radius: 0 4px 0 4px !important;
background-color: transparent;
}
.page-item.active .page-link {
color: #ffffff;
border: 0;
background: linear-gradient(109deg, var(--bggrdleft2) 0%, var(--bggrdright2) 100%);
}
.blog-single-container {
padding: 0 95px;
}
.blog-comments {
color: #666666;
}
.btn-reply,
.btn-reply:hover,
.btn-reply:focus {
color: #204dcc;
font-size: 14px;
font-weight: 400;
font-family: 'Nunito', sans-serif;
letter-spacing: normal;
line-height: normal;
}
.reply {
display: none;
}
/*--------------------------------------------------------------------
PAGE STYLES - CONTACT
----------------------------------------------------------------------*/
#page-banner.contact-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
#contact {
margin: 150px 0;
background-color: var(--allbg);
}
#map {
bottom: -75px;
}
#map::after {
content: '';
display: block;
clear: both;
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(32, 77, 204, 0.12);
}
/*--------------------------------------------------------------------
PAGE STYLES - FAQ
----------------------------------------------------------------------*/
#faq {
margin: 75px 0;
}
.faq-card .card-header {
border: 0;
border-radius: 4px;
background-color: #ffffff;
}
.faq-card .card-header button {
position: relative;
display: inline-block;
width: 100%;
text-align: left;
}
.faq-card .card-header button::after {
content: '\eab8';
font-family: IcoFont;
position: absolute;
top: 50%;
right: 12px;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
transform: translateY(-50%);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.faq-card .card-header button.rotate-icon::after {
-webkit-transform: translateY(-50%) rotate(90deg);
-moz-transform: translateY(-50%) rotate(90deg);
-ms-transform: translateY(-50%) rotate(90deg);
-o-transform: translateY(-50%) rotate(90deg);
transform: translateY(-50%) rotate(90deg);
-webkit-transition: transform 0.35s ease-in-out;
-moz-transition: transform 0.35s ease-in-out;
-ms-transition: transform 0.35s ease-in-out;
-o-transition: transform 0.35s ease-in-out;
transition: transform 0.35s ease-in-out;
}
.faq-card .card-body {
border-top: 1px solid #dfdfdf;
}
/*--------------------------------------------------------------------
PAGE STYLES - POLICY
----------------------------------------------------------------------*/
#policy {
margin: 75px 0;
background-color: var(--allbg);
}
.policy-list li {
margin-bottom: 15px;
}
.policy-list li:last-child {
margin-bottom: 0;
}
/*--------------------------------------------------------------------
PAGE STYLES - ERROR
----------------------------------------------------------------------*/
#page-banner.error-page {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/banner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
}
#error {
margin:75px 0;
background-color: var(--allbg);
}
.error-heading {
position: relative;
padding: 100px 40px;
border: 0;
border-top-left-radius: 50px;
border-top-right-radius: 10px;
border-bottom-left-radius: 10px;
border-bottom-right-radius: 50px;
background-color: #ffffff;
box-shadow: var(--shadowblack);
}
.error-heading .h1 {
position: relative;
font-size: 150px;
line-height: 1 !important;
text-align: center;
background: linear-gradient(180deg, var(--bggrdleft2) 0%, var(--bggrdright2));
-webkit-background-clip: text;
-moz-background-clip: text;
-ms-background-clip: text;
-o-background-clip: text;
-webkit-text-fill-color: transparent;
-moz-text-fill-color: transparent;
-ms-text-fill-color: transparent;
-o-text-fill-color: transparent;
background-clip: text;
}
.error-content {
max-width: 490px;
text-align: center;
}
.error-content .h2 {
color: var(--subheading);
}
/*--------------------------------------------------------------------
RESPONSIVE - FOR ALL SCREENS
----------------------------------------------------------------------*/
@media (max-width: 1199px) {
/*------ NAVBAR  ------*/
.shape-rectangle,
.shape-circle {
display: none !important;
}
#smmnavbar .nav-link {
padding: 0 12px;
text-align: right;
}
#smmnavbar .nav-registration {
margin-left: initial !important;
}
#smmnavbar .nav-registration .nav-link,
#smmnavbar .nav-registration .nav-link:hover,
#smmnavbar .nav-registration .active.nav-link {
padding: 11px 10px !important;
color: #232323;
background: initial !important;
}
/*------ HERO THEME 2  ------*/
#hero-banner.theme-2::before {
width: 100%;
background-position: center;
background-size: cover;
}
#hero-banner.theme-2 .hero-content {
padding-top: 80px;
align-items: center;
text-align: center;
}
#hero-banner.theme-2 .hero-form {
padding: 80px 0;
justify-content: center;
}
#hero-banner.theme-2 .hero-form .form-content {
-webkit-box-shadow: 0 1px 66.5px 3.5px rgba(0, 0, 0, 0.5);
box-shadow: 0 1px 66.5px 3.5px rgba(0, 0, 0, 0.5);
}
/*------ ABOUT US, VISION, TESTIMONIAL  ------*/
#about-us .text-wrapper,
#vision .text-wrapper {
padding-top: 60px;
padding-left: 0 !important;
text-align: center;
}
#vision.theme-2 .text-wrapper {
padding-right: 0 !important;
padding-bottom: 60px;
}
#about-us .text-block,
#vision .text-block,
#testimonial .text-block {
padding-left: 0;
}
.heading-left > .sub-heading {
top: 65%;
left: 50%;
-webkit-transform: translate(-50%, -65%);
-ms-transform: translate(-50%, -65%);
-moz-transform: translate(-50%, -65%);
-o-transform: translate(-50%, -65%);
transform: translate(-50%, -65%);
}
#testimonial .row .col-xl-6:first-child {
order: 2;
}
#testimonial .circle-layout {
height: 459px;
max-height: 459px;
}
#testimonial .text-wrapper {
padding-left: 0 !important;
padding-bottom: 100px;
text-align: center;
}
#testimonial .carousel-control {
justify-content: center;
}
#vision.theme-2 .progress-container {
margin: 80px 0;
justify-content: space-around !important;
}
/*------ LOGIN-SIGNUP ------*/
#login-signup .ls-list {
padding-bottom: 100px;
justify-content: center !important;
}
#login-signup .ls-form {
padding-left: 0 !important;
align-items: center !important;
text-align: center;
}
#login-signup .ls-form .ls-align {
justify-content: center !important;
}
}
@media (max-width: 991px) {
/*------ THEME 1 - HERO ------*/
.hero-fig {
position: relative;
width: 100%;
height: 100%;
max-width: 100%;
max-height: 100%;
display: flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
text-align: center;
}
.hero-fig > img {
clip-path: initial;
}
.hero-fig-overlay {
clip-path: initial;
}
.hero-fig-img {
top: initial;
left: initial;
}

.hero-content {
text-align: center;
}
/*------ FEATURE, SERVICES, HOW-IT-WORKS ------*/
#feature .row .col-lg-4,
.feature-theme-2 .col-lg-4,
#services .row .col-lg-4 {
margin-bottom: 60px;
}
#feature .row .col-lg-4:last-child,
#services .row .col-lg-4:last-child {
margin-bottom: 0;
}
.how-it-works .content-wrapper {
flex: 0 0 calc(((100%)/1) - 0px);
margin-bottom: 80px;
}
.how-it-works .content-wrapper::after {
top: auto;
bottom: -53.5px;
left: 50%;
transform: translate(-50%, 0) rotate(90deg);
}
/*------ BANNER-WRAP ------*/
#banner-wrap .content {
text-align: center;
align-items: center;
}
#banner-wrap .img-container {
margin-top: 80px;
justify-content: center;
}
#banner-wrap .img-container::before {
top: 50%;
right: initial;
left: 50%;
height: calc(100% + 30px);
max-width: 415px;
transform: translate(-50%, -50%);
}
/*------ PRICING ------*/
#pricing .row .col-lg-4 {
margin-bottom: 60px;
}
#pricing .row .col-lg-4:last-child {
margin-bottom: 0;
}
.basic,
.platinum {
margin-top: 0;
}
.basic > .h5,
.advance > .h5,
.platinum > .h5 {
text-align: center;
}
.price-plan .btn-container {
text-align: center;
}
#pricing-infos .text-wrapper {
padding-bottom: 60px;
text-align: center;
}
#pricing-infos .row .col-lg-6 .pheading {
text-align: center;
}
/*------ WEBSCORE ------*/
#webscore {
padding-top: 0;
}
.webscore-wrapper {
height: initial;
text-align: center;
background-position: center center;
background-size: cover;
}
.webscore-container {
padding: 60px 15px;
justify-content: center;
}
.webscore-form {
padding: initial;
border: initial;
border-top-left-radius: initial;
border-bottom-right-radius: initial;
background-color: transparent;
-webkit-transform: initial;
-moz-transform: initial;
-ms-transform: initial;
-o-transform: initial;
transform: initial;
box-shadow: initial;
}
/*------ BLOG ------*/
#blog .row .col-lg-4 {
margin-bottom: 60px;
}
#blog .row .col-lg-4:last-child {
margin-bottom: 0;
}
.card-blog .card-body {
text-align: center;
}
.card-blog .card-body .blog-comments {
justify-content: center;
}
#blog .blog-sidebar {
margin-top: 140px;
}
/*------ WORK-WITH ------*/
.workwith {
justify-content: center;
}
.workwith img {
margin: 0 15px 30px;
}
.workwith img:last-child {
margin-right: 0;
}
/*------ FOOTER ------*/
.footer-shape {
-webkit-transform: translate(0%, -85%) rotateY(-180deg);
-moz-transform: translate(0%, -85%) rotateY(-180deg);
-ms-transform: translate(0%, -85%) rotateY(-180deg);
-o-transform: translate(0%, -85%) rotateY(-180deg);
transform: translate(0%, -85%) rotateY(-180deg);
}
#footer .footer-address {
margin-bottom: 60px;
text-align: center;
}
#footer .footer-address .media {
align-items: flex-end;
justify-content: center;
}
#footer .footer-address .media .media-body {
flex: 0 0 auto;
}
#footer .responsive-footer .col-lg-3:nth-child(2) .footer-links {
text-align: right;
}
#footer .responsive-footer .col-lg-3:nth-child(4) .footer-links {
text-align: right;
}
/*------ ABOUT PAGE ------*/
.aboutus-page::before {
background-image: linear-gradient(180deg, rgba(32, 77, 204, 0.8) 50%, rgba(32, 77, 204, 0.8) 50%), url('../images/about/banner-md.jpg');
}
/*------ CONTACT ------*/
#contact .form-wrapper {
padding-top: 100px;
padding-left: 0 !important;
align-items: center !important;
}
#contact .form-content {
text-align: center;
}
/*------  THEME 2 COUNTER-SERVICE  ------*/
#counter-service .row .col-lg-4 {
margin-bottom: 60px;
}
#counter-service .row .col-lg-4:last-child {
margin-bottom: 0;
}

}
@media (max-width: 767px) {
.heading {
font-size: 90px;
}
.sub-heading {
font-size: 15px;
}
/*------ FEATURED-WORK ------*/
#featured-work .row .col-md-4:nth-child(4) .thumbnail,
#featured-work .row .col-md-4:nth-child(5) .thumbnail,
#featured-work .row .col-md-4:nth-child(6) .thumbnail {
margin-bottom: 30px;
}
/*------ COUNTER ------*/
#counter .counting {
margin: 20px 0;
}
/*------ WEBSCORE ------*/
#webscore .responsive-form.form-inline {
flex-flow: column wrap;
-webkit-box-align: flex-start;
-ms-flex-align: flex-start;
align-items: flex-start;
}
#webscore .responsive-form.form-inline .form-group {
flex: 1 0 100%;
max-width: 100%;
width: 100%;
}
#webscore .responsive-form.form-inline .form-group .form-control {
display: block;
width: 100%;
margin-bottom: 20px;
border-radius: 4px;
}
.webscore-form .btn {
width: 100%;
border-radius: 4px;
}
/*------ BLOG ------*/
.comment-form .row .col-md-6:first-child .post-search {
margin-bottom: 30px;
}
/*------ FOOTER ------*/
#footer .footer-brand,
#footer .footer-social,
#footer .footer-links {
text-align: center !important;
}
}
@media (max-width: 575px) {
/*------ FONTS ------*/
.p,
.text {
font-size: 13px;
}
.h1 {
font-size: 30px;
}
.h2 {
font-size: 26px;
}
.h3 {
font-size: 20px;
}
.h4 {
font-size: 17px;
}
.heading {
width: 100%;
font-size: 60.15px;
text-align: center;
}
.sub-heading {
font-size: 14px;
}
.slogan {
font-size: 25.26px;
text-align: center;
}
.card-type-1 > .card-body > .card-title {
font-size: 20px;
}
.card-type-1 > .card-body > .card-text {
font-size: 13px;
}
.card-blog .card-body .card-title {
font-size: 20px;
}
.footer-address li span {
font-size: 15px;
}
.footer-address .media .media-text {
font-size: 15px;
}
.footer-brand p {
font-size: 14px;
}
.footer-links h5 {
font-size: 18px;
}
.footer-links .nav-link {
font-size: 14px;
}
/*------ HERO ------*/
.hero-fig {
padding: 60px;
}
.hero-fig-img {
border: 15px solid #ffffff;
}
.hero-fig-img img {
width: 100%;
}
.hero-fig-img img{
max-width:375px !important;
}
/*------ BANNER-WRAP ------*/
#banner-wrap .img-container::before {
display: none;
}
#banner-wrap .img-container img {
width: 100%;
border: 8px solid #f87863;
}
/*------ TESTIMONIAL ------*/
.circle-indicators {
max-width: 260px;
max-height: 260px;
}
.circle-indicators li:first-child img {
max-width: 90px;
}
.circle-indicators li img {
max-width: 60px;
}
/*------ TEAM ------*/
.carousel-container .owl-carousel .owl-item img {
width: 100%;
}
.team-card .overlay-bg {
-webkit-transform: translate(15px, -50%);
-moz-transform: translate(15px, -50%);
-ms-transform: translate(15px, -50%);
-o-transform: translate(15px, -50%);
transform: translate(15px, -50%);
}
/*------ WORKWITH ------*/
.workwith {
flex-flow: column wrap;
}
.workwith img {
margin-right: 0;
}
/*------ FOOTER ------*/
.footer-shape {
-webkit-transform: translate(0%, -75%) rotateY(-180deg);
-moz-transform: translate(0%, -75%) rotateY(-180deg);
-ms-transform: translate(0%, -75%) rotateY(-180deg);
-o-transform: translate(0%, -75%) rotateY(-180deg);
transform: translate(0%, -75%) rotateY(-180deg);
}
#footer .footer-address .media {
flex-flow: column wrap;
align-items: center;
justify-content: center;
}
.footer-address .media .media-icon i {
font-size: 30px;
}
.subscribe-form .btn {
position: relative;
display: block;
width: 100%;
margin-top: 30px;
border-radius: 5px;
}
/*------ LOGIN-SIGNUP ------*/
#login-signup .wrapper::before,
#login-signup .wrapper::after {
display: none;
}
#login-signup .ls-list .wrapper {
padding: 10px;
}
#login-signup .ls-list .wrapper .login-info-wrapper {
padding: 30px 10px;
}
#login-signup .ls-list .wrapper .login-info-wrapper .h5 {
font-size: 18px;
text-align: center;
}
/*------ CONTACT ------*/
#contact .wrapper::before,
#contact .wrapper::after {
display: none;
}
#contact .contact-info-wrapper {
padding: 30px 15px;
}
#contact .contact-info-wrapper .h5,
#contact .contact-info-wrapper > .p {
text-align: center;
}
/*------ BLOG ------*/
.blog-sidebar > .h5 {
font-size: 20px;
text-align: center;
}
.from-this-author .h5 {
font-size: 20px;
}
.from-this-author .media {
flex-flow: column wrap;
}
.from-this-author .media img {
width: 100%
}
.from-this-author .media .media-body {
margin: 20px 0 0 !important;
text-align: center;
}
.related-post .h5,
.comments-wrapper .h5 {
font-size: 20px;
text-align: center;
}
.comments-wrapper .comment-form {
text-align: center;
}
/*------ ERROR ------*/
.error-heading {
padding: 70px 15px;
}
.error-heading .h1 {
font-size: 100px;
}
}

.w-30{
width: 30%;
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



.api-details .card-header {
padding: .75rem 1.25rem;
margin-bottom: 0;
background-color: #C1C7D0;
border-bottom: 1px solid #C1C7D0;
}

.api-details .content {
padding: 20px 20px;
color: #171717;
font-size: 14px;
}
.api-details h5 {
margin: 0;
padding: 20px 20px;
color: #fff;
font-size: 17px;
}
.api-details .content h6 {

margin-bottom: 2px;
font-size: 14px;
font-weight: 700;
line-height: 2.2 !important;
}
.api-details .content p {
font-weight: 500;
line-height: 1.5 !important;
color: #171717;
}

.api-code {
background: url(../../../../assets/images/dots.png) no-repeat 30px 30px #393838;
border-radius: 12px;
color: #fff;
position: relative;
padding: 60px 30px 30px;
margin-top: 40px;
}

#Notiflix-Icon-Success,
#Notiflix-Icon-Failure,
#Notiflix-Icon-Warning
{
fill: #fff !important;
}

.country_code{
background: #f4f4f4;
}

.service-list .card{
box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 20%);
-webkit-box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 20%);
-moz-box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 20%);
-o-box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 20%);
}

.btn-secondary,
.btn-secondary:not(:disabled):not(.disabled).active,
.btn-secondary:not(:disabled):not(.disabled):active,
.show>.btn-secondary.dropdown-toggle {
color: #fff;
background: #545b62 !important;
background-color: #545b62 !important;
border-color: #4e555b !important;
}

.btn-padding{
padding: 8px 15px !important;
}
.btn-group-sm>.btn, .btn-sm {
padding: .25rem .5rem !important;
line-height: 1.5;
border-radius: 1px;
}

@media screen and (max-width: 767px) {
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
background-color: #f8f8f8;
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
html[dir=rtl] #hero-banner .hero-fig {
right: initial;
left: 0;
transform: rotateY(180deg);
}
html[dir=rtl] #hero-banner .shape-rectangle {
left: initial;
right: -214px;
transform: rotate(90deg) rotate(45deg);

}
html[dir=rtl] .how-it-works .content-wrapper::after {
display: none;
}
html[dir=rtl] .how-it-works .content-wrapper::before {
content: '\ea93';
position: absolute;
font-family: IcoFont;
color: <?php echo $primaryColor;?>;
font-size: 45px;
top: 50%;
right: -62.5px;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
-ms-transform: translateY(-50%);
-o-transform: translateY(-50%);
transform: translateY(-50%);
}
html[dir=rtl] .how-it-works .content-wrapper:first-child::before {
display: none;
}
html[dir=rtl] .carousel-control .carousel-control-prev,
html[dir=rtl] .carousel-control .carousel-control-next {
transform: rotate(180deg);
}
html[dir=rtl] .subscribe-form .btn {
right: initial;
left: 0;
border-radius: 4px 0 0 4px;
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
background-color: #f2f2f2;
}

.user-service-list .card-body .table tr:nth-child(odd) {
background-color: #fff;
}

.user-service-list .card-body  table tbody tr {
border: none !important;
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

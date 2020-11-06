<!DOCTYPE html>
<html class=" ">


<!-- Mirrored from www.jaybabani.com/alix-html/app/ui-app-products-home.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Oct 2020 08:07:05 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>{{mb_strtoupper(session()->get('businessname'))}}</title>
    <meta content="{{session()->get('businessname')}}" name="description"/>


    <!-- App Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('appkit/assets/images/icons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('appkit/assets/images/icons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('appkit/assets/images/icons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('appkit/assets/images/icons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('appkit/assets/images/icons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('appkit/assets/images/icons/apple-icon-120x120')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('appkit/assets/images/icons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('appkit/assets/images/icons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('appkit/assets/images/icons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"
          href="{{asset('appkit/assets/images/icons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('appkit/assets/images/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('appkit/assets/images/icons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('appkit/assets/images/icons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('appkit/assets/images/icons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('appkit/assets/images/icons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">


    <!-- CORE CSS FRAMEWORK - START -->
    <link href="{{asset('appkit/assets/css/preloader.css')}}" type="text/css" rel="stylesheet"
          media="screen,projection"/>

    <link href="{{asset('appkit/modules/materialize/materialize.min.css')}}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{asset('appkit/modules/fonts/mdi/materialdesignicons.min.css')}}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{asset('appkit/modules/perfect-scrollbar/perfect-scrollbar.css')}}" type="text/css" rel="stylesheet"
          media="screen,projection"/>

    @toastr_css
    <!-- CORE CSS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{asset('appkit/modules/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css"
          media="screen"/>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- CORE CSS TEMPLATE - START -->


    <link href="{{asset('appkit/assets/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"
          id="main-style"/>
    <!-- CORE CSS TEMPLATE - END -->


</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="html" data-header="dark" data-footer="dark" data-header_align="center" data-menu_type="left"
      data-menu="dark" data-menu_icons="on" data-footer_type="left" data-site_mode="dark" data-footer_menu="show"
      data-footer_menu_style="dark" style="background-color: #263238;">

<div class="preloader-background">
    <div class="preloader-wrapper">
        <div id="preloader"></div>
    </div>
</div>


<!-- START navigation -->
@yield('topheader')
@include('frontend.layouts.sidebar')
@include('frontend.layouts.settings')


<div class="container">
    <div class="section">
        <div class="row center">
            <a class="btn-floating btn-large waves-effect waves-light primary center"><i class="mdi mdi-check"></i></a>
            <h1 class="white-text center welcome-logo">Payment Successful</h1>

            <div class="spacer"></div>
            <h6 class="welcome-tagline white-text center pad-30">Thank You for placing your order. We will notify you
                once your order is ready for shipment.</h6>
            <div style="height: 10vh" class="spacer"></div>

            <a href="{{route('home')}}" class='waves-effect waves-light btn-large'> Continue Shopping
            </a>
            <a href="{{route('user.order')}}" class='waves-effect waves-light btn-large'> View Order Details
            </a>
            <div class="spacer"></div>
            <div class="spacer"></div>
        </div>

    </div>
</div>
<footer class="page-footer center social-colored ">
    <div class="footer-copyright">
        <div class="container">
            &copy; Copyright <a class="" href="https://themeforest.net/user/themepassion/portfolio">ZeroTechnology</a>.
            All rights reserved.
        </div>
    </div>
</footer>

<!-- PWA Service Worker Code -->

<script type="text/javascript">
    // This is the "Offline copy of pages" service worker

    // Add this below content to your HTML page, or add the js file to your page at the very top to register service worker

    // Check compatibility for the browser we're running this in
    if ("serviceWorker" in navigator) {
        if (navigator.serviceWorker.controller) {
            console.log("[PWA Builder] active service worker found, no need to register");
        } else {
            // Register the service worker
            navigator.serviceWorker
                .register("appkit/pwabuilder-sw.js", {
                    scope: "./"
                })
                .then(function (reg) {
                    console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
                });
        }
    }
</script>
<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<!-- CORE JS FRAMEWORK - START -->
<script src="{{asset('appkit/modules/jquery/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('appkit/modules/materialize/materialize.js')}}"></script>
<script src="{{asset('appkit/modules/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('appkit/assets/js/variables.js')}}"></script>
<!-- CORE JS FRAMEWORK - END -->


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
<script src="{{asset('appkit/modules/fancybox/jquery.fancybox.min.js')}}" type="text/javascript"></script>


<!-- CORE TEMPLATE JS - START -->
<script src="{{asset('appkit/modules/app/init.js')}}"></script>
<script src="{{asset('appkit/modules/app/settings.js')}}"></script>

<script src="{{asset('appkit/modules/app/scripts.js')}}"></script>
@toastr_js
@toastr_render
<!-- END CORE TEMPLATE JS - END -->
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        $('.preloader-background').delay(10).fadeOut('slow');
    });

</script>
@yield('script')
</body>


<!-- Mirrored from www.jaybabani.com/alix-html/app/ui-app-products-home.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Oct 2020 08:07:14 GMT -->
</html>

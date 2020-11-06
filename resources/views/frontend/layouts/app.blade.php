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

<body class="html" data-header="light" data-footer="dark" data-header_align="center" data-menu_type="left"
      data-menu="light" data-menu_icons="on" data-footer_type="left" data-site_mode="light" data-footer_menu="show"
      data-footer_menu_style="light">
<div class="preloader-background">
    <div class="preloader-wrapper">
        <div id="preloader"></div>
    </div>
</div>


<!-- START navigation -->
@yield('topheader')
@include('frontend.layouts.sidebar')
@include('frontend.layouts.settings')



@yield('content')




<div class="spacer"></div>


<footer class="page-footer center social-colored ">
    <div class="container footer-content">
        <div class="row">
            <div class="">
                <h5 class="logo">{{mb_strtoupper(session()->get('businessname'))}}</h5>
                <p class="text">{{session()->get('address')}}</p>
            </div>
            <div class="link-wrap">

                <ul class="social-wrap">
                    <li class="social">
                        <a class="" href="{{session()->get('fb')}}"><i class="mdi mdi-facebook"></i></a>
                        <a class="" href="{{session()->get('youtube')}}"><i class="mdi mdi-youtube-creator-studio"></i></a>
                        <a class="" href="{{session()->get('whatsapp')}}"><i class="mdi mdi-whatsapp"></i></a>
                        <a class="" href="{{session()->get('insta')}}"><i class="mdi mdi-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            &copy; Copyright <a class="" href="https://themeforest.net/user/themepassion/portfolio">ZeroTechnology</a>.
            All rights reserved.
        </div>
    </div>
</footer>


<div class="backtotop">
    <a class="btn-floating btn primary-bg">
        <i class="mdi mdi-chevron-up"></i>
    </a>
</div>


<div class="footer-menu circular">
    <ul>

    @if(!\Illuminate\Support\Facades\Auth::guard('web')->check())
    <li>
            <a href="{{route('user.login')}}"> <i class="mdi mdi-account"></i>
                <span>Login</span>
            </a></li>
            @else
            <li>
            <a href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <i class="mdi mdi-logout"></i>
                <span>Logout</span>
            </a></li>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

     @endif
        <li>
            <a href="{{route('user.order')}}"> <i class="mdi mdi-briefcase-check"></i>
                <span>Order</span>
            </a></li>
        <li>
            <a href="{{route('home')}}"> <i class="mdi mdi-home-outline"></i>
                <span>Home</span>
            </a></li>
        <li>
            <a href="{{route('user.cart')}}"> <i class="mdi mdi-basket"></i>
                <span>Cart</span>
            </a></li>
        <li>
            <a href="{{route('user.contact')}}"> <i class="mdi mdi-cellphone-sound"></i>
                <span>Contact Us</span>
            </a></li>

    </ul>
</div>


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
<script type="text/javaScript">
    $("[data-fancybox=images]").fancybox({
        buttons: [
            "slideShow",
            "share",
            "zoom",
            "fullScreen",
            "close",
            "thumbs"
        ],
        thumbs: {
            autoStart: false
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $(".carousel-fullscreen.carousel-slider").carousel({
            fullWidth: true,
            indicators: true
        });
        setTimeout(autoplay, 3500);

        function autoplay() {
            $(".carousel").carousel("next");
            setTimeout(autoplay, 3500);
        }

        $(".slider8").slider({
            indicators: false,
            height: 210,
        });

    });
</script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


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

    function changeCategory(id, value) {
        $(".dropdown-trigger").text(value);
        var url = '{{ route("user.category", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: 'GET',  // http method
            beforeSend: function () {
                $('.preloader-background').show();
            },
            success: function (data, status, xhr) {
                $(".divproduct").html(data);
                $('.preloader-background').fadeOut('slow');
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert(errorMessage);
                $('.preloader-background').fadeOut('slow');

            }
        });
    }

    $(".addtocart").on('click', function () {
        var name = $(this).data('name');
        var price = $(this).data('price');
        var itemid = $(this).data('itemid');
        var _token = "{{csrf_token()}}";
        var qty = $(this).data('qty');
        var image = $(this).data('image');

        $.ajax({
            url: '{{route('frontend.addtocart')}}',
            method: 'POST',
            data: {
                name: name, price: price
                , qty: qty, itemid: itemid, _token: _token, image: image
            },
            beforeSend: function () {
                $('.preloader-background').show();
            },
            success: function (response) {
                if (response.error) {
                    M.toast({html: response.Message});
                    $('.preloader-background').fadeOut('slow');
                } else {
                    M.toast({html: response.Message, classes: ' red lighten-2 white-text'});
                    $('.preloader-background').fadeOut('slow');

                }
            }, error: function (xhr) {
                M.toast({html: xhr.statusText, classes: ' red lighten-2 white-text'});
                $('.preloader-background').fadeOut('slow');

            }
        });
    });

</script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

@yield('script')
</body>


<!-- Mirrored from www.jaybabani.com/alix-html/app/ui-app-products-home.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Oct 2020 08:07:14 GMT -->
</html>

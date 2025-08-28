<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png"
        href="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/favicon.png') }}" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/css/styles-v5.css') }}" />

    <title>@yield('title')</title>
    <!-- Owl Carousel  -->
    <link rel="stylesheet"
        href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />

    @stack('style')
    <style>
        /* create auto scroll horizontal if text or table to long */
        .dataTables_wrapper {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            padding-bottom: 20px;
        }
    </style>
    @if (env('APP_ENV') == 'production')
        <script src="https://www.gstatic.com/firebasejs/5.1.0/firebase.js"></script>
        <script>
            var firebaseConfig = {
                apiKey: "{{ env('FIREBASE_API_KEY') }}",
                authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
                projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
                storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
                messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
                appId: "{{ env('FIREBASE_APP_ID') }}",
                databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}",
            };
            firebase.initializeApp(firebaseConfig);
            var auth = firebase.auth();

            var dr = firebase.database().ref('/dataAduan');
            var aduanValue = dr.child('keyAduan');
            var aduanStatus = dr.child('statusAduan');
        </script>
    @endif
</head>

<body>
    @stack('toast')

    @include('components.preloader')

    <div id="main-wrapper">

        @include('components.sidebar')

        <div class="page-wrapper">

            @include('components.top_bar')

            @include('components.horizontalbar')

            <div class="body-wrapper">

                @yield('content')

            </div>

            <button
                class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <i class="icon ti ti-settings fs-7"></i>
            </button>

            @include('components.setting_theme')

        </div>

        @include('components.search_bar')
        @include('components.shopping_cart')

    </div>

    <div class="dark-transparent sidebartoggler"></div>

    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/vendor.min.js') }}"></script>

    <!-- Import Js Files -->
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/theme.js') }}"></script>
    {{-- <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.init.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.min.js') }}"></script> --}}

    {{-- use the sidebar menu below this script call --}}
    {{-- <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/sidebarmenu.js') }}"></script> --}}

    {{-- use this for sidebarmenu active or not --}}
    <script>
        $(function() {
            "use strict";
            var url = window.location + "";

            var path = url.replace(
                window.location.protocol + "//" + window.location.host + "/",
                ""
            );

            // get only two slash and plus 'index'
            var theonly2path = path.split("/").slice(0, 2).join("/");

            // get the website base url
            var urlwiththeonly2path = window.location.protocol + "//" + window.location.host + "/" + theonly2path;

            var element = $("ul#sidebarnav a").filter(function() {
                return this.href === url || this.href === path || this.href === urlwiththeonly2path;
            });

            element.parentsUntil(".sidebar-nav").each(function(index) {
                if ($(this).is("li") && $(this).children("a").length !== 0) {
                    $(this).children("a").addClass("active");
                    $(this).parent("ul#sidebarnav").length === 0 ?
                        $(this).addClass("active") :
                        $(this).addClass("selected");
                } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
                    $(this).addClass("selected");
                } else if ($(this).is("ul")) {
                    $(this).addClass("in");
                }
            });

            element.addClass("active");
            $("#sidebarnav a").on("click", function(e) {
                if (!$(this).hasClass("active")) {
                    // hide any open menus and remove all other classes
                    $("ul", $(this).parents("ul:first")).removeClass("in");
                    $("a", $(this).parents("ul:first")).removeClass("active");

                    // open our new menu and add the open class
                    $(this).next("ul").addClass("in");
                    $(this).addClass("active");
                } else if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                    $(this).parents("ul:first").removeClass("active");
                    $(this).next("ul").removeClass("in");
                }
            });
            $("#sidebarnav >li >a.has-arrow").on("click", function(e) {
                e.preventDefault();
            });
        });
    </script>
    @include('script-layout')

    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/plugins/toastr-init.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @stack('script')
    @hasSection('idarajax')
        {{-- punya om idar ini bos --}}
        <script src="{{ asset('assets/js/ajax.js') }}"></script>
    @endif
</body>

</html>

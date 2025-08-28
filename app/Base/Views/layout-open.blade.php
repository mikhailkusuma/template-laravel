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
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/css/styles.css') }}" />

    <title>@yield('title')</title>
    <!-- Owl Carousel  -->
    <link rel="stylesheet"
        href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />

    @stack('style')
</head>

<body>
    <div id="main-wrapper" class="my-4">

        @yield('content')

    </div>

    <div class="dark-transparent sidebartoggler"></div>

    <!-- Import Js Files -->
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/app.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/app.init.js') }}"></script>

    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/simplebar/dist/simplebar.min.js') }}"></script>

    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme.js') }}"></script>

    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/plugins/toastr-init.js') }}"></script>
    @stack('script')

</body>

</html>

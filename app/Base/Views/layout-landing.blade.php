<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png"
        href="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/favicon.png') }}" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/css/styles-landing.css') }}" />

    <title>@yield('title')</title>
    <!-- Owl Carousel  -->
    <link rel="stylesheet"
        href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />

    @stack('style')
    <style>
        :root {
            --bs-wadul-bg-subtle: #fce1eb;
            --bs-wadul-rgb: 255, 0, 92;
            --bs-wadul: #ff005c;
        }

        .bg-wadul {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-wadul-rgb), var(--bs-bg-opacity)) !important;
        }

        .bg-wadul-subtle {
            background-color: var(--bs-wadul-bg-subtle) !important;
        }

        .text-wadul {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-wadul-rgb), var(--bs-text-opacity)) !important;
        }

        .btn.bg-wadul-subtle:hover {
            background-color: var(--bs-wadul) !important;
            color: var(--bs-white) !important;
        }
    </style>
</head>

<body>
    @stack('toast')

    @include('components.preloader')
    {{-- @yield('content') --}}

    <!-- ------------------------------------- -->
    <!-- Top Bar Start -->
    <!-- ------------------------------------- -->
    <div class="topbar-image bg-primary py-1 rounded-0 mb-0 alert alert-dismissible fade show" role="alert">
        <div
            class="d-flex justify-content-center gap-sm-3 gap-2 align-items-center text-center flex-md-nowrap flex-wrap">
            <span class="badge bg-white bg-opacity-10 fs-2 fw-bolder px-2">New</span>
            <p class="mb-0 text-white fw-bold">Frontend Pages Included!</p>
        </div>
        <button type="button" class="btn-close btn-close-white p-2 fs-2" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <!-- ------------------------------------- -->
    <!-- Top Bar End -->
    <!-- ------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- Header Start -->
    <!-- ------------------------------------- -->
    <header class="header-fp p-0 w-100 d-none">
        <nav class="navbar navbar-expand-lg bg-primary-subtle py-2 py-lg-10">
            <div class="custom-container d-flex align-items-center justify-content-between">
                <a href="javascript:void(0);" class="text-nowrap logo-img">
                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                        class="dark-logo" alt="Logo-Dark" />
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ms-auto">
                        <a href="https://wa.me/6281131111108" target="_blank"
                            class="btn bg-wadul-subtle text-wadul py-8 px-9 rounded-pill">Contact</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- ------------------------------------- -->
    <!-- Header End -->
    <!-- ------------------------------------- -->

    <div class="main-wrapper overflow-hidden">
        <!-- ------------------------------------- -->
        <!-- banner Start -->
        <!-- ------------------------------------- -->
        <Section class="bg-white pt-7 py-7">
            <div class="custom-container">
                <div class="row justify-content-center pt-lg-5 mb-4">
                    <div class="col-lg-8 text-center">
                        <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember-dark.png') }}"
                            alt="Logo Wadul Gus e" class="mx-auto" width="500px">
                        {{-- <h1 class="text-link-color fw-bolder text-center fs-13 mb-0 pt-lg-2">
                            Most powerful & <span class="text-primary">developer friendly</span> dashboard
                        </h1> --}}
                        <p class="text-muted fs-5 mb-0 fw-bold mt-3">
                            Semua dengan cinta, wujudkan Jember Baru & Jember Maju.
                        </p>
                    </div>
                </div>
            </div>
        </Section>
        <!-- ------------------------------------- -->
        <!-- banner End -->
        <!-- ------------------------------------- -->

    </div>

    <!-- Scroll Top -->
    <a href="javascript:void(0)"
        class="top-btn btn btn-primary d-flex align-items-center justify-content-center round-54 p-0 rounded-circle">
        <i class="ti ti-arrow-up fs-7"></i>
    </a>

    <!-- Import Js Files -->
    {{-- <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/jquery/dist/jquery.min.js') }}"></script> --}}
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/vendor-landing.min.js') }}"></script>

    <!-- Import Js Files -->
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.init.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/theme.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.min.js') }}"></script>

    {{-- use the sidebar menu below this script call --}}

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/landingpage/homepage.js') }}"></script>

    @stack('script')
</body>

</html>

<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="horizontal">

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
        <!--  Sidebar End -->
        <div class="page-wrapper">
            <!--  Header Start -->
            <header class="topbar">
                <div class="with-horizontal">
                    <nav class="navbar navbar-expand-xl container-fluid p-0" style="max-width: none !important;">
                        <ul class="navbar-nav">
                            <li class="nav-item d-block d-xl-none">
                                <a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse" href="javascript:void(0)">
                                    <i class="ti ti-menu-2"></i>
                                </a>
                            </li>
                            <li class="nav-item d-none d-xl-block">
                                <a href="#" class="text-nowrap nav-link">
                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember.png') }}"
                                        width="50" alt="" />
                                </a>
                            </li>
                            <li class="nav-item d-none d-xl-block">
                                <a href="#" class="text-nowrap nav-link">
                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                                        class="dark-logo" width="180" alt="" />
                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/light_logo_text_wadul-guse.png') }}"
                                        class="light-logo" width="180" alt="" />
                                </a>
                            </li>

                        </ul>
                        <ul class="navbar-nav quick-links d-none d-xl-flex">
                            <li class="nav-item dropdown-hover d-none d-lg-block">
                                @if (Auth::guard('web')->check() && Auth::guard('web')->user())
                                    @if (Auth::guard('web')->user()->hasRole(['Data Entry']))
                                        <a class="nav-link" href="{{ route('report.queue_reports.waitlist') }}">Aduan
                                            Masyarakat</a>
                                    @else
                                        <a class="nav-link" href="{{ route('report.reports.waitlist') }}">Aduan
                                            Masyarakat</a>
                                    @endif
                                @elseif (Auth::guard('disposition')->check())
                                    <a class="nav-link" href="{{ route('dispositions.report.reports.waitlist') }}">
                                        Aduan Masyarakat
                                    </a>
                                @endif
                            </li>
                        </ul>
                        <div class="d-block d-xl-none">
                            <a href="#" class="text-nowrap logo-img">
                                <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                                    class="dark-logo" alt="Logo-Dark" width="180px" />
                                <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/light_logo_text_wadul-guse.png') }}"
                                    class="light-logo" alt="Logo-light" width="180px" />
                            </a>
                        </div>
                        <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)"
                            data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="p-2">
                                <i class="ti ti-dots fs-7"></i>
                            </span>
                        </a>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                                <a href="javascript:void(0)"
                                    class="nav-link round-40 p-1 ps-0 d-flex d-xl-none align-items-center justify-content-center"
                                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                    aria-controls="offcanvasWithBothOptions">
                                    <i class="ti ti-align-justified fs-7"></i>
                                </a>
                                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                    <!-- ------------------------------- -->
                                    <!-- start language Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item">
                                        <a class="nav-link moon dark-layout moon-dark-layout" href="javascript:void(0)"
                                            onclick="changeTheme('dark')">
                                            <iconify-icon icon="solar:moon-line-duotone"
                                                class="moon fs-7"></iconify-icon>
                                        </a>
                                        <a class="nav-link sun light-layout sun-light-layout" href="javascript:void(0)"
                                            onclick="changeTheme('light')">
                                            <iconify-icon icon="solar:sun-2-line-duotone"
                                                class="sun fs-7"></iconify-icon>
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="user-profile-img">
                                                    @if (Auth::guard('web')->check())
                                                        <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/fawait.png') }}"
                                                            class="rounded-circle" width="35" height="35"
                                                            alt="" />
                                                    @elseif (Auth::guard('disposition')->check())
                                                        <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/profile/user-1.jpg') }}"
                                                            class="rounded-circle" width="35" height="35"
                                                            alt="" />
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                            aria-labelledby="drop1">
                                            <div class="profile-dropdown position-relative" data-simplebar>
                                                <div class="py-3 px-7 pb-0">
                                                    <h5 class="mb-0 fs-5 fw-semibold">Profil Pengguna</h5>
                                                </div>
                                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                    @if (Auth::guard('web')->check())
                                                        <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/fawait.png') }}"
                                                            class="rounded-circle" width="80" height="80"
                                                            alt="" />
                                                    @elseif (Auth::guard('disposition')->check())
                                                        <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/profile/user-1.jpg') }}"
                                                            class="rounded-circle" width="80" height="80"
                                                            alt="" />
                                                    @endif
                                                    <div class="ms-3">
                                                        @if (Auth::guard('web')->check())
                                                            <h5 class="mb-1 fs-3">
                                                                {{ Auth::guard('web')->user()->name }}</h5>
                                                            {{-- <span class="mb-1 d-block">{{ ucfirst(current_logged_guard_name()) }}</span> --}}
                                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                                <i class="ti ti-mail fs-4"></i>
                                                                {{ Auth::guard('web')->user()->email }}
                                                            </p>
                                                        @elseif (Auth::guard('disposition')->check())
                                                            <h5 class="mb-1 fs-3">
                                                                {{ Auth::guard('disposition')->user()->name }}</h5>
                                                            {{-- <span class="mb-1 d-block">{{ ucfirst(current_logged_guard_name()) }}</span> --}}
                                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                                <i class="ti ti-mail fs-4"></i>
                                                                {{ Auth::guard('disposition')->user()->email }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="d-grid py-4 px-7 pt-8">
                                                    @if (Auth::guard('web')->check())
                                                        <a href="{{ route('autentikasi.logout') }}"
                                                            class="btn btn-outline-primary">Log Out</a>
                                                    @elseif (Auth::guard('disposition')->check())
                                                        <a href="{{ route('autentikasi.logout') }}"
                                                            class="btn btn-outline-primary">Log Out</a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <!-- ------------------------------- -->
                                    <!-- end profile Dropdown -->
                                    <!-- ------------------------------- -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="with-vertical">
                    <nav class="navbar navbar-expand-xl container-fluid p-0">
                        <ul class="navbar-nav">
                            <li class="nav-item d-block d-xl-none">
                                <a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse"
                                    href="javascript:void(0)">
                                    <i class="ti ti-menu-2"></i>
                                </a>
                            </li>
                            <li class="nav-item d-none d-xl-block">
                                <a href="#" class="text-nowrap nav-link">
                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                                        class="dark-logo" width="180" alt="" />
                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/light_logo_text_wadul-guse.png') }}"
                                        class="light-logo" width="180" alt="" />
                                </a>
                            </li>

                        </ul>
                        <ul class="navbar-nav quick-links d-none d-xl-flex">
                            <li class="nav-item dropdown-hover d-none d-lg-block">
                                @if (Auth::guard('web')->check() && Auth::guard('web')->user())
                                    @if (Auth::guard('web')->user()->hasRole(['Data Entry']))
                                        <a class="nav-link" href="{{ route('report.queue_reports.waitlist') }}">Aduan
                                            Masyarakat</a>
                                    @else
                                        <a class="nav-link" href="{{ route('report.reports.waitlist') }}">Aduan
                                            Masyarakat</a>
                                    @endif
                                @endif
                            </li>
                        </ul>
                        <div class="d-block d-xl-none">
                            <a href="#" class="text-nowrap logo-img">
                                <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                                    class="dark-logo" alt="Logo-Dark" width="180px" />
                                <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/light_logo_text_wadul-guse.png') }}"
                                    class="light-logo" alt="Logo-light" width="180px" />
                            </a>
                        </div>
                        <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)"
                            data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="p-2">
                                <i class="ti ti-dots fs-7"></i>
                            </span>
                        </a>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                                <a href="javascript:void(0)"
                                    class="nav-link round-40 p-1 ps-0 d-flex d-xl-none align-items-center justify-content-center"
                                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                                    aria-controls="offcanvasWithBothOptions">
                                    <i class="ti ti-align-justified fs-7"></i>
                                </a>
                                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                    <!-- ------------------------------- -->
                                    <!-- start language Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item">
                                        <a class="nav-link moon dark-layout moon-dark-layout"
                                            href="javascript:void(0)" onclick="changeTheme('dark')">
                                            <iconify-icon icon="solar:moon-line-duotone"
                                                class="moon fs-7"></iconify-icon>
                                        </a>
                                        <a class="nav-link sun light-layout sun-light-layout"
                                            href="javascript:void(0)" onclick="changeTheme('light')">
                                            <iconify-icon icon="solar:sun-2-line-duotone"
                                                class="sun fs-7"></iconify-icon>
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="user-profile-img">
                                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember.png') }}"
                                                        class="rounded-circle" width="35" height="35"
                                                        alt="" />
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                            aria-labelledby="drop1">
                                            <div class="profile-dropdown position-relative" data-simplebar>
                                                <div class="py-3 px-7 pb-0">
                                                    <h5 class="mb-0 fs-5 fw-semibold">Profil Pengguna</h5>
                                                </div>
                                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember.png') }}"
                                                        class="rounded-circle" width="80" height="80"
                                                        alt="" />
                                                    <div class="ms-3">
                                                        @if (Auth::guard('web')->check())
                                                            <h5 class="mb-1 fs-3">
                                                                {{ Auth::guard('web')->user()->name }}</h5>
                                                            {{-- <span class="mb-1 d-block">{{ ucfirst(current_logged_guard_name()) }}</span> --}}
                                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                                <i class="ti ti-mail fs-4"></i>
                                                                {{ Auth::guard('web')->user()->email }}
                                                            </p>
                                                        @elseif (Auth::guard('disposition')->check())
                                                            <h5 class="mb-1 fs-3">
                                                                {{ Auth::guard('disposition')->user()->name }}</h5>
                                                            {{-- <span class="mb-1 d-block">{{ ucfirst(current_logged_guard_name()) }}</span> --}}
                                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                                <i class="ti ti-mail fs-4"></i>
                                                                {{ Auth::guard('disposition')->user()->email }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="d-grid py-4 px-7 pt-8">
                                                    @if (Auth::guard('web')->check())
                                                        <a href="{{ route('autentikasi.logout') }}"
                                                            class="btn btn-outline-primary">Log Out</a>
                                                    @elseif (Auth::guard('disposition')->check())
                                                        <a href="{{ route('autentikasi.logout') }}"
                                                            class="btn btn-outline-primary">Log Out</a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <!-- ------------------------------- -->
                                    <!-- end profile Dropdown -->
                                    <!-- ------------------------------- -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            <!--  Header End -->

            <div class="body-wrapper my-0 py-0">

                @yield('content')

            </div>

            <script>
                function handleColorTheme(e) {
                    $("html").attr("data-color-theme", e);
                    $(e).prop("checked", !0);
                }
            </script>

            <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                        Settings
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body h-n80" data-simplebar>
                    <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="theme-layout" id="light-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="light-layout"><i
                                class="icon ti ti-brightness-up fs-7 me-2"></i>Light</label>

                        <input type="radio" class="btn-check" name="theme-layout" id="dark-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="dark-layout"><i
                                class="icon ti ti-moon fs-7 me-2"></i>Dark</label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="direction-l" id="ltr-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="ltr-layout"><i
                                class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR</label>

                        <input type="radio" class="btn-check" name="direction-l" id="rtl-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="rtl-layout"><i
                                class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL</label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

                    <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                        <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                            onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="BLUE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                            onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="AQUA_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                            onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="PURPLE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                            onclick="handleColorTheme('Green_Theme')" for="green-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                            onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="CYAN_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                            onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
                            <div
                                class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="vertical-layout"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="vertical-layout"><i
                                    class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="horizontal-layout"><i
                                    class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal</label>
                        </div>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="layout" id="boxed-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="boxed-layout"><i
                                class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed</label>

                        <input type="radio" class="btn-check" name="layout" id="full-layout"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="full-layout"><i
                                class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full</label>
                    </div>

                    <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <a href="javascript:void(0)" class="fullsidebar">
                            <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="full-sidebar"><i
                                    class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full</label>
                        </a>
                        <div>
                            <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                                autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="mini-sidebar"><i
                                    class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse</label>
                        </div>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="card-layout" id="card-with-border"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="card-with-border"><i
                                class="icon ti ti-border-outer fs-7 me-2"></i>Border</label>

                        <input type="radio" class="btn-check" name="card-layout" id="card-without-border"
                            autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="card-without-border"><i
                                class="icon ti ti-border-none fs-7 me-2"></i>Shadow</label>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->

    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/vendor.min.js') }}"></script>

    <!-- Import Js Files -->
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.horizontal.init.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/theme.js') }}"></script>
    {{-- <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.init.js') }}"></script> --}}
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.min.js') }}"></script>

    {{-- use the sidebar menu below this script call --}}
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/sidebarmenu.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    @stack('script')
</body>

</html>

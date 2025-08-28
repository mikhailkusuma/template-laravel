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

    <title>Login | Jember Satu Data</title>
    <style>
        [id^="cf-chl-widget"] {
            width: 100% !important;
        }

        @media only screen and (max-width: 575px) {
            .login-panel {
                padding: 40px;
            }
        }

        /* [data-bs-theme=light][data-color-theme=Blue_Theme]:root .btn-primary,
        [data-bs-theme=dark][data-color-theme=Blue_Theme]:root .btn-primary {
            --bs-btn-bg: #ff679a;
            --bs-btn-border-color: #ff679a;
            --bs-btn-hover-bg: #e13e7a;
            --bs-btn-hover-border-color: #e13e7a;
        } */
    </style>
</head>

<body>
    <div id="main-wrapper">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="#" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <div class="my-0">
                                {{-- <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember.png') }}"
                                    alt="Logo Pemkab Jember" width="45px" class="me-2"> --}}
                                <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember-dark.png') }}"
                                    alt="Logo Jember Satu Data" width="160px">
                            </div>
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center h-n80">
                            <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/backgrounds/login-security.svg') }}"
                                alt="" class="img-fluid" width="600">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-4">
                                <div class="my-3">
                                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember.png') }}"
                                        alt="Logo Wadul Gus e" width="40px">
                                    <b class="form-label ms-2">Jember Satu Data</b>
                                </div>
                                <h2 class="mb-1 fs-7 fw-bolder">Welcome to Satu Data</h2>
                                <form class="mt-4" action="{{ route('authentication.aksi_login') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="redirect_to"
                                        value="{{ request()->session()->get('url.intended', route('dashboard.index')) }}">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <h6>Terjadi kesalahan saat memproses data Anda.</h6>
                                            <ul class="mb-0 pb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="test@example.com" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="*******" required>
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 mb-4 rounded-2" type="submit"
                                        id="btn-submit">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function handleColorTheme(e) {
                $("html").attr("data-color-theme", e);
                $(e).prop("checked", !0);
            }
        </script>
    </div>

    <!-- Import Js Files -->
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.init.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/theme.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/app.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/theme/sidebarmenu.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/jquery/dist/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/iconify/iconify-icon.min.js') }}"></script> --}}

    {{-- <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script> --}}
    <script>
        // function _tCallback() {
        //     document.getElementById('btn-submit').disabled = false;
        // }
        document.getElementById('btn-submit').disabled = false;
    </script>
</body>

</html>

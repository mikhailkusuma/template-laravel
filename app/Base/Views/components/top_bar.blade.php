  <!--  Header Start -->
  <header class="topbar">
      <div class="with-vertical">
          <nav class="navbar navbar-expand-lg p-0">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse"
                          href="javascript:void(0)">
                          <i class="ti ti-menu-2"></i>
                      </a>
                  </li>
              </ul>

              <div class="d-block d-lg-none">
                  <a href="./main/index.html" class="text-nowrap logo-img">
                      <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                          class="dark-logo" alt="Logo-Dark" width="180px" />
                      <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/light_logo_text_wadul-guse.png') }}"
                          class="light-logo" alt="Logo-light" width="180px" />
                  </a>
              </div>
              <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
                  data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                  aria-label="Toggle navigation">
                  <span class="p-2">
                      <i class="ti ti-dots fs-7"></i>
                  </span>
              </a>
              <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                  <div class="d-flex align-items-center justify-content-between">
                      <a href="javascript:void(0)"
                          class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button"
                          data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
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
                                  <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"></iconify-icon>
                              </a>
                              <a class="nav-link sun light-layout sun-light-layout" href="javascript:void(0)"
                                  onclick="changeTheme('light')">
                                  <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"></iconify-icon>
                              </a>
                          </li>

                          <li class="nav-item dropdown">
                              <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                  <div class="d-flex align-items-center">
                                      <div class="user-profile-img">
                                          <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/profile/user-1.jpg') }}"
                                              class="rounded-circle" width="35" height="35" alt="" />
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
                                          <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/profile/user-1.jpg') }}"
                                              class="rounded-circle" width="80" height="80" alt="" />
                                          <div class="ms-3">
                                              @if (Auth::guard('web')->check())
                                                  <h5 class="mb-1 fs-3"> {{ Auth::guard('web')->user()->name }}</h5>
                                                  {{-- <span class="mb-1 d-block">{{ ucfirst(Auth::guard('web')->user()->name) }}</span> --}}
                                                  <p class="mb-0 d-flex align-items-center gap-2">
                                                      <i class="ti ti-mail fs-4"></i>
                                                      {{ Auth::guard('web')->user()->email }}
                                                  </p>
                                              @elseif (Auth::guard('disposition')->check())
                                                  <h5 class="mb-1 fs-3">{{ Auth::guard('disposition')->user()->name }}
                                                  </h5>
                                                  {{-- <span class="mb-1 d-block">{{ ucfirst(Auth::guard('disposition')->user()->name) }}</span> --}}
                                                  <p class="mb-0 d-flex align-items-center gap-2">
                                                      <i class="ti ti-mail fs-4"></i>
                                                      {{ Auth::guard('disposition')->user()->email }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>

                                      <div class="d-grid py-4 px-7 pt-8">
                                          @if (Auth::guard('web')->check())
                                              <a href="{{ route('authentication.logout') }}"
                                                  class="btn btn-outline-primary">Log Out</a>
                                          @elseif (Auth::guard('disposition')->check())
                                              <a href="{{ route('authentication.logout') }}"
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
          <!-- ---------------------------------- -->
          <!-- End Vertical Layout Header -->
          <!-- ---------------------------------- -->

          <!-- ------------------------------- -->
          <!-- apps Dropdown in Small screen -->
          <!-- ------------------------------- -->
          <!--  Mobilenavbar -->
          <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
              aria-labelledby="offcanvasWithBothOptionsLabel">
              <nav class="sidebar-nav scroll-sidebar">
                  <div class="offcanvas-header justify-content-between">
                      <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/favicon.png') }}" alt=""
                          class="img-fluid" />
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body h-n80" data-simplebar="" data-simplebar>
                      <ul id="sidebarnav">

                      </ul>
                  </div>
              </nav>
          </div>

      </div>
      <div class="app-header with-horizontal">
          <nav class="navbar navbar-expand-xl container-fluid p-0">
              <ul class="navbar-nav">
                  <li class="nav-item d-block d-xl-none">
                      <a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse" href="javascript:void(0)">
                          <i class="ti ti-menu-2"></i>
                      </a>
                  </li>
                  <li class="nav-item d-none d-xl-block">
                      <a href="./main/index.html" class="text-nowrap nav-link">
                          <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                              class="dark-logo" width="180" alt="" />
                          <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/light_logo_text_wadul-guse.png') }}"
                              class="light-logo" width="180" alt="" />
                      </a>
                  </li>

              </ul>
              <ul class="navbar-nav quick-links d-none d-xl-flex">

              </ul>
              <div class="d-block d-xl-none">
                  <a href="./main/index.html" class="text-nowrap nav-link">
                      <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/dark_logo_text_wadul-guse.png') }}"
                          width="180" alt="" />
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
                                  <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"></iconify-icon>
                              </a>
                              <a class="nav-link sun light-layout sun-light-layout" href="javascript:void(0)"
                                  onclick="changeTheme('light')">
                                  <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"></iconify-icon>
                              </a>
                          </li>

                          <li class="nav-item dropdown">
                              <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                  <div class="d-flex align-items-center">
                                      <div class="user-profile-img">
                                          <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/profile/user-1.jpg') }}"
                                              class="rounded-circle" width="35" height="35" alt="" />
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
                                          <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/profile/user-1.jpg') }}"
                                              class="rounded-circle" width="80" height="80" alt="" />
                                          <div class="ms-3">
                                              @if (Auth::guard('web')->check())
                                                  <h5 class="mb-1 fs-3"> {{ Auth::guard('web')->user()->name }}</h5>
                                                  {{-- <span class="mb-1 d-block">{{ ucfirst(Auth::guard('web')->user()->name) }}</span> --}}
                                                  <p class="mb-0 d-flex align-items-center gap-2">
                                                      <i class="ti ti-mail fs-4"></i>
                                                      {{ Auth::guard('web')->user()->email }}
                                                  </p>
                                              @elseif (Auth::guard('disposition')->check())
                                                  <h5 class="mb-1 fs-3">{{ Auth::guard('disposition')->user()->name }}
                                                  </h5>
                                                  {{-- <span class="mb-1 d-block">{{ ucfirst(Auth::guard('disposition')->user()->name) }}</span> --}}
                                                  <p class="mb-0 d-flex align-items-center gap-2">
                                                      <i class="ti ti-mail fs-4"></i>
                                                      {{ Auth::guard('disposition')->user()->email }}
                                                  </p>
                                              @endif
                                          </div>
                                      </div>

                                      <div class="d-grid py-4 px-7 pt-8">
                                          @if (Auth::guard('web')->check())
                                              <a href="{{ route('authentication.logout') }}"
                                                  class="btn btn-outline-primary">Log Out</a>
                                          @elseif (Auth::guard('disposition')->check())
                                              <a href="{{ route('authentication.logout') }}"
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

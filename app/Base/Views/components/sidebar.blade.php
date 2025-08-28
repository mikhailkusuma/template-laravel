<aside class="left-sidebar with-vertical">
    <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a class="text-nowrap logo-img">
                <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo-pemkab-jember-dark.png') }}"
                    class="dark-logo" width="160px" alt="Logo-Dark" />
                <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/logos/logo_jember_satu_data.png') }}"
                    class="light-logo" width="160px" alt="Logo-light" />
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            @if (Auth::guard('web')->check())
                <ul id="sidebarnav">
                    <!-- ---------------------------------- -->
                    <!-- Menu Utama -->
                    <!-- ---------------------------------- -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Menu Utama</span>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('dashboard.index') }}" class="sidebar-link text-wrap">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-home"></i>
                            </div>
                            <span class="hide-menu">Beranda</span>
                        </a>
                    </li>

                    {{-- @if (Auth::guard('web')->user()->hasRole(['Super Admin', 'Verifikator', 'Data Entry']))
                        <li class="sidebar-item">
                            <a href="{{ route('dashboard.data-reports') }}" class="sidebar-link text-wrap">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-list-details"></i>
                                </div>
                                <span class="hide-menu">Dashboard OPD</span>
                            </a>
                        </li>
                    @endif --}}

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">APPS</span>
                    </li>

                    {{-- @if (Auth::guard('web')->user()->hasRole(['Super Admin', 'Verifikator', 'Data Entry']))
                        <!-- Antrian -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="ti ti-stack-2"></i>
                                </span>
                                <span class="hide-menu">Antrian</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('report.queue_reports.add') }}" class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Buat Antrian</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.queue_reports.waitlist') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Antrian Menunggu</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.queue_reports.fake_list') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Antrian Hoax</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.queue_reports.real_list') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Antrian Diteruskan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::guard('web')->user()->hasRole(['Super Admin', 'Verifikator']))
                        <!-- Antrian -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="ti ti-file-pencil"></i>
                                </span>
                                <span class="hide-menu">Aduan Masyarakat</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.add') }}" class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Buat Aduan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.index') }}" class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Seluruh Aduan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.waitlist') }}" class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Aduan Menunggu</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.disposition_list') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Aduan Disposisi</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.followup_list') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Aduan Tindak Lanjut</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.complete_list_verification') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Verifikasi Aduan Selesai</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.complete_list') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Aduan Selesai</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.cancelled_list_verification') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Verifikasi Aduan Dibatalkan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('report.reports.cancelled_list') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Aduan Dibatalkan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::guard('web')->user()->hasRole(['Super Admin', 'Verifikator']))
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="ti ti-layout-grid"></i>
                                </span>
                                <span class="hide-menu">Master Data</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('master_data.report_categories.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Kategori Aduan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_data.report_type.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Type Aduan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_data.report_statuses.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Status Aduan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_data.report_sources.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Sumber Aduan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_data.government_agencies.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Daftar Instansi</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_data.pinpoints.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Pinpoint Lokasi</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif --}}

                    {{-- @if (Auth::guard('web')->user()->hasRole(['Super Admin', 'Verifikator']))
                    @endif --}}

                    @if (Auth::guard('web')->user()->hasRole(['Super Admin']))
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="ti ti-map"></i>
                                </span>
                                <span class="hide-menu">Master Lokasi</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('master_location.provinces.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Provinsi</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_location.cities.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Kabupaten</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_location.districts.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Kecamatan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('master_location.villages.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Kelurahan / Desa</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::guard('web')->user()->hasRole(['Super Admin']))
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">MANAJEMEN</span>
                        </li>
                    @endif

                    @if (Auth::guard('web')->user()->hasRole(['Super Admin']))
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="ti ti-friends"></i>
                                </span>
                                <span class="hide-menu">Manajemen Pengguna</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('management_user.users.index') }}" class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Pengguna</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('management_user.roles.index') }}" class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Roles</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('management_user.permissions.index') }}"
                                        class="sidebar-link text-wrap">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Permissions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
            @endif
            </ul>
        </nav>

        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="{{ asset(env('THEME_ASSETS_PATH') . '/images/profile/user-1.jpg') }}"
                        class="rounded-circle" width="40" height="40" alt="" />
                </div>
                <div class="john-title">
                    @if (Auth::guard('web')->check())
                        <h6 class="mb-0 fs-3 fw-semibold" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="{{ Auth::guard('web')->user()->name }}"
                            style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;width:100px;">
                            {{ Auth::guard('web')->user()->name }}
                        </h6>
                    @endif
                    {{-- <span class="fs-2">{{ ucfirst(current_logged_guard_name()) }}</span> --}}
                </div>
                @if (Auth::guard('web')->check())
                    <a class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button"
                        href="{{ route('authentication.logout') }}" aria-label="logout" data-bs-toggle="tooltip"
                        data-bs-placement="top" data-bs-title="logout">
                        <i class="ti ti-power fs-6"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
    </div>
</aside>

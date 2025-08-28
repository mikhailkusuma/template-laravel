<aside class="left-sidebar with-horizontal">
    <!-- Sidebar scroll-->
    <div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->

                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->
                {{-- @foreach (build_menu() as $menu)
                    <li class="sidebar-item @if (count($menu->module_group_menus) > 3) mega-dropdown @endif">
                        <a class="sidebar-link has-arrow @if (count($menu->module_group_menus) > 3 && count($menu->module_group_menus) <= 6) two-column @endif"
                            href="javascript:void(0)" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-grid"></i>
                            </span>
                            <span class="hide-menu">{{ $menu->Nama }}</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @foreach ($menu->module_group_menus as $submenu)
                                <li class="sidebar-item">
                                    <a href="{{ $submenu->RuteBaru != null ? route($submenu->RuteBaru) : '#' }}"
                                        class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">{{ $submenu->Nama }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach --}}
                {{-- <span class="hide-menu">{!! splitNameIntoLines($submenu->Nama) !!}</span> --}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->

</aside>

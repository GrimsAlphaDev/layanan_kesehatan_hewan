<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div class="brand-logo d-flex align-items-center justify-content-center">
        <h2 class="text-center">Welcome :)</h2>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
        </div>
    </div>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-simplebar>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="mb-0">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item @if (request()->is('patient')) active @endif">
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ route('dashboard') }}"
                        aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-1">
                            <i class="ti ti-layout-dashboard fs-7"></i>
                        </span>
                        <span class="hide-menu ps-1">Pelayanan Kesehatan</span>
                    </a>
                </li>
                
                <li class="sidebar-item @if (request()->is('patient')) active @endif">
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ route('rekam.medis') }}"
                        aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-1">
                            <i class="ti ti-file fs-7"></i>
                        </span>
                        <span class="hide-menu ps-1">Rekam Medis</span>
                    </a>
                </li>


            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->

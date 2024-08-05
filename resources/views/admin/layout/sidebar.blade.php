<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div class="brand-logo d-flex align-items-center justify-content-center">
        <h2 class="text-center">Admin Panel</h2>
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
                <li class="sidebar-item @if (request()->is('admin/dashboard')) active @endif">
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ route('admin.dashboard') }}"
                        aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-1">
                            <i class="ti ti-layout-dashboard fs-7"></i>
                        </span>
                        <span class="hide-menu ps-1">Kriteria Penyakit Menular</span>
                    </a>
                </li>
                <li class="sidebar-item" @if (request()->is('admin/promosi')) active @endif>
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ route('admin.promosi.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-1">
                            <i class="ti ti-heart-broken fs-7"></i>
                        </span>
                        <span class="hide-menu ps-1">Promosi Kesehatan Hewan</span>
                    </a>
                </li>
                <li class="sidebar-item" @if (request()->is('admin/faksin')) active @endif>
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ route('admin.faksin.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-1">
                            <i class="ti ti-shield fs-7"></i>
                        </span>
                        <span class="hide-menu ps-1">Management Faksin</span>
                    </a>
                </li>
                <li class="sidebar-item" @if (request()->is('admin/transaksi')) active @endif>
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ route('admin.transaksi.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-1">
                            <i class="ti ti-receipt fs-7"></i>
                        </span>
                        <span class="hide-menu ps-1">Transaksi Pembayaran</span>
                    </a>
                </li>
                <li class="sidebar-item" @if (request()->is('admin/laporan-rekaman-medis')) active @endif>
                    <a class="sidebar-link sidebar-link primary-hover-bg" href="{{ route('admin.laporan-rekaman-medis.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-1">
                            <i class="ti ti-files fs-7"></i>
                        </span>
                        <span class="hide-menu ps-1">Laporan Rekam Medis</span>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->

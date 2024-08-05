<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                    href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <h4 class="mt-2">Selamat Datang, {{ auth()->user()->name }}</h4>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-user" style="font-size: 30px"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                        aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ route('logout') }}" onclick="return confirm('Yakin akan logout?')"
                                class="btn btn-outline-primary mx-3 mt-2 d-block shadow-none">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
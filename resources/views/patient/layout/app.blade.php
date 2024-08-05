<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assetsAuth/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assetsAuth/css/styles.min.css') }}" />
    @yield('css')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('patient.layout.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <div class="container-fluid">
                <!--  Header Start -->
                @include('patient.layout.header')
                <!--  Header End -->

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div>
                        <div class="alert-message">
                            <strong>Oh snap!</strong> {{ $errors->first() }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>
                        <div class="alert-message">
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <!--  Content Start -->
                @yield('content')
                <!--  Content End -->
                
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> M Haikal ALfandi S. All rights reserved.
                    </p>
                </div>
            </div>
            <div class="dark-transparent sidebartoggler"></div>
        </div>
    </div>
    <script src="{{ asset('assetsAuth/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assetsAuth/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsAuth/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assetsAuth/js/app.min.js') }}"></script>
    <script src="{{ asset('assetsAuth/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assetsAuth/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assetsAuth/js/dashboard.js') }}"></script>
    @yield('js')
</body>

</html>

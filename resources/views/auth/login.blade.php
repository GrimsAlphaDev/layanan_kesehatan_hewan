<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assetsAuth/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assetsAuth/css/styles.min.css') }}" />
</head>

<body>
    <div class="page-wrapper p-0" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

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
        
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="card auth-card mb-0 mx-3">
                    <div class="card-body">
                        <h2 class="text-center">LOGIN</h2>
                        <p class="text-center"> Silahkan login untuk melanjutkan</p>
                        <form action="{{ route('signIn') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required name="email">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 fs-4 mb-4">Sign In</button>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Buat Akun
                                    Baru</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assetsAuth/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assetsAuth/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

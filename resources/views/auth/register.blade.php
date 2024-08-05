<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assetsAuth/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assetsAuth/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
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
                        <h2 class="text-center">REGISTER</h2>
                        <p class="text-center"> Silahkan daftar untuk melanjutkan</p>
                        <form action="{{ route('register.user') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="exampleInputtext1"
                                    aria-describedby="textHelp" required name="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required name="email">
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 fs-4 mb-4">Sign Up</button>
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

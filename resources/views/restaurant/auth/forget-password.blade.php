<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Restaurant - Forget Password</title>
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset("assets/web/images/index.jpg") }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset("assets/web/images/index.jpg") }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center vh-100 align-items-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Just Halaall!</h1>
                                </div>
                                <form class="user" action="{{ route('restaurants.newPassword') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                               id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="{{ old('email') }}"
                                               required autocomplete="email"
                                               placeholder="Enter Email Address...">
{{--                                        @error('email')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleInputPassword" aria-describedby="passwordHelp" name="password" value="{{ old('password') }}"
                                               required autocomplete="password" autofocus
                                               placeholder="Enter New Password...">
{{--                                        @error('password')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" id="InputPassword2" placeholder="Confirm Password" class="form-control form-control-user" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block border-0" style="background: #ff572a">
                                        Change
                                    </button>
                                </form>
                                <div class="mt-3 text-right">
                                    <a class="small" href="{{ route('restaurants.showRegistrationForm') }}">Sign Up?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('restaurants.login') }}">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>

</body>
</html>

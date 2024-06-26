<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Restaurant - Login</title>
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
                            <div class="p-4">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Just Halaall</h1>
                                </div>
                                <form class="user" action="{{ route('restaurants.register') }}" method="POST">
                                    @csrf

                                    <div class="row my-3">
                                        <div class="col-6">
                                            <div class="form-group">
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                               id="exampleInputName" aria-describedby="nameHelp" name="name" value="{{ old('name') }}"
                                               required autocomplete="name" autofocus
                                               placeholder="Enter Name...">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                               id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="{{ old('email') }}"
                                               required autocomplete="email"
                                               placeholder="Enter Email Address...">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" required id="latitude" placeholder="Latitude" class="form-control form-control-user" name="latitude" autocomplete="latitude">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" required id="longitude" placeholder="Longitude" class="form-control form-control-user" name="longitude" autocomplete="longitude">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="current-password"
                                               id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="password" id="InputPassword2" placeholder="Confirm Password" class="form-control form-control-user" name="password_confirmation" autocomplete="new-password">
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
{{--                                            <input type="checkbox" class="custom-control-input" id="customCheck">--}}
{{--                                            <label class="custom-control-label" for="customCheck">Remember Me</label>--}}
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block border-0" style="background: #ff572a">
                                        Register
                                    </button>
                                </form>
                                <div class="mt-3 text-right">
                                    <a class="small" href="{{ route('restaurants.login') }}">Already Login?</a>
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
<script>
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            var inputElement = document.getElementById("latitude");
            inputElement.value = latitude;
            var inputElement1 = document.getElementById("longitude");
            inputElement1.value = longitude;
        });
    } else {
        alert("Geolocation is not available in your browser.");
    }
</script>

</body>

</html>

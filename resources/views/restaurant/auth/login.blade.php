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
    <link href="{{asset('assets/admin/css/toastr.css')}}" rel="stylesheet" type="text/css"/>

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
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Just Halaall <br>Restaurant Panel</h1>
                                </div>
                                <form class="user restaurant-form" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="email" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="{{ old('email') }}"
                                               required autocomplete="email" autofocus
                                               placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               name="password" required autocomplete="current-password"
                                               id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
{{--                                            <input type="checkbox" class="custom-control-input" id="customCheck">--}}
{{--                                            <label class="custom-control-label" for="customCheck">Remember Me</label>--}}
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block border-0" style="background: #ff572a">
                                        Login
                                    </button>
                                </form>
                                <div class="mt-3 text-right">
                                    <a class="small" href="{{ route('restaurants.showRegistrationForm') }}">Sign Up?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('restaurants.forgetPassword') }}">Forgot Password?</a>
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
<script src="{{asset('assets/admin/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/admin/js/toastr.min.js')}}"></script>

<script>

    /* START - blockUi */
    function blockUi(){
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    }
    function successMsg(_msg){
        window.toastr.success(_msg);
    }
    function errorMsg(_msg){
        window.toastr.error(_msg);
    }
    function warningMsg(_msg){
        window.toastr.warning(_msg);
    }

</script>


<script>
    /*$('.register-form').on('submit',function (e){
        e.preventDefault();
        let data = $(this).serialize();

        blockUi();
        $.ajax({
            type:'POST',
            dataType:'json',
            url:'',
            data:data,
            success:function(data) {
                $.unblockUI();
                if(data.status == 1){

                    window.toastr.success(data.message);
                }
                if(data.status == 0){
                    console.log(data);
                    window.toastr.error(data.message);
                    // errorMsg();
                }
            },
            error:function(data) {
                console.log('error');
                $.unblockUI();

            }

        });

    });
    */

    $('.restaurant-form').on('submit',function (e){
        e.preventDefault();
        let data = $(this).serialize();

        blockUi();
        $.ajax({
            type:'POST',
            dataType:'json',
            url:'{{ route('restaurants.login') }}',
            data:data,
            success:function(data) {
                $.unblockUI();
                if(data.status === 1){
                    window.toastr.success(data.message);
                    window.location.href = data.url;
                }
                if(data.status === 2){
                    window.toastr.warning(data.message);
                }
                if(data.status === 0){
                    console.log(data);
                    window.toastr.error(data.message);
                    //$('.record-error').removeClass('d-none');
                    // errorMsg();
                }
            },
            error:function(data) {
                console.log('error');
                $.unblockUI();
            }

        });

    });
</script>


</body>
</html>

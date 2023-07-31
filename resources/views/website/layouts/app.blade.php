<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Just Halaall">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Just Halaall</title>
    
    <!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="website/assets/img/favicon.png">



    <!-- Fonts -->
    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ asset('website/assets/css/all.min.css') }}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('website/assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ asset('website/assets/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ asset('website/assets/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ asset('website/assets/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ asset('website/assets/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ asset('website/assets/css/main.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('website/assets/css/responsive.css') }}">
    @yield('style')
</head>
<body>
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<div class="site-logo">
							<a href="index.html">
								<img src="website/assets/img/halaall.png" alt="" style="max-width: 50%;">
							</a>
						</div>
						<nav class="main-menu">
							<ul>
								<li><a href="/homev1">Home</a></li>
								<li><a href="/aboutv1">About</a></li>
								<li><a href="/contactv1">Contact</a></li>
								@auth
								<li><a href="#">Shop</a>
									<ul class="sub-menu">
										<li><a href="/cartv1">Cart</a></li>
										<li><a href="/checkoutv1">Checkout</a></li>
									</ul>
								</li>
								@endauth								
								<li style="float: right;">
									<div class="header-icons">
										@auth
											<a class="shopping-cart" href="/cartv1"><i class="fas fa-shopping-cart"></i></a>
										@endauth								
									</div>
									@auth
									<li><a href="#">My Account</a>
										<ul class="sub-menu">
											<li><a class="mobile-hide search-bar-icon" href="#">My Profile</a></li>
											<li><a href="#">My Orders</a></li>
											<li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
											<form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
												@csrf
											</form>
										</ul>
									</li>
									@else
									<li><a href="{{url('loginv1')}}">Login</a></li>
									@endauth								
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@auth
	<div class="search-area">
		<div class="container">
			<div class="row mt-5">
				<div class="col-lg-6" style="margin: 0 auto;">
					<div class="search-bar">
						<div class="card-body py-5">
							<h3 class="text-white">My Profile</h3>
							<div class="billing-address-form">
								<form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
								@csrf	
									<label for="" class="text-white float-left">Name</label>					        	
									<p>
										<input name="name" value="{{Auth::user()->name}}" type="text" placeholder="Name">
										<input hidden name="id" value="{{Auth::user()->id}}">
									</p>
									@if($errors->has('name'))
										<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('name')}}</span>
									@endif
									<label for="" class="text-white float-left">Phone</label>					        	
									<p>
										<input name="phone" value="{{Auth::user()->phone}}" type="text" placeholder="Phone">
									</p>					
									@if($errors->has('phone'))
										<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('phone')}}</span>
									@endif	    
									<label for="" class="text-white float-left">Address</label>					        	
									<p>
										<input name="address" value="{{Auth::user()->address}}" type="text" placeholder="Address">
									</p>	
									@if($errors->has('address'))
										<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('address')}}</span>
									@endif
									<label for="" class="text-white float-left">Image</label>					        	
									<p>
										<input name="image" value="" type="file">
									</p>					
									@if($errors->has('image'))
										<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('image')}}</span>
									@endif	        	
									<button type="submit" class="boxed-btn">Update Profile</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6" style="margin: 0 auto;">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="card-body py-5">
							<h3 class="text-white">Change Password</h3>
							<div class="billing-address-form">
								<form action="{{ route('updatePassword') }}" method="post" enctype="multipart/form-data">
								@csrf	
									<label for="" class="text-white float-left">Old Password</label>					        	
									<p>
										<input name="old_password" type="password" placeholder="Old Password">
										<input hidden name="id" value="{{Auth::user()->id}}">
									</p>	
									@if($errors->has('old_password'))
										<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('old_password')}}</span>
									@endif
									<label for="" class="text-white float-left">New Password</label>					        	
									<p>
										<input name="new_password" type="password" placeholder="New Password">
									</p>	
									@if($errors->has('new_password'))
										<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('new_password')}}</span>
									@endif	        	
									<button type="submit" class="boxed-btn">Update Password</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endauth								
    
    @yield('content')
       
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p><a href="/">Just Halaall</a><br>
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Scripts -->
<!--<script src="{{ asset('js/app.js') }}" defer></script>-->
<!-- jquery -->
<script src="{{ asset('website/assets/js/jquery-1.11.3.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('website/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- count down -->
<script src="{{ asset('website/assets/js/jquery.countdown.js') }}"></script>
<!-- isotope -->
<script src="{{ asset('website/assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
<!-- waypoints -->
<script src="{{ asset('website/assets/js/waypoints.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('website/assets/js/owl.carousel.min.js') }}"></script>
<!-- magnific popup -->
<script src="{{ asset('website/assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- mean menu -->
<script src="{{ asset('website/assets/js/jquery.meanmenu.min.js') }}"></script>
<!-- sticker js -->
<script src="{{ asset('website/assets/js/sticker.js') }}"></script>
<!-- main js -->
<script src="{{ asset('website/assets/js/main.js') }}"></script>
</body>
</html>

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
<style>

@keyframes pulse-black {
	0% {
		transform: scale(0.95);
		box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
	}
	
	70% {
		transform: scale(1);
		box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
	}
	
	100% {
		transform: scale(0.95);
		box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
	}
}

.blobWhite {
	box-shadow: 0 0 0 0 rgba(255, 255, 255, 1);
	animation: pulse-white 2s infinite;
	box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
	transform: scale(1);
}

@keyframes pulse-white {
	0% {
	/* 	transform: scale(0.95); */
		box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
	}
	
	70% {
	/* 	transform: scale(1); */
		box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
	}
	
	100% {
	/* 	transform: scale(0.95); */
		box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
	}
}

.checked {
  	color: #ffd700;
}
.unchecked {
	color: #adadad;
}
#header-content {
	position: absolute;
	bottom: 25px;
	/* left: 0; */
	right: 10px;
}
/* https://stackoverflow.com/questions/58819564/rating-make-star-fill-on-hover */
.mainDiv:hover {
    background: #c5c5c5;
  }
.mainDiv {
    /* background-color: #e9e9e9; */
	transition: background-color 0.3s ease, transform 0.3s ease;
}  
html {
  scroll-behavior: smooth;
}
html {
    scroll-behavior: smooth;
}
.dropbtn {
  	background-color: #04AA6D;
  	color: white;
  	padding: 16px;
  	font-size: 16px;
  	border: none;
  	width: 100%;
  	cursor: pointer;
}
.dropbtn:hover, .dropbtn:focus {
  	background-color: #3e8e41;
}
#myInput {
  	box-sizing: border-box;
  	background-image: url('https://www.w3schools.com/howto/searchicon.png');
  	background-position: 14px 16px;
  	background-repeat: no-repeat;
  	font-size: 16px;
  	padding: 14px 20px 12px 45px;
  	border: none;
  	border-bottom: 1px solid #ddd;
  	width: 100%;
}
#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  	display: inline-block;
}
.dropdown-content {
  	display: none;
  	background-color: #f6f6f6;
  	max-width: 200%;
  	overflow: auto;
  	border: 1px solid #ddd;
}
.dropdown-content a {
  	color: black;
  	text-decoration: none;
  	display: block;
  	padding: 10px !important;
}
.dropdown a:hover {
	background-color: #ddd;
}
.show {display: block;}



.steps .step {
    	display: block;
    	width: 100%;
    	margin-bottom: 35px;
    	text-align: center
	}
	.steps .step .step-icon-wrap {
		display: block;
		position: relative;
		width: 100%;
		height: 80px;
		text-align: center
	}
	.steps .step .step-icon-wrap::before,
	.steps .step .step-icon-wrap::after {
		display: block;
		position: absolute;
		top: 50%;
		width: 50%;
		height: 3px;
		margin-top: -1px;
		background-color: #e1e7ec;
		content: '';
		z-index: 1
	}
	.steps .step .step-icon-wrap::before {
		left: 0
	}
	.steps .step .step-icon-wrap::after {
		right: 0
	}
	.steps .step .step-icon {
		display: inline-block;
		position: relative;
		width: 80px;
		height: 80px;
		border: 1px solid #e1e7ec;
		border-radius: 50%;
		background-color: #ffffff;
		color: #374250;
		font-size: 38px;
		line-height: 81px;
		z-index: 5
	}
	.steps .step .step-title {
		margin-top: 16px;
		margin-bottom: 0;
		color: #606975;
		font-size: 14px;
		font-weight: 500
	}
	.steps .step:first-child .step-icon-wrap::before {
		display: none
	}
	.steps .step:last-child .step-icon-wrap::after {
		display: none
	}
	.steps .step.completed .step-icon-wrap::before,
	.steps .step.completed .step-icon-wrap::after {
		background-color: #d3d3d3
	}
	.steps .step.completed .step-icon {
		/* border-color: #6b6b6b; */    
		/* background-color: #0da9ef; */
		color: #fff
	}
	@media (max-width: 576px) {
		.flex-sm-nowrap .step .step-icon-wrap::before,
		.flex-sm-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	@media (max-width: 768px) {
		.flex-md-nowrap .step .step-icon-wrap::before,
		.flex-md-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	@media (max-width: 991px) {
		.flex-lg-nowrap .step .step-icon-wrap::before,
		.flex-lg-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	@media (max-width: 1200px) {
		.flex-xl-nowrap .step .step-icon-wrap::before,
		.flex-xl-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	.bg-faded, .bg-secondary {
		background-color: #f5f5f5 !important;
	}
</style>
<body>
    <!-- <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
			<div id="loader1"></div>
        </div>
    </div> -->
	<div id="loader"></div>
	<div class="top-header-area" id="sticker">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<button hidden id="get-location-button">Get Location</button>
    				<p hidden id="location-display"></p>
					<div class="main-menu-wrap">
						<div class="site-logo">
							<a href="/homev1">
								<img src="website/assets/img/halaall.png" alt="" style="max-width: 50%; margin-top: -10px;">
							</a>
						</div>
						<nav class="main-menu">
							<ul>
								<li><a href="/homev1">Home</a></li>
								<li><a href="/aboutv1">About</a></li>
								<li><a href="/contactv1">Contact</a></li>
								<li><a href="/restaurantsv1">Restaurants</a></li>
								<li><a href="/productsv1">Products</a></li>
								@auth
								<li><a href="#">Shop</a>
									<ul class="sub-menu">
										<li><a href="/cartv1">Cart</a></li>
										<li><a href="/checkoutv1">Checkout</a></li>
									</ul>
								</li>
								@endauth
								<li class="mr-3">
									<button type="button" style="border-radius: 20px;" class="btn btn-sm btn-outline-light px-3 detai22">Active Orders</button>
								</li>			
								<li style="width: min-content;">
									<div class="dropdown">			
										<!-- <a onclick="myFunction1()" data-toggle="modal" data-target="#staticBackdrop" class="cart-btn mt-1 px-4 blobWhite" style="width: 150%; color: black; font-weight: 400; padding: 8px 20px; background-color: #fff;">Find Restaurants <img id="preparing1" src="uploads/giphy13.gif" alt="" style="max-width: 10%;"></a> -->
										<a onclick="myFunction1()" data-toggle="modal" data-target="#staticBackdrop" class="cart-btn mt-1 px-4 blobWhite" style="width: 150%; color: black; font-weight: 400; padding: 8px 20px; background-color: #fff;">Find Restaurants 
										<svg
											aria-hidden="true"
											focusable="false"
											class="fl-none"
											width="24"
											height="24"
											viewBox="0 0 24 24"
											xmlns="http://www.w3.org/2000/svg"
										>
										<path
											fill="#F28123"
											fill-rule="evenodd"
											clip-rule="evenodd"
											d="M12 2C12.4142 2 12.75 2.33579 12.75 2.75L12.7506 3.67925C12.7507 3.88008 12.8998 4.04968 13.0989 4.07562C13.1524 4.08259 13.1986 4.08909 13.2375 4.09514C16.6725 4.62856 19.3848 7.34731 19.9084 10.7855C19.9135 10.8188 19.9189 10.8575 19.9247 10.9019C19.9506 11.1011 20.1204 11.2502 20.3214 11.2502L21.25 11.25C21.6642 11.25 22 11.5858 22 12C22 12.4142 21.6642 12.75 21.25 12.75L20.3212 12.7506C20.1205 12.7507 19.951 12.8995 19.9249 13.0985C19.9211 13.1273 19.9175 13.1532 19.9141 13.1762C19.4013 16.6567 16.647 19.4078 13.1649 19.9158C13.145 19.9187 13.1228 19.9218 13.0984 19.925C12.8995 19.9511 12.7507 20.1206 12.7506 20.3213L12.75 21.25C12.75 21.6642 12.4142 22 12 22C11.5858 22 11.25 21.6642 11.25 21.25L11.2502 20.3213C11.2502 20.1203 11.1011 19.9505 10.9018 19.9246C10.8535 19.9183 10.8115 19.9124 10.7758 19.9069C7.33814 19.379 4.62167 16.6629 4.09327 13.2254C4.08776 13.1896 4.08184 13.1474 4.07552 13.0989C4.04958 12.8997 3.87997 12.7507 3.67912 12.7506L2.75 12.75C2.33579 12.75 2 12.4142 2 12C2 11.5858 2.33579 11.25 2.75 11.25L3.67818 11.2502C3.87895 11.2502 4.04865 11.1015 4.07487 10.9024C4.07777 10.8805 4.08053 10.8604 4.08317 10.8422C4.58738 7.36412 7.32923 4.61075 10.8016 4.08916C10.8307 4.08479 10.8642 4.08013 10.902 4.07519C11.1012 4.04909 11.2502 3.87936 11.2502 3.67848L11.25 2.75C11.25 2.33579 11.5858 2 12 2ZM12 5.5C8.41015 5.5 5.5 8.41015 5.5 12C5.5 15.5899 8.41015 18.5 12 18.5C15.5899 18.5 18.5 15.5899 18.5 12C18.5 8.41015 15.5899 5.5 12 5.5ZM12 8C14.2091 8 16 9.79086 16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8ZM12 9.5C10.6193 9.5 9.5 10.6193 9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5Z">
										</path>
										</svg>
										</a>
									</div>
								</li>							
								<li style="float: right;">
									<div class="header-icons">
										@auth
											<a class="shopping-cart mt-0" href="/cartv1"><i style="font-size: x-large;" class="fas fa-shopping-cart"></i><sup><span class="badge badge-pill badge-light ml-2" style="font-size: 1.2em; padding-top: 7px; background: #F28123;">{{\App\Models\Cart::where(['user_id'=>Auth::id()])->count()}}</span></sup></a>
										@endauth								
									</div>
									@auth
									<li class="mt-2">
										<a style="border: 2px solid white; border-radius: 30px;" href="#" class="dropdown-toggle py-2" data-toggle="dropdown"><i class='fas fa-user-alt mr-2'></i> {{auth()->user()->name}} <span class="caret"></span></a>
										<ul class="sub-menu">
											<li><a class="mobile-hide search-bar-icon w-100" href="#"> My Profile</a></li>
											<li><a class="w-100" href="/ordersv1"> My Orders</a></li>
											<li><a class="w-100" data-toggle="modal" data-target="#exampleModal"> Logout</a></li>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</ul>
									</li>
									@else
									<li class="mt-2">
										<a href="#" class="cart-btn mt-1 px-5 btn-outline-light" style="color: #fff; font-weight: 400; padding: 8px 20px; background-color: #F28123;">Login</a>
										<ul class="sub-menu" style="position: relative; top: 10px;">
											<li><a href="{{url('loginv1')}}">User Login</a></li>
											<li><a href="/restaurant/login">Restaurants Login</a></li>
										</ul>
									</li>
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
			<div class="row mt-5" style="height: auto;">
				<div class="col-lg-12" style="margin: 0 auto; height: auto;">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="card-body py-3">
							<h3 class="text-white">My Profile</h3>
							<div class="billing-address-form">
								<form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
								@csrf	
									<div class="row">
										<div class="col-lg-4">
											<label for="" class="text-white float-left">First Name</label>					        	
											<p>
												<input name="first_name" value="{{Auth::user()->first_name}}" type="text" placeholder="First Name">
												<input hidden name="id" value="{{Auth::user()->id}}">
											</p>
											@if($errors->has('middle_name'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('first_name')}}</span>
											@endif
										</div>
										<div class="col-lg-4">
											<label for="" class="text-white float-left">Middle Name</label>					        	
											<p>
												<input name="middle_name" value="{{Auth::user()->middle_name}}" type="text" placeholder="Middle Name">
											</p>
											@if($errors->has('last_name'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('middle_name')}}</span>
											@endif
										</div>
										<div class="col-lg-4">
											<label for="" class="text-white float-left">Last Name</label>					        	
											<p>
												<input name="last_name" value="{{Auth::user()->last_name}}" type="text" placeholder="Last Name">
											</p>
											@if($errors->has('last_name'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('last_name')}}</span>
											@endif
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-lg-4">
											<label for="" class="text-white float-left">Phone</label>					        	
											<p>
												<input name="phone" value="{{Auth::user()->phone}}" type="text" placeholder="Phone">
											</p>					
											@if($errors->has('phone'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('phone')}}</span>
											@endif	    
										</div>
										<div class="col-lg-4">
											<label for="" class="text-white float-left">Postal Code</label>					        	
											<p>
												<input name="postal_code" value="{{Auth::user()->postal_code}}" type="text" placeholder="Postal Code">
											</p>					
											@if($errors->has('postal_code'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('postal_code')}}</span>
											@endif	
										</div>
										<div class="col-lg-4">
											<label for="" class="text-white float-left">Address</label>					        	
											<p>
												<input name="address" value="{{Auth::user()->address}}" type="text" placeholder="Address">
											</p>	
											@if($errors->has('address'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('address')}}</span>
											@endif
										</div>
									</div>
									<label hidden for="" class="text-white float-left">Image</label>					        	
									<p hidden>
										<input name="image" value="" type="file">
									</p>					
									@if($errors->has('image'))
										<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('image')}}</span>
									@endif	        	
									<div class="row mt-3">
										<div class="col-lg-4"></div>
										<div class="col-lg-4">
											<button type="submit" class="boxed-btn w-100">Update Profile</button>
										</div>
										<div class="col-lg-4"></div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" style="margin: 0 auto;">
					<div class="search-bar">
						<div class="card-body py-3">
							<h3 class="text-white">Change Password</h3>
							<div class="billing-address-form">
								<form action="{{ route('updatePassword') }}" method="post" enctype="multipart/form-data">
								@csrf	
									<div class="row">
										<div class="col-lg-4">
											<label for="" class="text-white float-left">Old Password</label>					        	
											<p>
												<input name="old_password" type="password" placeholder="Old Password">
												<input hidden name="id" value="{{Auth::user()->id}}">
											</p>	
											@if($errors->has('old_password'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('old_password')}}</span>
											@endif
										</div>
										<div class="col-lg-4">										
											<label for="" class="text-white float-left">New Password</label>					        	
											<p>
												<input name="new_password" type="password" placeholder="New Password">
											</p>	
											@if($errors->has('new_password'))
												<span class="badge displayBadges py-2 text-light mt-2" style="background: #cd3f3f; display: block; font-size: 13px !important;">{{$errors->first('new_password')}}</span>
											@endif	      
										</div>
										<div class="col-lg-4">
											<button type="submit" class="boxed-btn w-100 mt-5">Update Password</button>
										</div>
									</div>
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
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: transparent">
                    <h5>Logout?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer" style="background-color: transparent">
                    <button type="button" style="box-shadow: none;" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{ route('logout') }}" 
						onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-toggle="modal" data-target="#logoutModal">
                        <button type="button" style="box-shadow: none; background: #202020; border: none;" class="btn btn-danger mx-1 py-2 px-3">Logout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>       
	<div class="copyright">
		<div class="container">
			<div class="row py-3">
				<div class="col-lg-4 col-md-12">
					<p><a href="/homev1">Just Halaall</a><br>
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
				<div class="col-lg-2 col-md-12 d-flex">
					<img src="website/assets/img/aa.jpg" class="mx-2" alt="" style="height: fit-content; margin-top: 2px; max-width: 30%; border-radius: 8px; border: 2px solid white;">
					<img src="website/assets/img/cc.jpg" class="mx-2" alt="" style="height: fit-content; margin-top: 2px; max-width: 30%; border-radius: 8px; border: 2px solid white;">
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Search Nearest Halal Restaurants</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="single-product">
						<div class="container">
							<div class="row" id="show_hide">
								<div class="col-md-12 mb-3">
									<label for="cc-expiration"> <b> Halal Restaurants</b></label>
									<input type="text" class="form-control card-expiry-month" id="search" name="search" placeholder="Search by Name">
								</div>
							</div>
							<hr>
							<span id="myDropdown11">
								<div id="your_container_id11">
									<img id="gif1" style="box-shadow: none; width: 5%; border-radius: 10px; margin-left: 50%;" src="website/assets/img/newgif.gif" alt="">
								</div>
							</span>
							<span id="myDropdown1">
								<div id="your_container_id1">
									<img id="gif2" style="box-shadow: none; width: 5%; border-radius: 10px; margin-left: 50%;" src="website/assets/img/newgif.gif" alt="">
								</div>
							</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModalCenter111" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Active Orders</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div className="main_container">
						<div class="container padding-bottom-3x mb-1">
							<div class="card mb-3">
								<div class="card-body" style="padding-top: 4px;">
									<div class="row bg-dark">
										<div class="col-3">
											<div class="px-3 py-2 text-center text-white text-lg bg-dark rounded-top">
												<span class="text-capitalize"> <b> Order No </b></span><span id="textMedium" class="text-medium"></span>
												<br>
												<span class="text-capitalize">Order9023</span><span id="textMedium" class="text-medium"></span>
											</div>
										</div>
										<div class="col-3">
											<div class="px-3 py-2 text-center text-white text-lg bg-dark rounded-top">
												<span class="text-capitalize"><b>Item</b></span><span id="textMedium" class="text-medium"></span>
												<br>
												<span class="text-capitalize">Fried Chicken</span><span id="textMedium" class="text-medium"></span>
											</div>
										</div>
										<div class="col-3">
											<div class="px-3 py-2 text-center text-white text-lg bg-dark rounded-top">
												<span class="text-capitalize"><b>Restaurant </b></span><span id="textMedium" class="text-medium"></span>
												<br>
												<span class="text-capitalize">KFC</span><span id="textMedium" class="text-medium"></span>
											</div>
										</div>
										<div class="col-3">
											<div class="px-3 py-2 text-center text-white text-lg bg-dark rounded-top">
												<span class="text-capitalize"><b>Total</b> </span><span id="textMedium" class="text-medium"></span>
												<br>
												<span class="text-capitalize">£ 21</span><span id="textMedium" class="text-medium"></span>
											</div>
										</div>
									</div>
									<div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-bottom-1x my-5">
										<div hidden class="step completed mb-0">
											<div class="step-icon-wrap">
												<div id="stepIcon2" class="step-icon">
													<img id="accepted1" src="uploads/giphy1.gif" alt="" class="mt-3" style="max-width: 70%;">
												</div>
											</div>
											<h4 id="accepted3" class="step-title">Accepted</h4>
										</div>
										<div class="step completed mb-0">
											<div class="step-icon-wrap">
												<div id="stepIcon3" class="step-icon">
													<img id="preparing1" src="uploads/loading.gif" alt="" style="max-width: 100%;">
												</div>
											</div>
											<h4 id="preparing3" class="step-title"><b>Preparing</b></h4>
										</div>
										<div hidden class="step completed mb-0">
											<div class="step-icon-wrap">
												<div id="stepIcon4" class="step-icon">
													<img id="delivery1" src="uploads/boy.gif" alt="" class="mt-0" style="margin-left: -12px; max-width: 135%;">
												</div>
											</div>
											<h4 id="delivery3" class="step-title">Out for Delivery</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<script>
		$('.detai22').click(function (e){
			$('#exampleModalCenter111').modal('show');
		});
	var container11 = document.getElementById('your_container_id11');
	container11.innerHTML = '';
	var searchInput = document.getElementById('search');

	searchInput.addEventListener('input', function () {
	var searchValue = searchInput.value.toLowerCase().trim();
  	const storedArray = JSON.parse(localStorage.getItem('customArray'));
  	console.log("storedArray >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ", storedArray);
  	if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;
			const locationDisplay = document.getElementById('location-display');
			locationDisplay.textContent = `Latitude: ${latitude}, Longitude: ${longitude}`;

			var filteredData = storedArray.filter(function (item) {
				return item.name.toLowerCase().includes(searchValue);
			});
  			console.log("filteredData");
            console.log(filteredData);

			var container1 = document.getElementById('your_container_id1');
			container1.innerHTML = '';
  			if(!searchValue){
				console.log("!searchValue");
				var container11 = document.getElementById('your_container_id11');
				container11.innerHTML = '';
			} 
			if(filteredData.length == 0){
				console.log('Empty', filteredData.length);
				var container11 = document.getElementById('your_container_id11');
				container11.innerHTML = '';
			}

  			filteredData.forEach(function (item){
				var div = document.createElement('div');
				div.innerHTML = `
					<div class="row my-1 mainDiv" style="cursor: pointer;">
						<div class="col-md-2 pl-0">
							<a href="restaurant-detailv1/${item.id}">
								<img class="mt-4 ml-4" style="box-shadow: none; max-width: 75%; max-height: 75%; border-radius: 10px;" src="${asset(item.logo)}" alt="">
							</a>										
						</div>
						<div class="col-md-5 pl-0">
							<a href="restaurant-detailv1/${item.id}">
								<div class="single-product-content ml-0 mt-4 mb-2">
									<h4 style="font-weight: 400;" class="mb-0 mt-3">${item.name} <small>(Open Now)</small> </h4>
									<p class="single-product-pricing mb-0"><span class="mb-0"> Fast-food restaurant company</span></p>
									<div class="single-product-form">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star unchecked"></span>
										<br>
										<a href="cart.html" class="cart-btn mt-1 px-4" style="padding: 5px 20px; background-color: #333130;">Menu</a>
									</div>
								</div>
							</a>										
						</div>
						<div class="col-md-5 pl-0">
							<a href="restaurant-detailv1/${item.id}">
								<div class="single-product-form mt-4 mb-2 d-flex flex-column">    
									<p class="single-product-pricing mt-auto mb-0">
									<span id="header-content" class="mb-0 float-right" style="font-size: medium;">
										<i class="fa fa-map-marker" aria-hidden="true"></i> ${item.address}<small> <b>(7${item.distance} M)</b></small>
									</span>
									</p>
								</div>
							</a>										
						</div>
					</div>
				`;
				function asset(path){
					return 'http://127.0.0.1:8000/' + path;
				}
				container1.appendChild(div);
  			});					
		})
	}
});

function myFunction1(){
	let latitude;
    let longitude;
  	document.getElementById("myDropdown1").classList.toggle("show");
	  	if("geolocation" in navigator){
            navigator.geolocation.getCurrentPosition(function (position){
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;
                const locationDisplay = document.getElementById('location-display');
                locationDisplay.textContent = `Latitude: ${latitude}, Longitude: ${longitude}`;

                check = 1;
                $.ajax({
                    type: 'post',
                    url: "{{ url('add-to-cartv11') }}",
                    data: {
                        latitude_val: latitude,
                        longitude_val: longitude,
                        product_id: 12345,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        console.log('responseresponse');
                        console.log(response);
						localStorage.setItem('customArray', JSON.stringify(response.data));
    					var container = document.getElementById('your_container_id1');
						container.innerHTML = '';

						response.data.forEach(function (item) {
							var div = document.createElement('div');
							div.innerHTML = `								
								<div class="row my-1 mainDiv" style="cursor: pointer;">
									<div class="col-md-2 pl-0">
										<a href="restaurant-detailv1/${item.id}">
											<img class="mt-4 ml-4" style="box-shadow: none; max-width: 75%; max-height: 75%; border-radius: 10px;" src="${asset(item.logo)}" alt="">
										</a>										
									</div>
									<div class="col-md-5 pl-0">
										<a href="restaurant-detailv1/${item.id}">
											<div class="single-product-content ml-0 mt-4 mb-2">
												<h4 style="font-weight: 400;" class="mb-0 mt-3">
													${item.name}
													<small>${item.timer === 1 ? '(Open Now)' : '(Closed)'}</small>
												</h4>
												<p class="single-product-pricing mb-0"><span class="mb-0"> Fast-food restaurant company</span></p>
												<div class="single-product-form">
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star unchecked"></span>
													<br>
													<a href="cart.html" class="cart-btn mt-1 px-4" style="padding: 5px 20px; background-color: #333130;">Menu</a>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-5 pl-0">
										<a href="restaurant-detailv1/${item.id}">
											<div class="single-product-form mt-4 mb-2 d-flex flex-column">    
												<p class="single-product-pricing mt-auto mb-0">
												<span id="header-content" class="mb-0 float-right" style="font-size: medium;">
													<i class="fa fa-map-marker" aria-hidden="true"></i> ${item.address}<small> <b>(${item.distance} M)</b></small>
												</span>
												</p>
											</div>
										</a>
									</div>
								</div>
							`;
							function asset(path) {
								return 'http://127.0.0.1:8000/' + path;
							}
						container.appendChild(div);
					});
                }
            });
        });
	} 
	else{
		alert("Geolocation is not available in your browser.");
	}
}

</script>
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

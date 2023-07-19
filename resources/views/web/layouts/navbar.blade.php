<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-default bootsnav p-0">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/"><img src="{{asset('assets/web/images/index2.png')}}" width="90px" class="logo" alt=""></a>
                <!--                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" class="logo" alt=""></a>-->
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{'/'}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{'/about'}}">About Us</a></li>
                    <li class="dropdown">
                        <a href="/" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                        <ul class="dropdown-menu">
                            @auth
                            <li><a href="{{'/cart'}}">Cart</a></li>
                            <li><a href="{{'/checkout'}}">Checkout</a></li>
                            @else
                            <li><a href="{{'/login'}}">Cart</a></li>
                            <li><a href="{{'/login'}}">Checkout</a></li>
                            @endauth
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{'contact'}}">Contact Us</a></li>
                    @auth
                        <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">My Account</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('profile') }}">Profile</a></li>
                            <li><a href="{{ route('orders') }}">My Orders</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}"
                            method="POST" style="display: none;">
                            @csrf
                        </form>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{url('login')}}">Login</a></li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <div class="attr-nav">
                <ul class="navbar-icons">
                    <li class="side-menu">
                        {{-- <a href="#">
                            <i class="fa fa-shopping-bag"></i>
                            <!-- <span class="badge">3</span> -->
                        </a> --}}
                    </li>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>

        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    <li>
                        <a href="#" class="photo"><img src="{{asset('assets/web/images/img-pro-01.jpg')}}" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Delica omtantur </a></h6>
                        <p>1x - <span class="price">£80.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{asset('assets/web/images/img-pro-02.jpg')}}" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Omnes ocurreret</a></h6>
                        <p>1x - <span class="price">£60.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{asset('assets/web/images/img-pro-03.jpg')}}" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Agam facilisis</a></h6>
                        <p>1x - <span class="price">£40.00</span></p>
                    </li>
                    <li class="total">
                        <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right"><strong>Total</strong>: £180.00</span>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->
<!-- Start Top Search -->

<form action="{{route('search')}}" method="get" style="margin-bottom: 0px;">
    @csrf
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" name="search" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
</form>
<!-- End Top Search -->

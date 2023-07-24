<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<!--#fbb867-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>@yield('title','Index')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset("assets/web/images/index.jpg") }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset("assets/web/images/index.jpg") }}">

   @include('web.layouts.css')
    @yield('style')

</head>

<body>
<!-- Start Main Top -->
<!--    <div class="main-top">-->
<!--        <div class="container-fluid">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--					<div class="custom-select-box">-->
<!--                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="£ USD">-->
<!--							<option>¥ JPY</option>-->
<!--							<option>£ USD</option>-->
<!--							<option>€ EUR</option>-->
<!--						</select>-->
<!--                    </div>-->
<!--                    <div class="right-phone-box">-->
<!--                        <p>Call US :- <a href="#"> +11 900 800 100</a></p>-->
<!--                    </div>-->
<!--                    <div class="our-link">-->
<!--                        <ul>-->
<!--                            <li><a href="#"><i class="fa fa-user s_color"></i> My Account</a></li>-->
<!--                            <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>-->
<!--                            <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--					<div class="login-box">-->
<!--						<select id="basic" class="selectpicker show-tick form-control" data-placeholder="Sign In">-->
<!--							<option>Register Here</option>-->
<!--							<option>Sign In</option>-->
<!--						</select>-->
<!--					</div>-->
<!--                    <div class="text-slid-box">-->
<!--                        <div id="offer-box" class="carouselTicker">-->
<!--                            <ul class="offer-box">-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT80-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> Off 10%! Shop Vegetables-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> 50% - 80% off on Vegetables-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT30-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <i class="fab fa-opencart"></i> Off 50%! Shop Now -->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!-- End Main Top -->

<!-- Start Main Top -->
@include('web.layouts.navbar')
<!-- End Main Top -->





@yield('content')

<!--	<div class="box-add-products">-->
<!--		<div class="container">-->
<!--			<div class="row">-->
<!--				<div class="col-lg-6 col-md-6 col-sm-12">-->
<!--					<div class="offer-box-products">-->
<!--						<img class="img-fluid" src="images/add-img-01.jpg" alt="" />-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-lg-6 col-md-6 col-sm-12">-->
<!--					<div class="offer-box-products">-->
<!--						<img class="img-fluid" src="images/add-img-02.jpg" alt="" />-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--    <div class="products-box">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!--                    <div class="title-all text-center">-->
<!--                        <h1 style="color: #fd6e50;">Restaurants</h1>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!--                    <div class="special-menu text-center">-->
<!--                        <div class="button-group filter-button-group">-->
<!--                            <button class="active" data-filter="*">All</button>-->
<!--                            <button data-filter=".top-featured">Top featured</button>-->
<!--                            <button data-filter=".best-seller">Best seller</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="row special-list">-->
<!--                <div class="col-lg-3 col-md-6 special-grid best-seller">-->
<!--                    <div class="products-single fix">-->
<!--                        <div class="box-img-hover">-->
<!--                            <div class="type-lb">-->
<!--                                <p class="sale">Sale</p>-->
<!--                            </div>-->
<!--                            <img src="images/img-pro-01.jpg" class="img-fluid" alt="Image">-->
<!--                            <div class="mask-icon">-->
<!--                                <ul>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>-->
<!--                                </ul>-->
<!--                                <a class="cart" href="#">Add to Cart</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="why-text">-->
<!--                            <h4>Lorem ipsum dolor sit amet</h4>-->
<!--                            <h5> £7.79</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="col-lg-3 col-md-6 special-grid top-featured">-->
<!--                    <div class="products-single fix">-->
<!--                        <div class="box-img-hover">-->
<!--                            <div class="type-lb">-->
<!--                                <p class="new">New</p>-->
<!--                            </div>-->
<!--                            <img src="images/img-pro-02.jpg" class="img-fluid" alt="Image">-->
<!--                            <div class="mask-icon">-->
<!--                                <ul>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>-->
<!--                                </ul>-->
<!--                                <a class="cart" href="#">Add to Cart</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="why-text">-->
<!--                            <h4>Lorem ipsum dolor sit amet</h4>-->
<!--                            <h5> £9.79</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="col-lg-3 col-md-6 special-grid top-featured">-->
<!--                    <div class="products-single fix">-->
<!--                        <div class="box-img-hover">-->
<!--                            <div class="type-lb">-->
<!--                                <p class="sale">Sale</p>-->
<!--                            </div>-->
<!--                            <img src="images/img-pro-03.jpg" class="img-fluid" alt="Image">-->
<!--                            <div class="mask-icon">-->
<!--                                <ul>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>-->
<!--                                </ul>-->
<!--                                <a class="cart" href="#">Add to Cart</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="why-text">-->
<!--                            <h4>Lorem ipsum dolor sit amet</h4>-->
<!--                            <h5> £10.79</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="col-lg-3 col-md-6 special-grid best-seller">-->
<!--                    <div class="products-single fix">-->
<!--                        <div class="box-img-hover">-->
<!--                            <div class="type-lb">-->
<!--                                <p class="sale">Sale</p>-->
<!--                            </div>-->
<!--                            <img src="images/img-pro-04.jpg" class="img-fluid" alt="Image">-->
<!--                            <div class="mask-icon">-->
<!--                                <ul>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>-->
<!--                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>-->
<!--                                </ul>-->
<!--                                <a class="cart" href="#">Add to Cart</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="why-text">-->
<!--                            <h4>Lorem ipsum dolor sit amet</h4>-->
<!--                            <h5> £15.79</h5>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->




<!-- Start Instagram Feed  -->
<!--    <div class="instagram-box">-->
<!--        <div class="main-instagram owl-carousel owl-theme">-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-01.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-02.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-03.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-04.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-05.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-06.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-07.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-08.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-09.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="ins-inner-box">-->
<!--                    <img src="images/instagram-img-05.jpg" alt="" />-->
<!--                    <div class="hov-in">-->
<!--                        <a href="#"><i class="fab fa-instagram"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!-- End Instagram Feed  -->


<!-- Start Footer  -->
{{--@include('web.layouts.footer')--}}
<!-- End Footer  -->

<!-- Start copyright  -->
<!--    <div class="footer-copyright">-->
<!--        <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :-->
<!--            <a href="https://html.design/">html design</a></p>-->
<!--    </div>-->
<!-- End copyright  -->

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
@include('web.layouts.js')
</body>

</html>

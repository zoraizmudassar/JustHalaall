@extends('website.layouts.app')
@section('content')
<style>
.breadcrumb-bg{
  background-image: url(website/assets/img/breadcrumb-bg.jpg);
}
.hero-bg{
  background-image: url('website/assets/img/hero-bg.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}
.homepage-bg-1{
  background-image: url(website/assets/img/bg77.jpg);
}
.homepage-bg-2{
  background-image: url(website/assets/img/bg11.jpg);
}
.homepage-bg-3{
  background-image: url(website/assets/img/bg22.jpg);
}
.news-bg-1{
  background-image: url(website/assets/img/latest-news/news-bg-1.jpg);
}
.news-bg-2{
  background-image: url(website/assets/img/latest-news/news-bg-2.jpg);
}
.news-bg-3{
  background-image: url(website/assets/img/latest-news/news-bg-3.jpg);
}
.news-bg-4{
  background-image: url(website/assets/img/latest-news/news-bg-4.jpg);
}
.news-bg-5{
  background-image: url(website/assets/img/latest-news/news-bg-5.jpg);
}
.news-bg-6{
  background-image: url(website/assets/img/latest-news/news-bg-6.jpg);
}
.single-artcile-bg{
  background-image: url(website/assets/img/latest-news/news-bg-3.jpg);
  height: 450px;
}
</style>
<div class="homepage-slider">
	<div class="single-homepage-slider homepage-bg-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Fresh & Organic</p>
							<h1>Delicious Seasonal Fruits</h1>
							<div class="hero-btns">
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="single-homepage-slider homepage-bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Fresh Everyday</p>
							<h1>100% Organic Collection</h1>
							<div class="hero-btns">
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="single-homepage-slider homepage-bg-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-right">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Mega Sale Going On!</p>
							<h1>Get December Discount</h1>
							<div class="hero-btns">
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="list-section pt-80 pb-80" hidden>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-shipping-fast"></i>
					</div>
					<div class="content">
						<h3>Free Shipping</h3>
						<p>When order over $75</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-phone-volume"></i>
					</div>
					<div class="content">
						<h3>24/7 Support</h3>
						<p>Get support all day</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="list-box d-flex justify-content-start align-items-center">
					<div class="list-icon">
						<i class="fas fa-sync"></i>
					</div>
					<div class="content">
						<h3>Refund</h3>
						<p>Get refund within 3 days!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">	
					<h3><span class="orange-text">Our</span> Categories</h3>
				</div>
			</div>
		</div>
		<div class="row">
		    @foreach($foodCategory as $category)
			<div class="col-lg-4 col-md-6 text-center my-3">
				<a href="{{ url('categoryproductsv1/'.$category->id) }}">
					<div class="single-product-item h-100">
						<div class="product-image">
							<img src="{{asset($category->image)}}" alt="">
						</div>
						<h3 style="font-weight: 500; text-transform: capitalize;">{{$category['name']}}</h3>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">	
					<h3><span class="orange-text">Our</span> Restaurants</h3>
				</div>
			</div>
		</div>
		<div class="row">
		    @foreach($resturant as $data)
			<div class="col-lg-4 col-md-6 text-center my-3">
				<a href="{{ url('restaurant-detailv1/'.$data->id) }}">
					<div class="single-product-item h-100">
						<div class="product-image">
							<img src="{{asset($data->logo)}}" alt="">
						</div>
						<h3 style="font-weight: 500; text-transform: capitalize;">{{$data['name']}}</h3>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">	
					<h3><span class="orange-text">Featured</span> Products</h3>
				</div>
			</div>
		</div>
		<div class="row">
		    @foreach($featuredProducts as $data)
			<div class="col-lg-4 col-md-6 text-center my-3">
				<a>
					<div class="single-product-item h-100">
						<div class="product-image">
							<img src="{{asset($data->images)}}" alt="">
						</div>
						<h3 style="font-weight: 500; text-transform: capitalize;">{{$data['name']}}</h3>
						<p class="product-price"> £{{$data['price']}} </p>
						<button type="button" role="button" id="addcart{{$data->id}}" class="boxed-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
<section class="cart-banner pt-100 pb-100">
	<div class="container">
		<div class="row clearfix">
			<div class="image-column col-lg-6">
				<div class="image">
					<div class="price-box">
						<div class="inner-price">
							<span class="price">
								<strong>30%</strong> <br> off per kg
							</span>
						</div>
					</div>
					<img src="website/assets/img/a.jpg" alt="">
				</div>
			</div>
			<div class="content-column col-lg-6">
				<h3><span class="orange-text">Deal</span> of the month</h3>
				<h4>Hikan Strwaberry</h4>
				<div class="text">Quisquam minus maiores repudiandae nobis, minima saepe id, fugit ullam similique! Beatae, minima quisquam molestias facere ea. Perspiciatis unde omnis iste natus error sit voluptatem accusant</div>
				<div class="time-counter"><div class="time-countdown clearfix" data-countdown="2020/2/01"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div>
				<a href="#" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
			</div>
		</div>
	</div>
</section>
<div hidden class="latest-news pt-150 pb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">	
					<h3><span class="orange-text">Our</span> News</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="single-latest-news">
					<a href="single-news.html"><div class="latest-news-bg news-bg-1"></div></a>
					<div class="news-text-box">
						<h3><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></h3>
						<p class="blog-meta">
							<span class="author"><i class="fas fa-user"></i> Admin</span>
							<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
						</p>
						<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
						<a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single-latest-news">
					<a href="single-news.html"><div class="latest-news-bg news-bg-2"></div></a>
					<div class="news-text-box">
						<h3><a href="single-news.html">A man's worth has its season, like tomato.</a></h3>
						<p class="blog-meta">
							<span class="author"><i class="fas fa-user"></i> Admin</span>
							<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
						</p>
						<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
						<a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
				<div class="single-latest-news">
					<a href="single-news.html"><div class="latest-news-bg news-bg-3"></div></a>
					<div class="news-text-box">
						<h3><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></h3>
						<p class="blog-meta">
							<span class="author"><i class="fas fa-user"></i> Admin</span>
							<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
						</p>
						<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
						<a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
jQuery( document ).ready(function() {
    $('form input').focus(function(){
		$(this).siblings(".displayBadges").fadeOut(1500);
    });
});
</script>
<script>
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            Swal.fire({
            icon: 'info',
            title: "Error!",
            text: "{{ session('message') }}",
        });
        break;
        case 'warning':
            Swal.fire({
            icon: 'warning',
            text: "{{ session('message') }}",
        });
        break;
        case 'success':
            Swal.fire({
            icon: 'success',
			title: 'Success',
            text: "{{ session('message') }}",
            showConfirmButton: false,
			timer: 3000
        });
        break;
        case 'error':
            Swal.fire({
            icon: 'error',
			title: 'Error',
            text: "{{ session('message') }}",
            showConfirmButton: false,
			timer: 3000
        });
        break;
    }
@endif
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        <?php
    foreach ($featuredProducts as $item) {
    ?>
        $('#addcart<?php echo $item->id; ?>').click(function() {
            <?php if (auth()->user() != null) { ?>
            $.ajax({
                type: 'post',
                url: "{{ url('add-to-cartv1') }}",
                data: {
                    product_id: <?php echo $item->id; ?>,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Product add to cart',
						showConfirmButton: false,
						timer: 3000
					});
                }
            });
            <?php } else { ?>
				Swal.fire({
						icon: 'warning',
						title: "Please Login First",
						showConfirmButton: false,
						timer: 3000
					});
            <?php } ?>
        });
        <?php } ?>
    });
</script>
@endsection
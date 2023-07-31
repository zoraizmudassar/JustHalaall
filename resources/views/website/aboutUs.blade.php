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
  background-image: url(website/assets/img/about1.jpg);
}
.news-bg-2{
  background-image: url(website/assets/img/about2.jpeg);
}
.news-bg-3{
  background-image: url(website/assets/img/about3.jpg);
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
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1>About Us</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="latest-news pt-150 pb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center mb-5">
				<h2 class="pb-5">Why <span class="orange-text">Just Halaall</span></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="featured-text">
					<div class="row">
						<div class="col-lg-6 col-md-6 mb-4 mb-md-5">
							<div class="list-box d-flex">
								<div class="list-icon">
									<i class="fas fa-shipping-fast"></i>
								</div>
								<div class="content">
									<h3>Home Delivery</h3>
									<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 mb-5 mb-md-5">
							<div class="list-box d-flex">
								<div class="list-icon">
									<i class="fas fa-money-bill-alt"></i>
								</div>
								<div class="content">
									<h3>Best Price</h3>
									<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 mb-5 mb-md-5">
							<div class="list-box d-flex">
								<div class="list-icon">
									<i class="fas fa-briefcase"></i>
								</div>
								<div class="content">
									<h3>Custom Box</h3>
									<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="list-box d-flex">
								<div class="list-icon">
									<i class="fas fa-sync-alt"></i>
								</div>
								<div class="content">
									<h3>Quick Refund</h3>
									<p>sit voluptatem accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
								</div>
							</div>
						</div>
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
@endsection
@extends('website.layouts.app')
@section('title','Oders')
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
					<h1>My Orders</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="latest-news pt-150 pb-150">
	<div class="container">

		<div class="row">
			<div class="col-lg-12">
			<table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Order No</th>
                <th scope="col">Restaurant</th>
                <th scope="col">Payment type</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th scope="row">2</th>
                <td>Desi Restaurant</td>
                <td>Cash on Collection</td>
                <td>£25</td>
                <td><span class="badge badge-warning p-2">Make Order On Way</span></td>
                <td>05 Oct 2021</td>
            </tr>
            <tr hidden>
                <td colspan="7" style="text-align: center;">No Order Found!</td>
            </tr>
            </tbody>
        </table>
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
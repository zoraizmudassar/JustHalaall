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
                <th scope="col">#</th>
                <th scope="col">Restaurant</th>
                <th scope="col">Payment type</th>
                <th scope="col">Total</th>
                <th scope="col">Commission Percent</th>
                <th scope="col">Total Commission</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
                @if(count($orders)>0)
                @foreach ($orders as $index=>$item)
            <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$item->restaurant??''}}</td>
                <td>Card</td>
                <td>£{{$item->total??'0'}}</td>
                <td>£{{$item->commission_percent??'0'}}</td>
                <td>£{{$item->total_commission??'0'}}</td>
                <td>{{$item->order_date}}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7" style="text-align: center;">No Order Found!</td>
            </tr>
            @endif
            {{-- <tr>
                <th scope="row">2</th>
                <td>Desi Restaurant</td>
                <td>Cash on Collection</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Gourmet</td>
                <td>Online Payment/Credit Card</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Glowfish Broast</td>
                <td>Cash on delivery</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td>Dera Restaurant</td>
                <td>Cash on Collection</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr>
            <tr>
                <th scope="row">6</th>
                <td>Family Restaurant</td>
                <td>Online Payment/Credit Card</td>
                <td>£2500</td>
                <td>5%</td>
                <td>£25</td>
                <td>Pending</td>
                <td>05 Oct 2021</td>
            </tr> --}}
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
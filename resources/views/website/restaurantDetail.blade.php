@extends('website.layouts.app')
@section('content')
<style>
.breadcrumb-bg{
  	background-image: url(website/assets/img/breadcrumb-bg.jpg);
}
</style>
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row py-4">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1>About {{$restaurantDetail[0]->name}}</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-body text-center" style="box-shadow: 0.1rem 0.1rem 1rem rgb(0 0 0 / 20%);">
					<h6>Albondigas Soup</h6>
					<p>{{$restaurantDetail[0]->aboutUs}}</p>
					<span class="float-right font-weight-bold">
						<i class="fas fa-star" style="color: #fd7e14"></i>
						<i class="fas fa-star" style="color: #fd7e14"></i>
						<i class="fas fa-star" style="color: #fd7e14"></i>
						<i class="fas fa-star" style="color: #fd7e14"></i>
					</span>
					<h5 class="text-uppercase mt-1">CLOSED until Mon 14:00</h5>
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
					<h3>{{$restaurantDetail[0]->name}} Products</h3>
				</div>
			</div>
		</div>
		<div class="row">
		    @foreach($restaurantProducts as $data)
			<div class="col-lg-4 col-md-6 text-center my-3">
				<div class="single-product-item h-100">
					<div class="product-image">
						<a href="{{ url('categoryproductsv1/'.$data->id) }}"><img src="{{asset($data['images'])}}" alt=""></a>
					</div>
					<h3 style="font-weight: 500; text-transform: capitalize;">{{$data['name']}}</h3>
					<p class="product-price"> £{{$data['price']}} </p>
					<button type="button" role="button" id="addcart{{$data->id}}" class="boxed-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        <?php
    foreach ($restaurantProducts as $item) {
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
						title: "Product add to cart",
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

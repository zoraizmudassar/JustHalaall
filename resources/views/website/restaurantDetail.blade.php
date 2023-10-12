@extends('website.layouts.app')
@section('title','Restaurant Detail')
@section('content')
<style>
.breadcrumb-bg{
  	background-image: url(website/assets/img/breadcrumb-bg.jpg);
}
.zoom {
  transition: transform .6s; /* Animation */
}

.zoom:hover {
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row py-4">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1 style="text-transform: capitalize;">About {{$restaurantDetail[0]->name}}</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-body text-center" style="box-shadow: 0.1rem 0.1rem 1rem rgb(0 0 0 / 20%);">
					<h6 hidden>Albondigas Soup</h6>
					<p>{{$restaurantDetail[0]->aboutUs}}</p>
					<span class="float-right font-weight-bold" hidden>
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
					<h3 style="text-transform: capitalize;">{{$restaurantDetail[0]->name}} Products</h3>
				</div>
			</div>
		</div>
		<div class="row">
		    @foreach($restaurantProducts as $data)
			<div class="col-lg-4 col-md-6 text-center my-3">
				<a data-id="{{$data}}" class="detail">
				<div class="single-product-item h-100 zoom">
					<div class="product-image">
						<img src="{{asset($data['images'])}}" alt="">
					</div>
					<h3 class="mx-3" style="font-weight: 500; text-transform: capitalize;">{{$data['name']}}</h3>
					<p class="product-price"> £{{$data['price']}} </p>
					<button type="button" role="button" id="addcart{{$data->id}}" class="boxed-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
				</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="single-product-img" id="ModelimageBox">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="single-product-content">                       
                            <h3 style="text-transform: capitalize;" id="Modelname"></h3>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-0" id="Modelprice"></p>		
                                </div>
                                <div class="col-6">
                                    <span class="badge badge-warning p-2 mr-4" style="float: right; text-transform: capitalize;" id="Modelstatus"></span>                                        
                                </div>
                            </div>
                            <p id="Modeldescription" class="mt-2"></p>
                            <div class="single-product-form">					
                                <p class="mb-0" id="Modelcategory"></p>
                            </div>
                            <p class="mt-1 mb-1" id="Modelis_available"></p>
                            <p class="mt-1 mb-1" id="Modelis_featured"></p>
                            <p id="Modeldelivery_time"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
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
        var check = 0;
        <?php
    foreach ($restaurantProducts as $item) {
    ?>
        $('#addcart<?php echo $item->id; ?>').click(function() {
            check = 1;
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
					title: 'Please Login First',
					showConfirmButton: false,
					timer: 3000
				});
            <?php } ?>
        });
        <?php } ?>
		$('.detail').click(function (e){
            var data = JSON.parse($(this).attr('data-id'));
            console.log('data');
            console.log(data);
            if(data){
                var baseUrl = window.location.origin;
                $("#Modelname").html(data.name);
                $("#Modelprice").html('<b>£</b> '+data.price);
                $("#Modeldescription").html(data.description);      
                $("#Modelrestaurant_id").html(data.restaurant_id);
                $("#Modelstatus").html(data.status);
                $("#Modelcategory").html('<b>Category:</b> '+data.category.name); 
                if(data.is_available == 1 && data.is_featured == 1){
                    $("#Modelis_available").html(' <b>Available: </b><i class="fa fa-check-circle text-info-300 mr-3" style="color:#3dbf3d"></i> <b>Featured: </b><i class="fa fa-check-circle text-info-300" style="color:#3dbf3d"></i>');    
                }
                else if(data.is_available == 1){
                    $("#Modelis_available").html('<b>Available: </b><i class="fa fa-check-circle text-info-300" style="color:#3dbf3d"></i>');    
                }
                else if(data.is_featured == 1){
                    $("#Modelis_featured").html('<b>Featured: </b><i class="fa fa-check-circle text-info-300" style="color:#3dbf3d"></i>');    
                }
                $("#Modeldelivery_time").html(' <b> Delivery Time: </b> '+data.delivery_time+' minutes <i class="fas fa-clock text-info-300"></i>');     
                $("#ModelimageBox").html("<img class='product-img embed-responsive' src=\"" + baseUrl+'/'+data.images + "\">");                          
                if(check == 0){
                    $('#exampleModalCenter').modal('show');
                }          
                check = 0;
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!',
                });
            }
	});
    });
</script>

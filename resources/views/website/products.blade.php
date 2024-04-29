@extends('website.layouts.app')
@section('title','Restaurant Detail')
@section('content')
<style>
.zoom {
  transition: transform .6s; /* Animation */
}

.zoom:hover {
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
.breadcrumb-bgg {
    background-image: url("{{ asset('website/assets/img/bg1141.jpg') }}"); /* Replace 'your-image-path.jpg' with the path to your background image */
    background-size: cover; /* Adjust as needed, 'cover' makes the image cover the entire container */
    background-position: center; /* Adjust as needed, 'center' centers the image horizontally and vertically */
    background-repeat: no-repeat; /* Prevent the background image from repeating */
}
</style>
<div class="breadcrumb-section breadcrumb-bgg">
	<div class="container">
		<div class="row py-4">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1 style="text-transform: capitalize;">All Products</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-filters">
					<ul>
						<?php $static = 999; ?>
						<li class="active CatClick" data-id={{$static}} data-filter="*">All</li>
						@foreach($foodCategory as $category)
							<li class="CatClick" data-id="{{$category['id']}}" data-filter=".{{ $category['id'] }}">{{ $category['name'] }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="row product-lists">
			@foreach($products as $data)
				<div class="col-lg-4 col-md-6 text-center {{$data['category_id']}}">
					<a data-id="{{json_encode($data)}}" class="detail">
						<div class="single-product-item h-100 zoom">
							<div class="product-image">
								<img src="{{asset($data->images)}}" alt="">
							</div>
							<h3 class="mb-0" style="font-weight: 500; text-transform: capitalize;">{{$data->name}}</h3>
							<h6 style="font-weight: 500; text-transform: capitalize;">{{$data->category->name}}</h6>
							<p class="product-price"> £{{$data->price}} </p>
							<button type="button" role="button" id="addcart{{$data->id}}" class="boxed-btn">Add to Cart <i class="fas fa-shopping-cart"></i></button>
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

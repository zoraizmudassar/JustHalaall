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
/*--------------------------------
Menu Page
-----------------------------------*/

.menu-section {
  margin: 0 auto;
  display: block;
  width: 100%;
  max-width: 1200px;
  padding-top:5px;
}

.menu-list {
  float: left;
  /* width: 49%; */
  margin-right: 10px;
  padding-bottom:25px;
}

.page-template-menu-template .interior-cta-background {
  display: inline-block;
  width: 100%;
  background: #ccc;
  text-align: center;
  margin-top: -114px;
  padding: 150px 30px;
  background-repeat: no-repeat;
  color: #ffffff;
  background-size: cover;
  background-position: center center;
}

.page-template-menu-template .site-header li a {
  color: #fff;
}

.menu-list hr {
  margin: 36px 0
}

.menu-list span.dots {
  position: absolute;
  top: 12px;
  left: 0;
  right: 0;
  z-index: 1;
  margin: 0;
  border: 0;
  height: 3px;
  display: block;
  background-image: radial-gradient(circle closest-side, #b3b3b3 99%, transparent 1%);
  background-position: bottom;
  background-size: 6px 3px;
  background-repeat: repeat-x
}

.menu-list__title {
  text-align: left;
  text-transform: uppercase;
  letter-spacing: 1.85px;
  font-weight: 600;
}

.menu-list__item {
  position: relative;
  margin-bottom: 30px;
  list-style: none;
}

.menu-list__item:last-child {
  margin-bottom: 0
}

.menu-list__item-title {
  position: relative;
  margin-top: 0;
  margin-bottom: 5px;
  padding-right: 96px;
  text-align: left;
  letter-spacing: 1.25px;
}

.menu-list__item-title .item_title {
  position: relative;
  z-index: 5;
  background-color: white;
  font-size: 20px;
  font-weight: 600;
  text-transform: uppercase;
}

p.menu-list__item-desc {
  position: relative;
  margin-bottom: 0;
  text-align: left
}

p.menu-list__item-desc+span.dots {
  display: none
}

.desc__content {
  position: relative;
  z-index: 5;
  background-color: white
}

.menu-list__item-price {
  position: absolute;
  top: -2px;
  right: 0;
  z-index: 1;
  max-width: 96px;
  background-color: white;
  font-size: 19px;
  font-size: 1.1875rem;
  line-height: 1.27316;
  font-weight: bold;
  /* font-size: 15px; */
}

.menu-list__item-price p {
  color: #e3b379;
  font-size: 17px;
  font-family: 'Source Sans Pro', Arial;
}

.menu-list__item-highlight-title {
  position: absolute;
  top: -38px;
  left: -18px;
  padding: 0 18px;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.250em;
  color: white;
  background-color: #c59d5f
}

.menu-list__item-highlight-wrapper {
  margin-top: 54px;
  margin-bottom: 38px
}

.menu-list__item-highlight-wrapper:before {
  content: '';
  position: absolute;
  top: -18px;
  left: -18px;
  right: -18px;
  bottom: -18px;
  border: 2px solid #c59d5f
}

@media(max-width:1000px) {
  .menu-list {
    display:block;
    margin:0 auto;
    float: none;
    width: 100%;
    max-width:95%;
  }
}
</style>
<div class="breadcrumb-section breadcrumb-bgg">
	<div class="container">
		<div class="row py-4">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1 style="text-transform: capitalize;">About {{$restaurantDetail[0]->name}}</h1>
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="boxed-btn mt-2">Restaurant Menu  <i class="fas fa fa-bars"></i></button>
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
                    @if($timer == 1)
					<h5 class="text-uppercase mt-1">Closed until {{$end_timer}}</h5>
                    @else
					<h5 class="text-uppercase mt-1">Closed</h5>
                    @endif
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
                    @if($timer == 1)
					    <button type="button" role="button" id="addcart{{$data->id}}" class="boxed-btn">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                    @endif
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restaurant Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="interior-section-two menu-section">
                    <div class="menu-list menu-list__dotted menu-list-1">
                        <h4 class="text-center mb-0" style="text-transform: capitalize;">Embark on a Culinary Journey with Our Exquisite Array of Delicious Menu Offerings</h4>
                        <hr style="margin: 20px 0;">
                        <ul class="menu-list__items">
                            @foreach($restaurantProducts as $index => $data)
                                @if($index % 2 == 0)
                                    <div class="row">
                                @endif
                                    <div class="col-6">
                                        <li class="menu-list__item">
                                            <h4 class="menu-list__item-title">
                                                <span class="item_title">{{$data['name']}}</span>
                                                <span class="dots"></span>
                                            </h4>
                                            <p class="menu-list__item-desc">
                                                <span class="desc__content"></span></p><p>{{$data['description']}}</p>
                                                <p></p> 
                                                <span class="dots"></span>
                                                <span class="menu-list__item-price"><p>£ {{$data['price']}}</p>
                                            </span>
                                        </li>
                                    </div>
                                @if(($index + 1) % 2 == 0 || $loop->last)
                                    </div>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

@extends('website.layouts.app')
@section('title','Cart')
@section('content')
@section('style')
<style>
	.qty, .submit{
		position: relative;
		z-index: 1;
		display: inline-block;
		height: 3em;
		padding: 1em;
		line-height: 1em;
		text-align: center;
		border-radius: .6em;
		background: #ccc;
	}
	input.qty{
		z-index: 2;
		width: 3em;
		padding: 0;
		height: 3.28em;
		border: .15em solid #fff;
	}
	.qty-minus{
		margin-right: -1em;
		padding: 1em 1.2em 1em .8em;
		cursor: pointer;
	}
	.qty-plus{
		margin-left: -1em;
		padding: 1em .8em 1em 1.2em;
		cursor: pointer;
	}
	.submit{
		margin-left: 1em;
		border: none;
		background: #c44034;
		color: #fff;
	}
	input::-webkit-inner-spin-button{
		display: none;
		margin: 0;
	}
	.steps .step {
    	display: block;
    	width: 100%;
    	margin-bottom: 35px;
    	text-align: center
	}
	.steps .step .step-icon-wrap {
		display: block;
		position: relative;
		width: 100%;
		height: 80px;
		text-align: center
	}
	.steps .step .step-icon-wrap::before,
	.steps .step .step-icon-wrap::after {
		display: block;
		position: absolute;
		top: 50%;
		width: 50%;
		height: 3px;
		margin-top: -1px;
		background-color: #e1e7ec;
		content: '';
		z-index: 1
	}
	.steps .step .step-icon-wrap::before {
		left: 0
	}
	.steps .step .step-icon-wrap::after {
		right: 0
	}
	.steps .step .step-icon {
		display: inline-block;
		position: relative;
		width: 80px;
		height: 80px;
		border: 1px solid #e1e7ec;
		border-radius: 50%;
		background-color: #ffffff;
		color: #374250;
		font-size: 38px;
		line-height: 81px;
		z-index: 5
	}
	.steps .step .step-title {
		margin-top: 16px;
		margin-bottom: 0;
		color: #606975;
		font-size: 14px;
		font-weight: 500
	}
	.steps .step:first-child .step-icon-wrap::before {
		display: none
	}
	.steps .step:last-child .step-icon-wrap::after {
		display: none
	}
	.steps .step.completed .step-icon-wrap::before,
	.steps .step.completed .step-icon-wrap::after {
		background-color: #d3d3d3
	}
	.steps .step.completed .step-icon {
		/* border-color: #6b6b6b; */    
		/* background-color: #0da9ef; */
		color: #fff
	}
	@media (max-width: 576px) {
		.flex-sm-nowrap .step .step-icon-wrap::before,
		.flex-sm-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	@media (max-width: 768px) {
		.flex-md-nowrap .step .step-icon-wrap::before,
		.flex-md-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	@media (max-width: 991px) {
		.flex-lg-nowrap .step .step-icon-wrap::before,
		.flex-lg-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	@media (max-width: 1200px) {
		.flex-xl-nowrap .step .step-icon-wrap::before,
		.flex-xl-nowrap .step .step-icon-wrap::after {
			display: none
		}
	}
	.bg-faded, .bg-secondary {
		background-color: #f5f5f5 !important;
	}
	.breadcrumb-bgg {
		background-image: url('website/assets/img/bg2.jpg'); /* Replace 'your-image-path.jpg' with the path to your background image */
		background-size: cover; /* Adjust as needed, 'cover' makes the image cover the entire container */
		background-position: center; /* Adjust as needed, 'center' centers the image horizontally and vertically */
		background-repeat: no-repeat; /* Prevent the background image from repeating */
	}
</style>
@endsection
<div class="breadcrumb-section breadcrumb-bg breadcrumb-bgg">
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
<div class="single-product mt-100 mb-100">
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="overflow-x:auto;">
				@if(count($orders) > 0)
					<button role="button" id="detail111" class="boxed-btn mb-3 px-5 float-right">Clear History <i class="fas fa-trash ml-1"></i> </button>
				@endif
				<table class="table table-hover text-center" style="text-transform: capitalize; cursor: pointer;">
					<thead>
						<tr>
							<th scope="col">Order No</th>
							<th scope="col">Item</th>
							<th scope="col">Restaurant</th>
							<th scope="col">Total</th>
							<th scope="col">Status</th>
							<th scope="col">Location</th>
							<th scope="col">Order Place Date</th>
							<th scope="col">Detail</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $res)
							<tr>
								<td style="vertical-align: middle;">{{$res->order_no}}</td>
								<td style="vertical-align: middle;">{{$res->orderDetails->product_name->name}}</td>    
								<td style="vertical-align: middle;">{{$res->orderDetails->restaurant_name->name}}</td>    
								<td style="vertical-align: middle;"><b>£</b> {{$res->total}}</td>   
								<td class="text-capitalize">
									@if($res->status == 'preparing')
									<span class="badge badge-warning p-2">{{$res->status}}</span>
									@elseif($res->status == 'pending')
									<span class="badge badge-warning p-2">{{$res->status}}</span>
									@elseif($res->status == 'accepted')
									<span class="badge badge-success p-2">{{$res->status}}</span>
									@elseif($res->status == 'complete')
									<span class="badge badge-success p-2">{{$res->status}}</span>
									@elseif($res->status == 'rejected')
									<span class="badge badge-danger p-2">{{$res->status}}</span>
									@elseif($res->status == 'make order on way')
									<span class="badge badge-primary p-2">{{$res->status}}</span>
									@else
									<span class="badge badge-dark p-2">{{$res->status}}</span>
									@endif
								</td>     
								<td style="vertical-align: middle;">{{$res->address}}</td>                         

								<td style="vertical-align: middle;">{{$res->created_at->toFormattedDateString()}}</td>
								<td style="vertical-align: middle;">
									<a data-id="{{$res}}" class="detail"><button type="button" class="btn btn-secondary py-2 px-2 rounded-circle"><i style="margin-left: 1px; margin-right: 1px; margin-top: 2px; margin-bottom: 2px;" class="fas fa-eye"></i></button></a>
									<a data-id="{{$res}}" class="detai2"><button type="button" class="btn btn-info py-2 px-2 rounded-circle"><i style="margin-top: 2px; margin-bottom: 2px;" class="fas fa-shipping-fast"></i></button></a>
									<a data-id="{{$res->id}}" class="detail1"><button type="button" class="btn btn-danger py-2 rounded-circle"><i style="margin-top: 2px; margin-bottom: 2px;" class="fas fa-file-pdf"></i></button></a>
								</td>
							</tr>
						@endforeach
						@if(count($orders) <= 0)
						<tr>
							<td colspan="8" style="text-align: center;">No Order Found</td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>			
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
					<div class="col-md-3">
						<p class="mb-1" style="text-transform: capitalize;"><b>Name</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Total</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Status</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Address</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Order Date & Time</b></p>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-1" style="text-transform: capitalize;" id="Modelname"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="Modeltotal"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="Modelstatus"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="Modellocation"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="Modelorderdate"></p>
                    </div>
					<div class="col-md-3">
						<p class="mb-1" style="text-transform: capitalize;"><b>Discount</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Payment Status</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Delivery Charges</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Quantity</b></p>
						<p class="mb-1" style="text-transform: capitalize;"><b>Restaurant Name</b></p>
                    </div>
					<div class="col-md-3">
                        <p class="mb-1" style="text-transform: capitalize;" id="Modeldiscount"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="ModelpaymentStatus"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="ModeldeliveryCharges"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="Modelquantity"></p>
                        <p class="mb-1" style="text-transform: capitalize;" id="Modelrestaurant_name"></p>
                    </div>
					<div class="col-md-4" hidden>
                        <div class="single-product-img" id="ModelimageBox">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Track Your Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div className="main_container">
					<div class="container padding-bottom-3x mb-1">
						<div class="card mb-3">
							<div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-capitalize">Tracking Order No - </span><span id="textMedium" class="text-medium"></span>
							</div>
							<div class="card-body">
								<div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-5x padding-bottom-1x my-5">
									<div class="step completed mb-0">
										<div class="step-icon-wrap">
											<div id="stepIcon1" class="step-icon">
												<img id="pending1" src="uploads/hourglass.gif" alt="" class="mt-3" style="max-width: 70%;">
												<img id="pending2" src="uploads/remove_hour.png" alt="" class="mt-3" style="max-width: 70%; opacity: 0.2;">
											</div>
										</div>
										<h4 id="pending3" class="step-title">Pending</h4>
									</div>
									<div class="step completed mb-0">
										<div class="step-icon-wrap">
											<div id="stepIcon2" class="step-icon">
												<img id="accepted1" src="uploads/giphy1.gif" alt="" class="mt-3" style="max-width: 70%;">
												<img id="accepted2" src="uploads/remove_check.png" alt="" class="mt-3" style="max-width: 70%; opacity: 0.2;">
											</div>
										</div>
										<h4 id="accepted3" class="step-title">Accepted</h4>
									</div>
									<div class="step completed mb-0">
										<div class="step-icon-wrap">
											<div id="stepIcon3" class="step-icon">
												<img id="preparing1" src="uploads/loading.gif" alt="" style="max-width: 100%;">
												<img id="preparing2" src="uploads/remove_cook.png" class="mt-2" alt="" style="max-width: 100%; opacity: 0.2;">
											</div>
										</div>
										<h4 id="preparing3" class="step-title">Preparing</h4>
									</div>
									<div class="step completed mb-0">
										<div class="step-icon-wrap">
											<div id="stepIcon4" class="step-icon">
												<img id="delivery1" src="uploads/boy.gif" alt="" class="mt-0" style="margin-left: -12px; max-width: 135%;">
												<img id="delivery2" src="uploads/remove_bike.png" alt="" style="margin-top: -8px; margin-left: -12px; max-width: 135%; opacity: 0.2;">
											</div>
										</div>
										<h4 id="delivery3" class="step-title">Out for Delivery</h4>
									</div>
									<div class="step completed mb-0">
										<div class="step-icon-wrap">
											<div id="stepIcon5" class="step-icon">
												<img id="completed1" src="uploads/circle.png" alt="" style="max-width: 100%;">
												<img id="completed2" src="uploads/circle.png" alt="" style="max-width: 100%; opacity: 0.2;">
											</div>
										</div>
										<h4 id="completed3" class="step-title">Completed</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
jQuery( document ).ready(function() {
    $('form input').focus(function(){
		$(this).siblings(".displayBadges").fadeOut(1500);
    });
	$('.detail').click(function (e){
		var data = JSON.parse($(this).attr('data-id'));
		console.log('data');
		console.log(data);
		if(data){
			var baseUrl = window.location.origin;
			$("#exampleModalCenterTitle").html('Order No - '+data.order_no);
			$("#Modelname").html(data.order_details.product_name.name);                         
			$("#Modeltotal").html('£ '+data.total);          
			$("#Modelstatus").html(data.status);                         
			$("#Modellocation").html(data.address);                         
			$("#Modelorderdate").html(data.order_place_date);                         
			$("#Modeldiscount").html(data.discount);       
			$("#ModelpaymentStatus").html(data.order_details.payment_status);
			$("#ModeldeliveryCharges").html(data.order_details.delivery_charges);
			$("#Modelquantity").html(data.order_details.quantity);  
			$("#Modelrestaurant_name").html(data.order_details.restaurant_name.name);  						     						                  
			$("#ModelimageBox").html("<img class='mx-auto product-img embed-responsive' src=\"" + baseUrl+'/'+data.order_details.product_name.images + "\">");    
			$('#exampleModalCenter').modal('show');
		}
		else{
			Swal.fire({
				icon: 'error',
				title: 'Something went wrong!',
			});
		}
	});
	$('.detai2').click(function (e){
		$("#pending1").hide();
		$("#pending2").hide();
		$("#accepted1").hide();
		$("#accepted2").hide();				
		$("#pending3").css({"font-weight": "",  "font-size": ""});
		$("#accepted3").css({"font-weight": "",  "font-size": ""});				
		$("#preparing3").css({"font-weight": "",  "font-size": ""});				
		$("#delivery3").css({"font-weight": "",  "font-size": ""});				
		$("#completed3").css({"font-weight": "",  "font-size": ""});				
		$("#preparing1").hide();
		$("#preparing2").hide();
		$("#delivery1").hide();
		$("#delivery2").hide();
		$("#completed1").hide();
		$("#completed2").hide();
		$("#stepIcon1").css("border", "");	
		$("#stepIcon2").css("border", "");	
		$("#stepIcon3").css("border", "");	
		$("#stepIcon4").css("border", "");	
		$("#stepIcon5").css("border", "");	
		var data = JSON.parse($(this).attr('data-id'));
		console.log('data');
		console.log(data);
		if(data){
			var baseUrl = window.location.origin;
			$("#textMedium").html(data.order_no);   
			if(data.status == 'pending'){
				$("#pending1").show();
				$("#pending2").hide();
				$("#accepted1").hide();
				$("#accepted2").show();				
				$("#pending3").css({"font-weight": "600",  "font-size": "medium"});				
				$("#preparing1").hide();
				$("#preparing2").show();
				$("#delivery1").hide();
				$("#delivery2").show();
				$("#completed1").hide();
				$("#completed2").show();
				$("#stepIcon1").css("border", "2px solid #6b6b6b");	
			} else if(data.status == 'preparing'){
				$("#pending1").hide();
				$("#pending2").show();
				$("#accepted1").hide();
				$("#accepted2").show();				
				$("#preparing1").show();
				$("#preparing2").hide();
				$("#preparing3").css({"font-weight": "600",  "font-size": "medium"});				
				$("#delivery1").hide();
				$("#delivery2").show();
				$("#completed1").hide();
				$("#completed2").show();
				$("#stepIcon3").css("border", "2px solid #6b6b6b");	
			} else if(data.status == 'accepted'){
				$("#pending1").hide();
				$("#pending2").show();
				$("#accepted1").show();
				$("#accepted2").hide();				
				$("#accepted3").css({"font-weight": "600",  "font-size": "medium"});				
				$("#preparing1").hide();
				$("#preparing2").show();
				$("#delivery1").hide();
				$("#delivery2").show();
				$("#completed1").hide();
				$("#completed2").show();
				$("#stepIcon2").css("border", "2px solid #6b6b6b");	
			} else if(data.status == 'make order on way'){
				$("#pending1").hide();
				$("#pending2").show();
				$("#accepted1").hide();
				$("#accepted2").show();				
				$("#preparing1").hide();
				$("#preparing2").show();
				$("#delivery1").show();
				$("#delivery2").hide();
				$("#delivery3").css({"font-weight": "600",  "font-size": "medium"});				
				$("#completed1").hide();
				$("#completed2").show();
				$("#stepIcon4").css("border", "2px solid #6b6b6b");	
			} else if(data.status == 'complete'){
				$("#pending1").hide();
				$("#pending2").show();
				$("#accepted1").hide();
				$("#accepted2").show();				
				$("#preparing1").hide();
				$("#preparing2").show();
				$("#delivery1").hide();
				$("#delivery2").show();
				$("#completed1").show();
				$("#completed2").hide();
				$("#completed3").css({"font-weight": "600",  "font-size": "medium"});		
				$("#stepIcon5").css("border", "2px solid #6b6b6b");	
			} else {
				$("#pending1").hide();
				$("#pending2").show();
				$("#accepted1").hide();
				$("#accepted2").show();				
				$("#preparing1").hide();
				$("#preparing2").show();
				$("#delivery1").hide();
				$("#delivery2").show();
				$("#completed1").hide();
				$("#completed2").show();
			}		
			$('#exampleModalCenter1').modal('show');
		}
		else{
			Swal.fire({
				icon: 'error',
				title: 'Something went wrong!',
			});
		}
	});
	$('.detail1').click(function (e){
		var data = JSON.parse($(this).attr('data-id'));
		$.ajax({
                type: 'GET',
                url: 'userOrderPdf/'+data,
                dataType: "json",
                success: function(data){
                    if(data == 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Job Order Delete Successfully!',
                        });
                        location.reload();
                    }
                    else if(data == 400){
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                        });
                    }
                }
            })
	});
	$('#detail111').click(function() {
		$.ajax({
                type: 'GET',
                url: 'clearOrderHistory/',
                dataType: "json",
                success: function(data){
                    if(data.status == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'Order History Deleted Successfully!',
							timer: 2000,
  							timerProgressBar: true,
                        });
						setTimeout(() => {
							location.reload();
						}, 2000);
                    }
                    else if(data.status == false){
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                        });
                    }
                }
            })
	})
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
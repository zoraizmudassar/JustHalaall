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
</style>
@endsection
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
<div class="single-product mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover text-center" style="text-transform: capitalize;">
					<thead>
						<tr>
							<th scope="col">Order Id</th>
							<th scope="col">Item</th>
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
								<td style="vertical-align: middle;">£ {{$res->total}}</td>   
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
									<a data-id="{{$res}}" class="detail"><button type="button" class="btn btn-info py-2"><i class="fas fa-eye"></i></button></a>
									<a data-id="{{$res->id}}" class="detail1"><button type="button" class="btn btn-info py-2"><i class="fas fa-file-pdf"></i></button></a>
								</td>
							</tr>
						@endforeach
						@if(count($orders) <= 0)
						<tr>
							<td colspan="7" style="text-align: center;">No Order Found!</td>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
			$("#exampleModalCenterTitle").html(data.order_no);
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
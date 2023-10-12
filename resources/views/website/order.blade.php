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
								<th scope="col">Order No</th>
								<th scope="col">Restaurant</th>
								<th scope="col">Payment Type</th>
								<th scope="col">Total</th>
								<th scope="col">Restaurant Status</th>
								<th scope="col">Date</th>
							</tr>
						</thead>
            			<tbody>
							@foreach($orders as $order)
							<tr>
								<th scope="row">{{$order['order_no']}}</th>
								<td>-</td>
								<td>{{$order['orderDetails']['payment_id']}}</td>
								<td>£ {{$order['total']}}</td>
								<td><span class="badge badge-warning p-2">{{$order['status']}}</span></td>
								<?php 
									$timestamp = strtotime($order['order_place_date']);
									$newFormat = date("d M Y", $timestamp); 
								?>
								<td>{{$newFormat}}</td>
							</tr>
							@endforeach
							@if(count($orders) <= 0)
							<tr>
								<td colspan="6" style="text-align: center;">No Order Found!</td>
							</tr>
							@endif
						</tbody>
					</table>
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
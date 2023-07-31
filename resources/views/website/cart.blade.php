@extends('website.layouts.app')
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
					<h1>Cart</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="cart-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="cart-table-wrap">
					<table class="cart-table">
						<thead class="cart-table-head">
							<tr class="table-head-row">
								<th class="product-image">Product Image</th>
								<th class="product-name">Name</th>
								<th class="product-price">Price</th>
								<th class="product-quantity">Quantity</th>
								<th class="product-total">Total</th>
								<th class="product-total">Remove</th>
							</tr>
						</thead>
						<tbody>
							@if($cartData)
                                @foreach($cartData as $key => $cart)
									<tr class="table-body-row">									
										<td class="product-image"><img src="{{asset($cart->product->images ?? '')}}" alt=""></td>
										<td class="product-name">{{$cart->product->name ?? ''}}</td>
										<td class="product-price">{{$cart['unit_price'] ?? ''}}</td>
										<td class="quantity-box">
                                            <form action="{{url('update-cartv1/'.$cart->id)}}" method="POST">
                                                @csrf
                                                <div class="qty qty-minus" onclick="decreaseQty('cartQty{{$cart->id}}')">-</div>
                                                <input id="cartQty{{$cart->id}}" name="qty" class="qty" type="number" value="{{ $cart['quantity'] ?? '' }}" min="1" size="1">
                                                <div class="qty qty-plus" onclick="increaseQty('cartQty{{$cart->id}}')">+</div>
                                                <button type="submit" style="border: 2px solid; color: #fd7050; margin-left: 10px; height: 47px; border-radius: 8px;"><i class="fa fa-check"></i></button>
                                            </form>
                                        </td>
										<td class="product-total">£ {{$cart['unit_price'] * $cart['quantity']}}</td>
										<td class="remove-pr">
                                            <a href="{{'remove-itemv1/' . $cart->id}}"><i class="fas fa-times text-dark"></i></a>
                                        </td>
									</tr>
								@endforeach
                            @endif
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="total-section">
					<table class="total-table">
						<thead class="total-table-head">
							<tr class="table-total-row">
								<th>Total</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
							<tr class="total-data">
								<td><strong>Total Item: </strong></td>
								<td>{{$totalItem}}</td>
							</tr>
							<tr class="total-data">
								<td><strong>Sub Total: </strong></td>
								<td>£ {{$cartSum}} </td>
							</tr>
							<tr class="total-data">
								<td><strong>Grand Total: </strong></td>
								<td>£ {{$cartSum}}</td>
							</tr>
						</tbody>
					</table>
					<div class="cart-buttons">
						<a href="{{'checkoutv1'}}" class="boxed-btn black float-right">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script>
	function increaseQty(qtyId){
		console.log("increaseQty");
		console.log(qtyId);
		var location = document.getElementById(qtyId);
		var currentQty = location.value;
		var qty = Number(currentQty) + 1;
		location.value = qty;
	}
	function decreaseQty(qtyId){
		console.log("decreaseQty");
		console.log(qtyId);
		var location = document.getElementById(qtyId);
		var currentQty = location.value;
		if(currentQty > 1){
			var qty = Number(currentQty) - 1;
			location.value = qty;
		}
	}
</script>
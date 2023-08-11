@extends('website.layouts.app')
@section('title','Checkout')
@section('content')
<style>
.breadcrumb-bg {
  	background-image: url(website/assets/img/breadcrumb-bg.jpg);
}
</style>
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Fresh and Organic</p>
					<h1>Check Out Product</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="checkout-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="checkout-accordion-wrap">
					<div class="accordion" id="accordionExample">
						<div class="card single-accordion">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Billing Address
								</button>
								</h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<div class="billing-address-form">
										<form action="index.html">
											<p>
												<input type="text" placeholder="Name" value="{{ Auth()->user()->name ?? old('name') }}">
											</p>
											<p>
												<input type="email" placeholder="Email"  value="{{ Auth()->user()->email ?? old('email') }}">
											</p>
											<p>
												<input type="tel" placeholder="Phone" value="{{ Auth()->user()->phone ?? old('address') }}">
											</p>
											<p>
												<input type="text" placeholder="Address" value="{{ Auth()->user()->address ?? old('address') }}">
											</p>
											<p>
												<input type="text" placeholder="Address 2 (optional)">
											</p>
											<div class="row">
												<div class="col-4">
													<p>
														<input type="text" placeholder="Country">
													</p>
												</div>
												<div class="col-4">
													<p>
														<input type="text" placeholder="State">
													</p>
												</div>
												<div class="col-4">
													<p>
														<input type="text" placeholder="Zip">
													</p>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="card single-accordion">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Shopping Cart
								</button>
								</h5>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
								<div class="card-body">
									<div class="shipping-address-form">
										<div class="rounded p-2 bg-light">
                                    		@foreach ($cart as $item)
                                        		<div class="media mb-2 border-bottom">
                                            		<div class="media-body"> 
														<a href="#" class="text-dark" style="font-weight: 600; text-transform: capitalize; font-size: medium;">{{$item->product->name ?? '' }}</a>
                                                		<div class="small text-muted" style="font-size: 100%; font-weight: 500;">Price: £ {{ $item->unit_price ?? '' }} 
															<span class="mx-2">|</span> Qty: {{ $item->quantity ?? '' }} 
															<span class="mx-2">|</span> Subtotal: £ {{ $item->quantity * $item->unit_price }}
														</div>
                                            		</div>
                                        		</div>
                                    		@endforeach
                                		</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card single-accordion">
							<div class="card-header" id="headingThree">
								<h5 class="mb-0">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Card Details
									</button>
								</h5>
							</div>
							<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
								<div class="card-body">
									<div class="card-details">
										<p>Your card details goes here.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="order-details-wrap">
					<table class="order-details">
						<thead>
							<tr>
								<th><b>Your order Details</b></th>
								<th><b>Price</b></th>
							</tr>
						</thead>
						<tbody class="order-details-body">
							<tr>
								<td>Sub Total (£)</td>
								<td>{{$cartSum}}</td>
							</tr>
							<tr>
								<td>Discount (£)</td>
								<td>0.00</td>
							</tr>
							<tr>
								<td>Coupon Discount (£)</td>
								<td>0.00</td>
							</tr>
							<tr>
								<td>Tax (£)</td>
								<td>0.00</td>
							</tr>
						</tbody>
						<tbody class="checkout-details">
							<tr>
								<td>Shipping Cost (£)</td>
								<td>0.00</td>
							</tr>
							<tr>
								<td><b>Grand Total (£)</b></td>
								<td><b>{{$cartSum}}</b></td>
							</tr>
						</tbody>
					</table>
					<a href="#" class="boxed-btn">Place Order</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

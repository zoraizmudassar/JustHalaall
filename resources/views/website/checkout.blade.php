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
			<div class="col-lg-8 col-md-12 col-sm-12">
				<div class="checkout-accordion-wrap">
					<div class="accordion billing-address-form" id="accordionExample">
						<form action="{{ route('Checkout') }}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form" role="form">
							@csrf
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
											<p>
												<input type="text" name="name" placeholder="Name" value="{{ Auth()->user()->name ?? old('name') }}">
											</p>
											<p>
												<input type="email" name="email" placeholder="Email"  value="{{ Auth()->user()->email ?? old('email') }}">
											</p>
											<p>
												<input type="tel" name="phone" placeholder="Phone" value="{{ Auth()->user()->phone ?? old('address') }}">
											</p>
											<p>
												<input type="text" name="address" placeholder="Address" value="{{ Auth()->user()->address ?? old('address') }}">
											</p>
											<p>
												<input type="text" name="address2" placeholder="Address 2 (optional)">
											</p>
											<div class="row">
												<div class="col-4">
													<p>
														<input type="text" name="country" placeholder="Country">
													</p>
												</div>
												<div class="col-4">
													<p>
														<input type="text" name="state" placeholder="State">
													</p>
												</div>
												<div class="col-4">
													<p>
														<input type="text" name="zipcode" placeholder="Zip">
													</p>
												</div>
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
											<div class="d-block my-3">
                                 				<!-- <div class="custom-control custom-radio">
                                    				<input id="credit" name="paymentMethod" type="radio" value="cod" class="custom-control-input" checked required>
                                    				<label class="custom-control-label" for="credit">Cash on delivery</label>
                                				</div>  -->
                                				<div class="custom-control custom-radio">
                                    				<input id="debit" name="paymentMethod" type="radio" value="card" class="custom-control-input" checked required>
													<label class="custom-control-label" for="debit">Online Payment / Credit Card</label>
												</div>
												<div hidden class="custom-control custom-radio">
													<input id="paypal" name="paymentMethod" type="radio" value="paypal" class="custom-control-input" required>
													<label class="custom-control-label" for="paypal">Paypal</label>
												</div> 
											</div>
										</div>
										<div class="row" id="show_hide">
                            				<div class="col-md-12">
                                				<hr class="mb-4">
                            					<div hidden class="title" style="font-weight:bold;"> 
													<span>Payment</span> 
												</div>
                            				</div>
                                			<div class="col-md-6 mb-3">
                                    			<label for="cc-name">Name on card</label>
                                    			<input type="text" class="form-control" name="card_name" id="card_name" placeholder="Card Name">
                                    			@if($errors->has('card_name'))
                    								<div class="invalid-feedback">
														{{ $errors->first('card_name') }}
													</div>
                								@endif
                                			</div>
											<div class="col-md-6 mb-3">
												<label for="cc-number">Credit card number <small><b>(16 digits)</b></small></label>
												<input type="text" class="form-control card-number" id="number" name="number" placeholder="Card Number">
												@if($errors->has('number'))
													<div class="invalid-feedback">
														{{ $errors->first('number') }}
													</div>
												@endif
											</div>
											<div class="col-md-4 mb-3">
												<label for="cc-expiration">Expiration Month <small> <b> (Format: 02) </b> </small></label>
												<input type="text" class="form-control card-expiry-month" id="exp_month" name="exp_month" placeholder="Expiry Month ex.12">
												<!-- <input type='date' class="form-control" placeholder="Phone No" name="expiryDate" id="expiryDate" style="width: 100%;" required> -->
												@if($errors->has('exp_month'))
													<div class="invalid-feedback">
														{{ $errors->first('exp_month') }}
													</div>
												@endif
											</div>
											<div class="col-md-4 mb-3">
												<label for="cc-expiration">Expiration Year <small><b>(Format: 2024)</b></small></label>
												<input type="text" class="form-control card-expiry-year" id="exp_year" name="exp_year" placeholder="Expiry Year ex.2022" >
												@if($errors->has('exp_year'))
													<div class="invalid-feedback">
														{{ $errors->first('exp_year') }}
													</div>
												@endif
                                			</div>
                                			<div class="col-md-4 mb-3">
                                    			<label for="cc-expiration">CVV <small><b> (3 digits)</b></small></label>
                                    			<input type="text" class="form-control card-cvc" id="securityCode" name="ccv" placeholder="CVV">
												@if($errors->has('ccv'))
													<div class="invalid-feedback">
														{{ $errors->first('ccv') }}
													</div>
												@endif
                                			</div>
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
							<button type="submit" id="checkout" class="ml-auto btn hvr-hover boxed-btn w-100">Place Order</button> 
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="order-details-wrap" style="padding: 20px;">
					<table class="order-details w-100">
						<thead>
							<tr>
								<th><b>Your order Details</b></th>
								<th><b>Price</b></th>
							</tr>
						</thead>
						<tbody class="order-details-body">
							<tr>
								<td>Sub Total (£)</td>
								<td>{{number_format($cartSum,2)}}</td>
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
								<td><b>{{number_format($cartSum,2)}}</b></td>
							</tr>
						</tbody>
					</table>
					<a hidden href="#" class="boxed-btn">Place Order</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function(){
        var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e){
                var $form     = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]',
                                'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;
                $errorMessage.addClass('hide');
                var AccHoldernumber = $("#AccHoldernumber").val();
                var securityCode = $("#securityCode").val();

                var date = new Date($('#expiryDate').val()); 
                var month = $('#exp_month').val();
                var year = $('#exp_year').val();
				console.log("date, month, year");
				console.log(month, year);
        
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
                });
        
                if(!$form.data('cc-on-file')){
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: "4111111111111111",
                    cvc: securityCode,
                    exp_month: month,
                    exp_year: year
                }, stripeResponseHandler);
                }
            });
    
    function stripeResponseHandler(status, response){
        if(response.error){
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
            } 
            else{
                var token = response['id'];            
				console.log('token');
				console.log(token);    
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>

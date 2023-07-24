@extends('web.layouts.app')
@section('title', 'Checkout')
@section('style')
    <style>
        .hide {
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        
                        <form action="{{ route('Checkout') }}" method="POST"
                        class="require-validation"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                        id="payment-form" role="form">
                            @csrf
                            <div class='form-row row'>
                                <div class='col-md-12 error form-group d-none'>
                                   <div class='alert-danger alert'>Please correct the errors and try
                                      again.
                                   </div>
                                </div>
                             </div>
                            <div class="mb-3">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Full Name" value="{{ Auth()->user()->name ?? old('name') }}" required>
                                <div class="invalid-feedback"> Valid first name is required. </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email Address" value="{{ Auth()->user()->email ?? old('email') }}"
                                    required>
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Phone *</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Phone no" value="{{ Auth()->user()->phone ?? old('address') }}" required>
                                <div class="invalid-feedback"> Please enter a valid phone no for shipping updates.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Address" value="{{ Auth()->user()->address ?? old('address') }}" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address2">Address 2 (optional)</label>
                                <input type="text" class="form-control" name="address2" id="address2"
                                    placeholder="Second Address (optional)">
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country *</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        placeholder="Country" value="{{ old('country') }}" required>
                                    {{-- <select class="wide w-100" id="country">
                                        <option value="Choose..." data-display="Select">Choose...</option>
                                        <option value="United States">United States</option>
                                    </select> --}}
                                    <div class="invalid-feedback"> Please select a valid country. </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State *</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="State"
                                        value="{{ old('state') }}" required>
                                    {{-- <select class="wide w-100" id="state">
                                        <option data-display="Select">Choose...</option>
                                        <option>California</option>
                                    </select> --}}
                                    <div class="invalid-feedback"> Please provide a valid state. </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" class="form-control" name="zipcode" id="zip" placeholder="Zip Code"
                                        value="{{ old('zipcode') }}" required>
                                    <div class="invalid-feedback"> Zip code required. </div>
                                </div>
                            </div>
                            <!--<hr class="mb-4">-->
                            <!--<div class="custom-control custom-checkbox">-->
                            <!--    <input type="checkbox" class="custom-control-input" id="same-address">-->
                            <!--    <label class="custom-control-label" for="same-address">Shipping address is the same as my-->
                            <!--        billing address</label>-->
                            <!--</div>-->
                            {{-- <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next
                                    time</label>
                            </div> --}}
                            <div class="d-block my-3">
                                {{-- <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" value="cod"
                                        class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Cash on delivery</label>
                                </div> --}}
                                {{--<div class="custom-control custom-radio">
                                    <input id="debit" checked name="paymentMethod" type="radio" value="card"
                                        class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Online Payment/Credit Card</label>
                                </div>--}}
                                {{-- <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" checked type="radio"
                                        class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Online Payment/Credit Card</label>
                                </div> --}}
                                {{-- <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio"
                                        class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div> --}}
                            </div>
                            {{-- id="div-stripe" --}}
                            <div class="row" id="show_hide" style="display:none;">
                            <div class="col-md-12">
                                <hr class="mb-4">
                            <div class="title" style="font-weight:bold;"> <span>Payment</span> </div>
                            </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" name="card_name" placeholder="Card Name">
                                    @if($errors->has('card_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('card_name') }}
                    </div>
                @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control card-number" name="number"
                                        placeholder="Card Number">
                                    @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration Month</label>
                                    <input type="text" class="form-control card-expiry-month" name="exp_month"
                                        placeholder="Expiry Month ex.12">
                                    @if($errors->has('exp_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exp_month') }}
                    </div>
                @endif
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration Year</label>
                                    <input type="text" class="form-control card-expiry-year" name="exp_year"
                                        placeholder="Expiry Year ex.2022" >
                                    @if($errors->has('exp_year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exp_year') }}
                    </div>
                @endif
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="text" class="form-control card-cvc" name="ccv" placeholder="CVV"
                                        >
                                    @if($errors->has('ccv'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ccv') }}
                    </div>
                @endif
                                </div>
                                <div class='form-row row'>
                                    <div class='col-md-12 hide error form-group'>
                                        <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <div class="payment-icon">
                                        <ul>
                                            <li><img class="img-fluid" src="images/payment-icon/1.png" alt="">
                                            </li>
                                            <li><img class="img-fluid" src="images/payment-icon/2.png" alt="">
                                            </li>
                                            <li><img class="img-fluid" src="images/payment-icon/3.png" alt="">
                                            </li>
                                            <li><img class="img-fluid" src="images/payment-icon/5.png" alt="">
                                            </li>
                                            <li><img class="img-fluid" src="images/payment-icon/7.png" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                            <hr class="mb-1">
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="paymentMethod" value="cod"
                                            class="custom-control-input" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Cash on
                                            Delivery</label> 
                                            <!--<span class="float-right font-weight-bold">FREE</span>-->
                                    </div>
                                    <!--<div class="ml-4 mb-2 small">(3-7 business days)</div>-->
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="paymentMethod" value="card"
                                            class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Online Card</label>
                                        <!--<span class="float-right font-weight-bold">£10.00</span>-->
                                    </div>
                                    <!--<div class="ml-4 mb-2 small">(2-4 business days)</div>-->
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="paymentMethod" value="coc"
                                            class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Cash on Collection</label>
                                        <!--<span class="float-right font-weight-bold">£20.00</span>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    @foreach ($cart as $item)
                                        <div class="media mb-2 border-bottom">
                                            <div class="media-body"> <a href="#">
                                                    {{ $item->product->name ?? '' }}</a>
                                                <div class="small text-muted">Price: £{{ $item->unit_price ?? '' }} <span
                                                        class="mx-2">|</span> Qty: {{ $item->quantity ?? '' }} <span
                                                        class="mx-2">|</span> Subtotal:
                                                    £{{ $item->quantity * $item->unit_price }}</div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total (£)</h4>
                                    <div class="ml-auto font-weight-bold"><input type="number" disabled
                                            value="{{ $cartSum }}" id=""
                                            style="    text-align: right;
                                        border: none;
                                        background: none;
                                        font-weight: bold;">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Discount (£)</h4>
                                    <div class="ml-auto font-weight-bold"><input type="number" disabled value="0.00"
                                            id=""
                                            style="    text-align: right;
                                        border: none;
                                        background: none;
                                        font-weight: bold;">
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Coupon Discount (£)</h4>
                                    <div class="ml-auto font-weight-bold"><input type="number" disabled value="0.00"
                                            id=""
                                            style="    text-align: right;
                                        border: none;
                                        background: none;
                                        font-weight: bold;">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Tax (£)</h4>
                                    <div class="ml-auto font-weight-bold"><input type="number" disabled value="0.00"
                                            id=""
                                            style="    text-align: right;
                                        border: none;
                                        background: none;
                                        font-weight: bold;">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost (£)</h4>
                                    <div class="ml-auto font-weight-bold"><input type="number" disabled value="0.00"
                                            id="shipping_charges"
                                            style="    text-align: right;
                                        border: none;
                                        background: none;
                                        font-weight: bold;">
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total (£)</h5>
                                    <div class="ml-auto h5"><input type="number" disabled value="{{ $cartSum }}"
                                            id="shipping_total"
                                            style="    text-align: right;
                                        border: none;
                                        background: none;
                                        font-weight: bold;">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> <button type="submit" id="checkout"
                                class="ml-auto btn hvr-hover">Place Order</button> </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- End Cart -->
@endsection
@section('script')
<script>
$(document).ready(function(){
    $("input[name=paymentMethod]").change(function() {
        var test = $(this).val();
                if(test=='card'){
                $("#show_hide").show();
            }else{
                
        $("#show_hide").hide();
            }
    });
});
    
</script>

@endsection

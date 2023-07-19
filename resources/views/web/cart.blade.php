@extends('web.layouts.app')
@section('title', 'Cart')
@section('style')
<style>
    .qty,
.submit {
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
input.qty {
	z-index: 2;
	width: 3em;
	padding: 0;
	height: 3.28em;
	border: .15em solid #fff;
}
.qty-minus {
	margin-right: -1em;
	padding: 1em 1.2em 1em .8em;
}
.qty-plus {
	margin-left: -1em;
		padding: 1em .8em 1em 1.2em;
}
.submit {
	margin-left: 1em;
	border: none;
	background: #c44034;
	color: #fff;
}
input::-webkit-inner-spin-button {
	display: none;
	margin: 0;
}

</style>
@endsection
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
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
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cartData)
                                    @foreach ($cartData as $key => $cart)
                                        <tr>
                                            <td class="thumbnail-img">
                                                <a href="">
                                                    <img class="img-fluid" src="{{ asset($cart->product->images ?? '') }}"
                                                        alt="" />
                                                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="">
                                                    {{ $cart->product->name ?? '' }}
                                                </a>
                                            </td>
                                            <td class="price-pr">
                                                <p>{{ $cart['unit_price'] ?? '' }}</p>
                                            </td>
                                            <td class="quantity-box">
                                                <form action="{{url('update-cart/'.$cart->id)}}" method="POST">
                                                    @csrf
                                                <div class="qty qty-minus" onclick="decreaseQty('cartQty{{$cart->id}}')">-</div>
                                                <input id="cartQty{{$cart->id}}" name="qty" class="qty" type="number" value="{{ $cart['quantity'] ?? '' }}"
                                                    min="1" size="1">
                                                <div class="qty qty-plus" onclick="increaseQty('cartQty{{$cart->id}}')">+</div>
                                                <button type="submit" style="border: 2px solid;
                                                color: #fd7050;
                                                margin-left: 10px;
                                                height: 47px;
                                                border-radius: 8px;"><i class="fa fa-check"></i></button>
                                                </form>
                                            </td>
                                            <td class="total-pr">
                                                <p>£ {{ $cart['unit_price'] * $cart['quantity'] }}</p>
                                            </td>
                                            <td class="remove-pr">
                                                <a href="{{ 'remove-item/' . $cart->id }}">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--            #fd6e50-->
            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Total Item</h4>
                            <div class="ml-auto font-weight-bold"> {{ $totalItem }} </div>
                        </div>
                        <hr>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> £ {{ $cartSum }} </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> £ {{ $cartSum }} </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="{{ 'checkout' }}"
                        class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

@endsection
@section('script')
@foreach ($cartData as $item)
<script>
    function increaseQty(qtyId) {
	var location = document.getElementById(qtyId);
	var currentQty = location.value;
	var qty = Number(currentQty) + 1;
	location.value = qty;
}

function decreaseQty(qtyId) {
	var location = document.getElementById(qtyId);
	var currentQty = location.value;
	if (currentQty > 1) {
		var qty = Number(currentQty) - 1;
		location.value = qty;
	}
}
</script>
    
@endforeach
@endsection

<style>
    .form-group h5{
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        z-index: 1;
        font-size: .85rem;
    }

</style>
<?php
  $totalAmount = $order->total;
  $totalDeliveryCharges = $order->shipping_charge;
?>
<div class="row mb-3">
    <div class="col-4">
        <div class="form-group">
            <h5>Order amount: {{$totalAmount-$totalDeliveryCharges}}</h5>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <h5>Delivery charges: {{$totalDeliveryCharges}}</h5>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <h5>Total: {{ $totalAmount  }}</h5>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 justify-content-between">
        <div class="row justify-content-between align-items-center">
            <h6 class="ml-3 font-weight-bold">Order detail</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <div class="form-group">
                    <h5>Name: {{$order->name}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Email: {{$order->email}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Phone: {{$order->phone}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Address: {{$order->address}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Order place date: {{$order->order_place_date}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Payment status: {{strtoupper($order->payment_status)}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Payment type: {{strtoupper($order->payment_type)}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Order status: {{strtoupper($order->status)}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3 justify-content-between">
        <div class="row justify-content-between align-items-center">
            <h6 class="ml-3 font-weight-bold">Order details</h6>
        </div>
    </div>
    <div class="card-body">
        
        @foreach($orderDetails as $cartItems)
            <div class="row mb-3">
                <div class="col-4">
                    <div class="form-group">
                        <h5>Product name: {{$cartItems->product_name->name??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Quantity: {{$cartItems->quantity??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Unit price: {{$cartItems->unit_price??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Total price: {{$cartItems->total??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Delivery charges: {{$cartItems->delivery_charges??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Commission: {{$cartItems->total_commission??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Restaurant name: {{$cartItems->restaurant_name->name??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Restaurant  email: {{$cartItems->restaurant_name->email??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Restaurant phone: {{$cartItems->restaurant_name->phone??'' }}</h5>
                    </div>
                </div>
            </div>

            <hr />

        @endforeach
    </div>
</div>


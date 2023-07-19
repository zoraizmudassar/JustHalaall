<style>
    h5{
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
            <h5>Order amount: {{$totalAmount-$totalDeliveryCharges??'0'}}</h5>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <h5>Delivery charges: {{$totalDeliveryCharges??'0'}}</h5>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <h5>Total: {{ $totalAmount??'0' , 2 }}</h5>
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
                    <h5>Name: {{$order->name??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Email: {{$order->email??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Phone: {{$order->phone??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Address: {{$order->address??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Order place date: {{$order->order_place_date??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Payment status: {{strtoupper($order->payment_status??'')}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Payment type: {{strtoupper($order->payment_type??'')}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5>Order status: {{strtoupper($order->status->status??'')}}</h5>
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
        <?php
            $cartItems = $order->carts;
        ?>
        @foreach($orderDetails as $item)
            

            @if($item->restaurant_id == Auth::guard('restaurant')->id())
                <div class="row mb-3">
                <div class="col-4">
                    <div class="form-group">
                        <h5>Product name: {{$item->product_name->name??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Quantity: {{$item->quantity??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Unit price: {{$item->unit_price??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Total price: {{$item->total??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Delivery charges: {{$item->delivery_charges??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Commission: {{$item->total_commission??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Restaurant name: {{$item->restaurant_name->name??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Restaurant  email: {{$item->restaurant_name->email??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5>Restaurant phone: {{$item->restaurant_name->phone??''}}</h5>
                    </div>
                </div>
            </div>
            <hr />
            @endif


        @endforeach
    </div>
</div>


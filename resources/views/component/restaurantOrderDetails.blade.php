<style>
    h5{
        text-decoration: none;
        text-align: center;
        text-transform: capitalize;
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
            <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Order amount:<b> £ </b> </span>{{ $totalAmount-$totalDeliveryCharges??'0' , 2 }}</h5>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Delivery charges:<b> £ </b> </span>{{ $totalDeliveryCharges??'0' , 2 }}</h5>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Total:<b> £ </b> </span>{{ $totalAmount??'0' , 2 }}</h5>
        </div>
    </div>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3 justify-content-between">
        <div class="row justify-content-between align-items-center">
            <h6 class="ml-3 font-weight-bold">Order Detail</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;"> Name: </span>{{$order->name??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: lowercase;"> <span style="text-transform: capitalize; font-weight: 700;"> Email: </span>{{$order->email??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: lowercase;"> <span style="text-transform: capitalize; font-weight: 700;">Phone: </span>{{$order->phone??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Address: </span>{{$order->address??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: lowercase;"> <span style="text-transform: capitalize; font-weight: 700;">Order place date: </span>{{$order->order_place_date??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;"> Payment type: </span>{{$order->payment_type??''}}</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Order status: </span><span class="badge badge-dark px-2 py-1">{{strtoupper($order->status??'')}}</span></h5>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Payment status: </span><span class="badge badge-dark px-2 py-1">{{strtoupper($order->payment_status??'')}}</span> </h5>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3 justify-content-between">
        <div class="row justify-content-between align-items-center">
            <h6 class="ml-3 font-weight-bold">Order Details</h6>
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
                        <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Product name: </span>{{$item->product_name->name??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Quantity: </span>{{$item->quantity??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Unit price:<b> £ </b> </span>{{$item->unit_price??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Total price:<b> £ </b> </span>{{$item->total??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Delivery charges:<b> £ </b> </span>{{$item->delivery_charges??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Commission:<b> £ </b> </span>{{$item->total_commission??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: capitalize;"> <span style="text-transform: capitalize; font-weight: 700;">Restaurant name: </span>{{$item->restaurant_name->name??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: lowercase;"> <span style="text-transform: capitalize; font-weight: 700;">Restaurant Email: </span>{{$item->restaurant_name->email??''}}</h5>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <h5 style="text-transform: lowercase;"> <span style="text-transform: capitalize; font-weight: 700;">Restaurant phone: </span>{{$item->restaurant_name->phone??''}}</h5>
                    </div>
                </div>
            </div>
            <hr />
            @endif


        @endforeach
    </div>
</div>


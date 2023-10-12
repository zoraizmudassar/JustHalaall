<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";

    protected $guarded = [];

    public function carts()
    {
        return $this->hasMany(OrderCart::class);
    }

    public function cartsInfo()
    {
        $carts = array();
        $cartItems =  $this->carts;
        foreach ($cartItems as $item ){
            $carts[] = $item->cart;
        }
        return $carts;
    }
    public function totalAmount(){
        $total = 0;
        $cartsInfo = $this->cartsInfo();
        foreach ($cartsInfo as $item){
            $total = $total + ($item->quantity * $item->unit_price) ;
        }
        return $total;
    }

    // public function totalDeliveryCharges(){
    //     $total = 0;
    //     $cartsInfo = $this->cartsInfo();
    //     foreach ($cartsInfo as $item){
    //         $cartCharges = OrderCart::where('cart_id', $item->id)->where('order_id', $this->id)->first();
    //         $total = ($total + $cartCharges->delivery_charges);
    //     }
    //     return $total;
    // }


    public function orderDetails()
    {
        return $this->hasOne(OrderDetail::class,'order_id')->with('product_name');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class,'status_id');
   }
   

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function restaurantTotalAmount(){
        $total = 0;
        $cartsInfo = $this->cartsInfo();
        foreach ($cartsInfo as $item){
            if($item->restaurant_id ==  Auth::guard('restaurant')->id()){
                $total = $total + ($item->quantity * $item->unit_price);
            }
        }
        return $total;
    }

    public function hotelTotalDeliveryCharges(){
        $total = 0;
        $cartsInfo = $this->cartsInfo();
        foreach ($cartsInfo as $item){
            if($item->restaurant_id ==  Auth::guard('restaurant')->id()) {
                $cartCharges = OrderCart::where('cart_id', $item->id)->where('order_id', $this->id)->first();
                $total = ($total + $cartCharges->delivery_charges);
            }
        }
        return $total;
    }

}

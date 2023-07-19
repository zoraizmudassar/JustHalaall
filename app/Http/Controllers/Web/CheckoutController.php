<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Stripe;

class CheckoutController extends Controller
{
    public function __construct()
    {
        return $this->middleware("auth");
    }
    public function index()
    {
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        $cartSum = 0;
        $totalItem  = Cart::where('user_id',Auth()->user()->id)->sum('quantity');
        foreach($cart as $item){
            $cartSum += $item->unit_price * $item->quantity;
        }
        return view('web.checkout',compact('cart','totalItem','cartSum'));
    }
    public function Checkout(Request $request){
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        $sub_total =0 ;
        foreach($cart as $item){
            $sub_total += $item->quantity * $item->unit_price;
        }
        $shipping_charge = 0;
        if($request->shipping_option==1){
            $shipping_charge=10;
        }elseif($request->shipping_option==2){
            $shipping_charge = 20;
        }
        $total = $sub_total + $shipping_charge;
        $order = new Order;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->order_no = 'Order'.random_int(1000, 9999);
        $order->order_place_date = Carbon::now()->format('Y-m-d');
        $order->payment_status = 'pending';
        $order->charge_id = $request->shipping_option;
        $order->payment_type = $request->paymentMethod;
        $order->user_id = Auth()->user()->id;

        $order->shipping_charge = $shipping_charge;
        $order->address2 = $request->address2;
        $order->country = $request->country;
        $order->state = $request->state;
        $order->city = $request->city;
        $order->zipcode = $request->zipcode;
        $order->same = $request->same;
        $order->discount = 0;
        $order->coupon_discount = 0;
        $order->tax = 0;
        $order->total = $total;
        $order->save();

        foreach($cart as $item){
            $order_detail = new OrderDetail;
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item->product_id;
            $order_detail->quantity = $item->quantity;
            $order_detail->unit_price = $item->unit_price;
            $order_detail->sub_total = $item->quantity * $item->unit_price;
            $order_detail->total = $item->quantity * $item->unit_price;
            $order_detail->restaurant_id = $item->restaurant_id;
            $order_detail->commission_percent = 11;
            $order_detail->payment_status = 'preparing';
            $order_detail->delivery_charges =0;
            $order_detail->total_commission = (($item->quantity * $item->unit_price)/100)*11;
            $order_detail->payment_id = $request->paymentMethod;
            $order_detail->save();
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $total * 100,
                "currency" => "gbp",
                "source" => $request->stripeToken,
                "description" => "This order payment"
        ]);
        $cart_empty = Cart::where('user_id',Auth()->user()->id)->delete();
        return redirect('/');
    }
}

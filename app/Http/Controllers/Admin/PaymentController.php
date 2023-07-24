<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(){
        $payment = OrderDetail::where('comission_status', 'pending')->get();
        $restaurant = Restaurant::orderBy('name')->get();
        return view('admin/payment.index',compact('payment','restaurant'));
    }
    public function pay(Request $request){
        $payment = OrderDetail::where('restaurant_id', $request->restaurant_id)->where('comission_status', 'pending')->get();
        foreach($payment as $item){
            $item->comission_status ='paid';
            $item->update();
        }
        return redirect('admin/payment');
    }
    public function restaurant(){
        $order = Order::with('orderDetails')->where('restaurant_status', 'pending')->where('payment_type','card')->orderBy('id','DESC')->get();
        $order_detail = OrderDetail::all();
        $restaurant = Restaurant::all();
        return view('admin/payment.payment',compact('order','restaurant','order_detail'));
    }
    public function restaurant_pay(Request $request){
        $order = Order::find($request->order_id);
        $order->restaurant_status ='paid';
        $order->update();
        return redirect('admin/payment/restaurant');
    }
}

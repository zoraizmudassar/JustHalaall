<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(){
        $payment = OrderDetail::all();
        $restaurant = Restaurant::get();
        return view('admin/payment.index',compact('payment','restaurant'));
    }
    public function pay(Request $request){
        $payment = OrderDetail::where('restaurant_id', $request->restaurant_id)->where('payment_status', 'pending')->get();
        foreach($payment as $item){
            $item->payment_status ='paid';
            $item->update();
        }
        return redirect('admin/payment/payment');
    }
}

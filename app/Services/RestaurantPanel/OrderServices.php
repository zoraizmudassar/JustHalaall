<?php

namespace App\Services\RestaurantPanel;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderServices
{
    public function pending($request)
    {
        $orders = Order::latest()->where('status','pending')->with('user','orderDetails')->get();
        return view('restaurant.order.pending',compact('orders'));
    }
    public function accepted($request)
    {
        $orders = Order::latest()->where('status','accepted')->with('user','orderDetails')->get();
        return view('restaurant.order.accepted',compact('orders'));
    }
    public function complete($request)
    {
        $orders = Order::latest()->where('status','complete')->with('user','orderDetails')->get();
        return view('restaurant.order.delivered',compact('orders'));
    }
    public function rejected($request)
    {
        $orders = Order::latest()->where('status','rejected')->with('user','orderDetails','status')->get();
        return view('restaurant.order.rejected',compact('orders'));
    }

    public function changeStatus($request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $save = $order->save();
        if ($save){
            $detail_status = OrderDetail::where(['order_id'=>$request->order_id])->first();
           
                $detail_status->accepted_status = $request->status;
            
            $detail_status->save();
        }

        if ($save){
            return response()->json(['status' => 200,'message'=>'Status Change Successfully.']);
        }else{
            return response()->json(['status' => 404,'message'=>'Status NOT Change']);
        }
    }

    public function acceptedStatus($request)
    {
        $detail_status = OrderDetail::where(['id'=>$request->order_id])->first();
        $detail_status->accepted_status = $request->status;
        $save = $detail_status->save();

        if ($save){
            return response()->json(['status' => 200,'message'=>'Status Change Successfully.']);
        }else{
            return response()->json(['status' => 404,'message'=>'Status NOT Change']);
        }
    }

    public function orderDetails($id)
    {
        $order = Order::find($id);
        $orderDetails = OrderDetail::where('order_id',$id)->get();
        return view('restaurant.order.details',compact('order','orderDetails'));
    }


}

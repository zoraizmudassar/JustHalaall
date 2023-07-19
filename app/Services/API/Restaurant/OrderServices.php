<?php

namespace App\Services\API\Restaurant;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Status;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderServices
{
    public function orderDetail($request)
    {
        $customMsgs = [
            'order_id.required' => 'Please Provide Order ID',
        ];
        $validator = Validator::make($request->all(),
            [
                'order_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }
        $order = Order::find($request->order_id);
        $details = orderDetail::where('order_id',$request->order_id)->get();
        if (!$order){
            return response()->json(['status' => 404, 'message' => "Order not found"], 404);
        }
        $images = [];
        $array_images = explode('|',$details->image);
        foreach($array_images as $image){
            $images[] = asset($image);
        }
        foreach($details as $index=> $item){
            $data[$index] = [
                'id'=>$item->id,
                'order_id'=>$item->order_id,
                'user_id'=>$order->user_id,
                'restaurant_id'=>$item->restaurant_id,
                'payment_type'=>$item->payment_id,
                'product_id'=>$item->product_id,
                'quantity'=>$item->quantity,
                'unit_price'=>$item->unit_price,
                'total'=>$item->total,
                'commission_percent'=>$item->commission_percent,
                'total_commission'=>$item->total_commission,
                'commision_status'=>$item->payment_status,
            ];
        }
        

        return response()->json([ 'status' => 200 ,'data'=>$data ], 200);
    }

    public function orderList($request)
    {
        $orders = Order::with('cart','orderDetails','Statuses')->get();
//        dd($orders);
        $total_orders = [];
        foreach ($orders as $key => $order){

//            dd($order->Statuses);
            $total_orders[$key]['order_id'] = $order->id;
            $total_orders[$key]['order_number'] = $order->order_no;
            $total_orders[$key]['status'] = $order->orderDetails['accepted_status'];
            $total_orders[$key]['payment_method'] = $order->payment_type;
//            $total_orders[$key]['approval_status'] = $order->Statuses['status'];

//            $total_orders[$key]['approval_status'] = $order->Statuses['status'];

            foreach ($order->Statuses as $status){
                $total_orders[$key]['approval_status'] = $status['status'];

            }
//            $total_orders[$key]['approval_status'] = $order->statuses['status'];


            $carts = Cart::where('restaurant_id',Auth::id())->with('restaurant','user')->get();

            //if ($order->cart->restaurant_id == Auth::id()){
            foreach($carts as $cart){
                $total_orders[$key]['name'] = $cart->user->name;
                $total_orders[$key]['number'] = $cart->user->phone;
            }
            //}
        }
        if (!empty($total_orders)){
            return response()->json([ 'status' => 200,'data'=>$total_orders,'message'=> 'Order lists' ], 200);
        }else{
            return response()->json([ 'status' => 404,'message'=> 'Orders NOT found'], 404);
        }
    }

    public function history($request)
    {
        $ids = Order::with('orderDetails')->pluck('status_id');
        $orders = Order::with('orderDetails')->get();

        $total_orders = [];
        foreach ($orders as $key => $order){
            if($order->orderDetails['accepted_status'] === 'delivered'){
                $total_orders[$key]['order_id'] =  $order->id;
                $total_orders[$key]['order_number'] = $order->order_no;
                $total_orders[$key]['status'] = $order->orderDetails['accepted_status'];
                $total_orders[$key]['payment_method'] = $order->payment_type;

                $carts = Cart::where('restaurant_id',Auth::id())->with('restaurant','user')->get();

                if ($order->orderDetails->restaurant_id == Auth::id()){
                foreach($carts as $cart){
                    $total_orders[$key]['name'] = $cart->user->name;
                    $total_orders[$key]['number'] = $cart->user->phone;
                }
                }
            }

            }
        if (!empty($total_orders)){
            return response()->json([ 'status' => 200,'data'=>$total_orders,'message'=> 'Order lists' ], 200);
        }else{
            return response()->json([ 'status' => 404,'message'=> 'Orders NOT found'], 404);
        }

    }

    public function historyOnlinePayment($request)
    {
        $ids = Order::with('cart','orderDetails')->pluck('status_id');
        $orders = Order::with('cart','orderDetails')->get();

        $total_orders = [];
        foreach ($orders as $key => $order){
            if($order->payment_type === 'card'){
                $total_orders[$key]['order_id'] =  $order->id;
                $total_orders[$key]['order_number'] = $order->order_no;
                $total_orders[$key]['status'] = $order->orderDetails['accepted_status'];
                $total_orders[$key]['payment_method'] = $order->payment_type;

                $carts = Cart::where('restaurant_id',Auth::id())->with('restaurant','user')->get();

                //if ($order->cart->restaurant_id == Auth::id()){
                foreach($carts as $cart){
                    $total_orders[$key]['name'] = $cart->user->name;
                    $total_orders[$key]['number'] = $cart->user->phone;
                }
                //}
            }

        }
        if (!empty($total_orders)){
            return response()->json([ 'status' => 200,'data'=>$total_orders,'message'=> 'Order lists' ], 200);
        }else{
            return response()->json([ 'status' => 404,'message'=> 'Empty Order List'], 404);
        }

    }

    public function historyCOD($request)
    {
        $ids = Order::with('cart','orderDetails')->pluck('status_id');
        $orders = Order::with('cart','orderDetails')->get();

        $total_orders = [];
        foreach ($orders as $key => $order){
            if($order->payment_type === 'cod'){
                $total_orders[$key]['order_id'] =  $order->id;
                $total_orders[$key]['order_number'] = $order->order_no;
                $total_orders[$key]['status'] = $order->orderDetails['accepted_status'];
                $total_orders[$key]['payment_method'] = $order->payment_type;

                $carts = Cart::where('restaurant_id',Auth::id())->with('restaurant','user')->get();

                //if ($order->cart->restaurant_id == Auth::id()){
                foreach($carts as $cart){
                    $total_orders[$key]['name'] = $cart->user->name;
                    $total_orders[$key]['number'] = $cart->user->phone;
                }
                //}
            }

        }
        if (!empty($total_orders)){
            return response()->json([ 'status' => 200,'data'=>$total_orders,'message'=> 'Order lists' ], 200);
        }else{
            return response()->json([ 'status' => 404,'message'=> 'Empty Order List'], 404);
        }
    }

    public function orderStatusChange($request)
    {
        $customMsgs = [
            'order_id.required' => 'Please Provide Order ID',
            'status.required' => 'Please Provide Order Status',
        ];
        $validator = Validator::make($request->all(),
            [
                'order_id' => 'required',
                'status_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

            $order = Order::where('id',$request->order_id)->first();

        if (!$order){
            return response()->json(['status' => 404, 'message' => "Order id not found"], 404);
        }

        $status = Status::where('id',$request->status_id)->first();
        if(!$status){

            return response()->json(['status'=> 404, 'message' => 'status id does not Exist'],404);
        }
            $order->status = $request->status_id;
            $order->save();
            return response()->json(['status' => 200, 'message' => "Order Status updated successfully"], 200);



//        if ($save){
//            return response()->json(['status' => 200, 'message' => "Status updated successfully", 'data' => $data], 200);
//        }

    }

    public function orderStatuses($request)
    {

        $status =  Status::all();

        foreach ($status as $st){

            $data[] = [
                'status_id' => $st->id,
            'status' => $st->status,];
//            'status_id' => $st->id,];
        }
        return response()->json(['status' => 200, 'data' => $data, 'message' => 'Order Status List']);

    }
}

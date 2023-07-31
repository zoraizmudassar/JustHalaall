<?php

namespace App\Services\API\Restaurant;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Status;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\FCMService;
use App\Http\Traits\ApiResponse;
use App\Http\Traits\ApiValidation;
use App\Http\Traits\Firebase;
use Exception;

class OrderServices
{
    use ApiResponse, ApiValidation, Firebase;
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
        
        $details = orderDetail::where('order_id',$request->order_id)->get();
         $order = Order::find($request->order_id);
         $data= [];
         foreach($details as $detail){
            $data[] = [
                'id'=>$detail->id,
                'order_id'=>$detail->order_id,
                'payment_type'=>$detail->payment_id,
                'product_id'=>$detail->product_id,
                'product_name'=>$detail->product_name->name,
                'quantity'=>$detail->quantity,
                'unit_price'=>$detail->unit_price,
                'total'=>$detail->total,
                'user_id'=>$order->user_id,
                'status'=>$order->status,
            ];
         }
        
        if (!$data){
            return response()->json(['status' => 404, 'message' => "Order not found"], 404);
        }
        return response()->json([ 'status' => 200 ,'data'=>$data ], 200);
    }

    public function orderList($request)
    {
        $orders = Order::with('cart','orderDetails','Statuses')->get();
        dd($orders);
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
        // $ids = Order::with('orderDetails')->pluck('status_id');
        // $orders = Order::with('orderDetails')->get();

        $total_orders = [];
            $detail = OrderDetail::where('restaurant_id',$request->restuarant_id)->get();
            foreach($detail as $key => $item){
                $order = Order::find($item->order_id);
                $total_orders[$key]['id'] =  $order->id;
                $total_orders[$key]['order_id'] =  $order->id;
                $total_orders[$key]['order_number'] = $order->order_no;
                $total_orders[$key]['status'] = $order->status;
                $total_orders[$key]['payment_method'] = $order->payment_type;

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
                $total_orders[$key]['status'] = $order->status;
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
                $total_orders[$key]['status'] = $order->status;
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
    public function sendNotification($token, $title=null, $body=null,$icon=null,$sound=null,$data=null){
        
        try{
        $url = 'https://fcm.googleapis.com/fcm/send';
          
        $serverKey = env('FCM_API_KEY');
        $data = [
            "registration_ids" => array($token),
            "notification" => [
                "title" => $title,
                "body" => $body,  
            ]
        ];
        
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        return $result;
        } catch (Exception $e) {
        return response()->json([ 'status' => 406 ,'message'=>$e->getMessage() ], 406);
        }
            // $notification = [
            //     'title' =>$title,
            //     'body' => $body,
            //     'icon' =>$icon,
            //     'sound' => $sound
            // ];
            // $extraNotificationData = ["message" => $notification,"moredata" =>$data];
    
            // $fcmNotification = [
            //     //'registration_ids' => $tokenList, //multple token array
            //     'to'        => $token, //single token
            //     'notification' => $notification,
            //     'data' => $extraNotificationData
            // ];
            
            // return $this->firebaseNotification($fcmNotification); 
    
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
                'status' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

            $order = Order::find($request->order_id);

        if (!$order){
            return response()->json(['status' => 404, 'message' => "Order id not found"], 404);
        }

        // $status = Status::where('id',$request->status_id)->first();
        // if(!$status){

        //     return response()->json(['status'=> 404, 'message' => 'status id does not Exist'],404);
        // }
            $order->status = $request->status;
            $order->save();
            $user = User::find($order->user_id);
            // Notification
                $title1 ='Your Order Alert!';
                $body1 = 'Your Order '.$order->id.' Status is '.$request->status;
            $this->sendNotification($user->fcm_token, $title1, $body1,$icon=null,$sound=null,$data=null);
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

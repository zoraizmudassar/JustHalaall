<?php

namespace App\Services\RestaurantPanel;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderServices
{
    public function all($request)
    {
        $orders = Order::latest()->with('user','orderDetails')->get();
        return view('restaurant.order.all',compact('orders'));
    }
    public function pending($request)
    {
        $orders = Order::latest()->where('status','preparing')->with('user','orderDetails')->get();
        return view('restaurant.order.pending',compact('orders'));
    }
    public function accepted($request)
    {
      $orders = Order::latest()->where('status','accepted')->with('user','orderDetails')->get();
      return view('restaurant.order.accepted',compact('orders'));
    }
    public function onWay($request)
    {
       $orders = Order::latest()->where('status','make order on way')->with('user','orderDetails')->get();
       return view('restaurant.order.on_way',compact('orders'));
    }
    public function complete($request)
    {
        $orders = Order::latest()->where('status','complete')->with('user','orderDetails')->get();
        return view('restaurant.order.complete',compact('orders'));
    }
    public function rejected($request)
    {
        $orders = Order::latest()->where('status','rejected')->with('user','orderDetails')->get();
        return view('restaurant.order.rejected',compact('orders'));
    }
public function sendNotification($token, $title=null, $body=null,$icon=null,$sound=null,$data=null){
        
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
           // $user = User::find($order->user_id);
           // $token = $user->fcm_token;
           // $title = "Your Order has been ".$request->status;
           // $body = "Your Order No ".$order->id;
           // $this->sendNotification($token, $title=null, $body=null,$icon=null,$sound=null,$data=null);
            return response()->json(['status' => 200,'message'=>'Status Change Successfully.']);
        }else{
            return response()->json(['status' => 404,'message'=>'Status NOT Change']);
        }
    }

    public function acceptedStatus($request)
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
            $user = User::find($order->user_id);
            $token = $user->fcm_token;
            $title = "Your Order has been ".$request->status;
            $body = "Your Order No ".$order->id;
            $this->sendNotification($token, $title=null, $body=null,$icon=null,$sound=null,$data=null);
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

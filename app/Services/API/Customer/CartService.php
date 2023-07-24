<?php

namespace App\Services\API\Customer;

use App\Http\Resources\OrderResource;
use App\Http\Resources\CartResource;
use App\Http\Resources\WishListResource;
use App\Http\Traits\ApiResponse;
use App\Http\Traits\ApiValidation;
use App\Http\Traits\Firebase;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderCart;
use App\Models\OrderDetail;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\StripeInitiatePayment;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Stripe\Customer;
use Stripe\EphemeralKey;
use Stripe\PaymentIntent;
use Stripe;
use DB;
use Illuminate\Http\Request;
use Exception;

class CartService
{
    use ApiResponse, ApiValidation, Firebase;

public function cartTotal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()
            ], 400);
            
        } else {
            $user_id = $request->user_id;
                
            $carts = Cart::where('user_id', $user_id)->count();
            $data = [
                "total" => $carts
                ];
            return  $this->successResponse($data);
        }
    }
    public function cartList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()
            ], 400);
            
        } else {
            $latitudeTo = $request->latitude;
            $longitudeTo = $request->longitude;
            $user_id = $request->user_id;
                
            $carts = Cart::with(['product','restaurant','user'])->where('user_id', $user_id)->get();
            $data = [];
            foreach($carts as $index=> $item){
                $charges = 0;
                $restaurant = Restaurant::find($item->restaurant_id);
                $distance = $this->short_distance($latitudeTo,$longitudeTo,$restaurant->latitude,$restaurant->longitude);
                $charges = $distance * $restaurant->delivery_charges;
                $data [$index] = [
                    'id'=>$item->id,
                    'user_id'=>$item->user_id,
                    'restaurant_id'=>$item->restaurant_id,
                    'product_id'=>$item->product_id,
                    'unit_price'=>$item->unit_price,
                    'quantity'=>$item->quantity,
                    'status'=>$item->status,
                    'delivery_cahrge' => number_format((float)$charges, 2, '.', ''),
                    'created_at'=>$item->created_at,
                    'updated_at'=>$item->updated_at,
                    'user'=>$item->user,
                    'restaurant'=>$item->restaurant,
                    'product'=>$item->product
                    ];
            }
            return  $this->successResponse($data);
        }
    }

    public function addToCart($request)
    {
        $validationStatus = $this->validateData($request, 'add_to_cart');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $restaurant = Restaurant::find($request->restaurant_id);
            if (!$restaurant) {
                return $this->errorMessage('Restuarant not found');
            }

            $product = Product::find($request->product_id);
            if (!$product) {
                return $this->errorMessage('Product not found');
            }
            $restaurant_id = $request->restaurant_id;
            $product_id = $request->product_id;
            $unit_price = $product->price;
            $quantity = $request->quantity;;
            $user_id = getApiLoggedUserId($request);



            $cart = Cart::where('user_id', $user_id)
                ->where('restaurant_id', $restaurant_id)
                ->where('product_id', $product_id)->first();
            if ($cart) {
                $cart->quantity = $cart->quantity + $quantity;
                $cart->unit_price = $unit_price;
                $cart->save();
            } else {
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->restaurant_id = $restaurant_id;
                $cart->product_id = $product_id;
                $cart->unit_price = $unit_price;
                $cart->quantity = $quantity;
                $cart->save();
            }
            return $this->successResponse(new CartResource($cart));
        }
    }

    public function removeFromCart($request)
    {
        $validationStatus = $this->validateData($request, 'remove_from_cart');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $user_id = getApiLoggedUserId($request);

            $cart = Cart::where('product_id', $request->product_id)->where('user_id', $request->user_id)->first();
            if (!$cart) {
                return $this->errorMessage('Cart not found');
            }
            $cart->delete();
            return $this->successResponse([], 'Remove from cart');
        }
    }

    public function wishList($request)
    {
        $user_id = getApiLoggedUserId($request);
        $wishLists = WishList::where('user_id', $user_id)->get();
        return $this->successResponse(WishListResource::collection($wishLists));
    }

    public function addToWishList($request)
    {
        $validationStatus = $this->validateData($request, 'add_to_wishlist');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $user_id = $request->user_id;
            $restaurant_id = $request->restaurant_id;
            $product_id = $request->product_id;

            $restaurant = Restaurant::find($restaurant_id);
            if (!$restaurant) {
                return $this->errorMessage('Restaurant not exists');
            }

            $product = Product::find($product_id);
            if (!$product) {
                return $this->errorMessage('Product not exists');
            }

            $wishList = WishList::where('user_id', $user_id)->where('restaurant_id', $restaurant_id)->where('product_id', $product_id)->first();

            if (!$wishList) {
                $wishList = new WishList();
                $wishList->user_id = $user_id;
                $wishList->restaurant_id = $restaurant_id;
                $wishList->product_id = $product_id;
                $wishList->save();
            }

            return $this->successResponse(new WishListResource($wishList));
        }
    }

    public function removeToWishList($request, $wishListId)
    {
        $wishList = WishList::find($wishListId);
        if (!$wishList) {
            return $this->errorMessage('Wishlist not exists');
        }
        $wishList->delete();

        return $this->successResponse([], 'Wishlist remove');
    }

    public function orderList($request, $order_status = '')
    {
        $orderList = DB::table('orders')->select('order_details.id',
        'order_details.product_id as product_id','order_details.order_id as order_id','order_details.total','products.name as product_name','products.images as product_image','restaurants.id as restaurant_id','restaurants.name as restaurant_name')
        ->join('order_details','order_details.order_id','=','orders.id')
        ->join('products','products.id','=','order_details.product_id')
        ->join('restaurants','restaurants.id','=','order_details.restaurant_id')
        ->where('orders.user_id',$request->user_id)->get();
        return response()->json([ 'status' => 200 ,'data'=>$orderList ], 200);
    }
    public function short_distance($latitudeTo,$longitudeTo,$latitudeFrom,$longitudeFrom){
        try{
        // Calculate distance between latitude and longitude
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        $distance = round($miles * 1.609344, 2);
       return $distance;
        } catch (Exception $e) {
            return $this->successResponse($e->getMessage());
        }
    }
    
    function getAddress($latitude, $longitude)
    {
        try{
            //google map api url
            $url = "https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyA6Ry5WzM5kjO4ryPGeoLXL3-lkrAGi0xY";
    
            // send http request
            $geocode = file_get_contents($url);
            $json = json_decode($geocode);
            
            if(isset($json->results[0])) {
                $response = array();
                foreach($json_decode->results[0]->address_components as $addressComponet) {
                    if(in_array('political', $addressComponet->types)) {
                            $response[] = $addressComponet->long_name; 
                    }
                }
            
                if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
                if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; } 
                if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
                if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
                if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }
            
                if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
                    echo "<br/>Address:: ".$first;
                    echo "<br/>City:: ".$second;
                    echo "<br/>State:: ".$fourth;
                    echo "<br/>Country:: ".$fifth;
                }
                else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  ) {
                    echo "<br/>Address:: ".$first;
                    echo "<br/>City:: ".$second;
                    echo "<br/>State:: ".$third;
                    echo "<br/>Country:: ".$fourth;
                }
                else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
                    echo "<br/>City:: ".$first;
                    echo "<br/>State:: ".$second;
                    echo "<br/>Country:: ".$third;
                }
                else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
                    echo "<br/>State:: ".$first;
                    echo "<br/>Country:: ".$second;
                }
                else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
                    echo "<br/>Country:: ".$first;
                }
              }
            $address = $json->results[0]->address_components[1]->long_name??'no address';
            $city = $json->results[0]->address_components[3]->long_name??'no city';
            $state = $json->results[0]->address_components[4]->long_name??'no state';
            $country = $json->results[0]->address_components[5]->long_name??'no country';
            $address=[
                'address'=>$address,
                'city'=>$city,
                'state'=>$state,
                'country'=>$country,
                'full'=>$address.','.$city.','.$state.','.$country
                ];
            return $address;
        } catch (Exception $e) {
            
        return response()->json([ 'status' => 406 ,'message'=>$e->getMessage() ], 406);
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
    public function checkout($request)
    {
        try{
        $validationStatus = $this->validateData($request, 'checkout');

        if (!$validationStatus) {
            return $validationStatus;
        } else {
            if ($request->paymentMethod == 'card') {
                try{
                $stripe = new \Stripe\StripeClient('pk_test_51KT26VDuKSCrfM2pauObEL6P9pEphtZN4W0eOtz79NTcFlEVp8Yub37AgWxBnhXbFizoQQHe6UsmOqlpgotFutWq00L3bdQIgV');
                $token = $stripe->tokens->create([
                    'card' => [
                        'number' => $request->card_no,
                        'exp_month' => $request->exp_month,
                        'exp_year' => $request->exp_year,
                        'cvc' => $request->cvc,
                    ],
                ]);
                }catch(\Exception $e){
                    return response()->json([ 'status' => 406 ,'message'=>$e->getMessage() ], 406);
                }
            }
            $get_restaurant = DB::table('carts')->select('restaurant_id')->distinct()->get();
            $user = User::find($request->user_id);
            $address = $this->getAddress($request->latitude, $request->longitude);
            foreach($get_restaurant as $item){
            
            $cart = Cart::where('user_id', $request->user_id)->where('restaurant_id',$item->restaurant_id)->get();
            $sub_total = 0;
            $order = new Order;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $address['address'];
            $order->order_no = 'Order' . random_int(1000, 9999);
            $order->order_place_date = Carbon::now()->format('Y-m-d');
            $order->payment_status = 'pending';
            $order->charge_id = $request->shipping_option;
            $order->payment_type = $request->paymentMethod;
            $order->user_id = $request->user_id;
            // $order->address2 = $request->address2;
            $order->country = $address['country'];
            $order->state = $address['state'];
            $order->city = $address['city'];
            // $order->zipcode = $request->zipcode;
            // $order->same = $request->same;
            $order->discount = 0;
            $order->coupon_discount = 0;
            $order->tax = 0;
            $order->total = $request->total;
            
            $order->save();
            
            $from = $request->address .' '.$request->city.','.$request->state.','.$request->country;
            $shipping_charge = 0; 
            foreach ($cart as $item) {
                $restaurant = Restaurant::find($item->restaurant_id);
                $ditance = $this->short_distance($request->latitude,$request->longitude,$restaurant->latitude,$restaurant->longitude);
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $item->product_id;
                $order_detail->sub_total = $item->quantity * $item->unit_price;
                $order_detail->total = $item->quantity * $item->unit_price;
                $order_detail->restaurant_id = $item->restaurant_id;
                $order_detail->commission_percent = 11;
                $order_detail->payment_status = 'Paid';
                $order_detail->accepted_status = 'Preparing';
                if($request->paymentMethod=='cod'){
                    $shipping_charge += $restaurant->delivery_charges * $ditance;
                    $order_detail->delivery_charges = $restaurant->delivery_charges * $ditance;
                }else{
                    $order_detail->delivery_charges = 0.00;
                }
                
                $order_detail->total_commission = (($item->quantity * $item->unit_price) / 100) * 11;
                $order_detail->payment_id = $request->paymentMethod;
                $order_detail->save();
                
                // Notification
                $title ='New Order Arrived';
                $body = 'Order no '.$order->id.' from '.$user->name;
                $this->sendNotification($restaurant->fcm_token, $title, $body,$icon=null,$sound=null,$data=null);
                
            }
            $order_update = Order::find($order->id);
            $order_update->shipping_charge = $shipping_charge;
            $order_update->total =$order_update->total + $shipping_charge;
            if($request->paymentMethod == 'card'){
                $order_update->restaurant_payment =$order_update->total + $shipping_charge;
            }else{
                $order_update->restaurant_status = 'paid';
            }
            $order_update->update();
            
            if ($request->paymentMethod == 'card') {
                Stripe\Stripe::setApiKey('sk_test_51KT26VDuKSCrfM2pzNkem7TjWwpYd0JM68hsK21rqjs48MrgRA16fuehT8FdhbciOH3tkjDu4CLYK3Jc5GBd3flr00JrTOuYdb');
                Stripe\Charge::create([
                    "amount" => ($request->total + $shipping_charge)  * 100,
                    "currency" => "gbp",
                    "source" => $token->id,
                    "description" => "This order payment"
                ]);
                $this->sendNotification($user->fcm_token, 'Your Order Payment Against Order No '.$order->id, 'payment recieved successfully!',$icon=null,$sound=null,$data=null);
            }
            // Notification
                $title1 ='Your Order has been Placed Successfully!';
                $body1 = 'Your Order No '.$order->id;
                $this->sendNotification($user->fcm_token, $title1, $body1,$icon=null,$sound=null,$data=null);
            $data = [
                'order' => $order
                ];
            }
                
            $cart_empty = Cart::where('user_id', $request->user_id)->delete();
            return $this->successResponse($data);
        }
        } catch (Exception $e) {
        return response()->json([ 'status' => 406 ,'message'=>$e->getMessage() ], 406);
        }
    }
    public function stripePayment($request, $amount)
    {
        Stripe\Stripe::setApiKey('sk_test_51K8R9YHPpBmXqUZOAWWGydpJuH1B6NI0gPzZjHCw9TmlXd36LHbcZuIzbj8SoI99ZZT25rBmdIp4Vz3bvem4vRIg00x9zsyDFn');
        $customer = Customer::create();

        $ephemeralKey = EphemeralKey::create(
            ['customer' => $customer->id],
            ['stripe_version' => '2020-08-27']
        );

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'customer' => $customer->id,
            'payment_method_types' => ['card'],
        ]);

        $stripe_payment = new StripeInitiatePayment();
        $stripe_payment->paymentIntent = $paymentIntent->client_secret;
        $stripe_payment->ephemeralKey = $ephemeralKey->secret;
        $stripe_payment->customer = $customer->id;
        $stripe_payment->user_id = $request->user()->id;
        $stripe_payment->amount = $amount;
        $stripe_payment->currency = 'usd';
        $stripe_payment->payment_method_types = 'card';
        $stripe_payment->save();

        return response([
            'paymentIntent' => $paymentIntent->client_secret,
            'ephemeralKey' => $ephemeralKey->secret,
            'customer' => $customer->id,
            'stripe_id' => $stripe_payment->id
        ]);
    }

    public function updateOrderStatus($request)
    {
        $validationStatus = $this->validateData($request, 'update_order_status');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $order = Order::find($request->order_id);
            if (!$order) {
                return $this->errorMessage('Order not exists');
            }
            $order->status = getOrderStatusId($request->order_status);
            $order->cancel_reason = $request->cancel_reason;
            $order->save();
            $order = new OrderResource($order);
            return $this->successResponse($order);
        }
    }

    public function getDeliveryCharges($request)
    {
        $validationStatus = $this->validateData($request, 'get_delivery_charges');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $cartItems = $request->cart;
            $origin_latitude = $request->latitude;
            $origin_longitude = $request->longitude;
            $origin = $origin_latitude . ',' . $origin_longitude;
            $deliveryCharges = array();
            foreach ($cartItems as $cartItem) {
                $cart = Cart::find($cartItem['cart_id']);
                $restaurant = Restaurant::find($cart->restaurant_id);
                $destination_latitude = $restaurant->latitude;
                $destination_longitude = $restaurant->longitude;
                $destination = $destination_latitude . ',' . $destination_longitude;
                $delivery_charges = getDistanceBetweenTwoCoOrdinates($origin, $destination);
                $temp = array();
                $temp['cart_id'] = $cartItem['cart_id'];
                $temp['delivery_charges'] = $delivery_charges * $restaurant->delivery_charges;
                $deliveryCharges[] = $temp;
            }
            return $this->successResponse($deliveryCharges);
        }
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Restaurant;
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

    public function indexv1()
    {
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        $cartSum = 0;
        $totalItem  = Cart::where('user_id',Auth()->user()->id)->sum('quantity');
        foreach($cart as $item){
            $cartSum += $item->unit_price * $item->quantity;
        }
        return view('website.checkout',compact('cart','totalItem','cartSum'));
    }
    
    public function Checkout(Request $request){
        if($request->paymentMethod=='card'){
            $validation = $request->validate(
            [
                'card_name' => 'required',
                'number' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'ccv' => 'required',
            ]
        );
        }
        $cart = Cart::where('user_id',Auth()->user()->id)->get();
        $latestId = Order::latest()->first();
        $latest_id = 1;
        if($latestId){
            $latest_id = $latestId['id'];
        }
        $sub_total = 0;
        foreach($cart as $item){
            $sub_total += $item->quantity * $item->unit_price;
        }
        $orderFormat = Carbon::now()->format('my');
        $orderFormat1 = 313000;
        $total = $sub_total;
        $order = new Order;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        // $order->order_no = 'Order'.random_int(1000, 9999);
        $order->order_no = $orderFormat1.''.$latest_id;
        $order->order_place_date = Carbon::now()->format('Y-m-d');
        $order->status = 'pending';
        $order->payment_type = $request->paymentMethod;
        $order->user_id = Auth()->user()->id;

        $order->shipping_charge = 0;
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
        $from = $request->address .' '.$request->city.','.$request->state.','.$request->country;
        $shipping_charge = 0;
        foreach($cart as $item){
            $restaurant = Restaurant::find($item->restaurant_id);
            $ditance = $this->Distance($from, $restaurant->address);
            $order_detail = new OrderDetail;
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item->product_id;
            $order_detail->quantity = $item->quantity;
            $order_detail->unit_price = $item->unit_price;
            $order_detail->sub_total = $item->quantity * $item->unit_price;
            $order_detail->total = $item->quantity * $item->unit_price;
            $order_detail->restaurant_id = $item->restaurant_id;
            $order_detail->commission_percent = 11;
            $order_detail->payment_status = 'Paid';
            $order_detail->accepted_status = 'Preparing';
            $order_detail->delivery_charges =0;
            $order_detail->total_commission = (($item->quantity * $item->unit_price)/100)*11;
            $order_detail->payment_id = $request->paymentMethod;
            $order_detail->save();
            if($request->paymentMethod=='cod'){
                    $shipping_charge += $restaurant->delivery_charges * $distance;
                    $order_detail->delivery_charges = $restaurant->delivery_charges * $ditance;
                }else{
                    $order_detail->delivery_charges = 0.00;
                }
        }
        $order_update = Order::find($order->id);
        $order_update->shipping_charge = $shipping_charge;
        $order_update->total = $order_update->total + $shipping_charge;
        $order_update->update();
        if($request->paymentMethod=='card'){
        $stripe = new \Stripe\StripeClient(
                    'sk_test_51KtEUaBu1iUxbOUFRCAIb1zzTPspSqogixpxlGYfESEXN9cOUBj9AmLnCACV5hlaC7gI8Nv8kcwULq0Mm7cXFE6A00K7doqmmN'
                );
                // dd($stripe);
                // $token = $stripe->tokens->create([
                //     'card' => [
                //         'number' => $request->card_no,
                //         'exp_month' => $request->exp_month,
                //         'exp_year' => $request->exp_year,
                //         'cvc' => $request->cvc,
                //     ],
                // ]);
                // dd($token);
                // dd(env('STRIPE_SECRET'));
                // dd($order_update->total + $shipping_charge);
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $data = Stripe\Charge::create([
                    "amount" => ($order_update->total + $shipping_charge) * 100,
                    "currency" => "gbp",
                    "source" => $request->stripeToken,
                    "description" => "This order payment"
                ]);
        }
        $cart_empty = Cart::where('user_id',Auth()->user()->id)->delete();
        $notification = array(
            'message' => 'Order Placed Successfully',
            'alert-type' => 'success'
        );
        return redirect('/homev1')->with($notification);
    }
    public function Distance($from, $to){
        // Google API key
    $apiKey = 'AIzaSyA6Ry5WzM5kjO4ryPGeoLXL3-lkrAGi0xY';
    $addressFrom = $from;
    $addressTo = $to;
    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);
    
    // Geocoding API request with start address
    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
    $outputFrom = json_decode($geocodeFrom);
    if(!empty($outputFrom->error_message)){
        return $outputFrom->error_message;
    }
    
    // Geocoding API request with end address
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
    $outputTo = json_decode($geocodeTo);
    if(!empty($outputTo->error_message)){
        return $outputTo->error_message;
    }
    
    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
    
    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;
    $distance = round($miles * 1.609344, 2);
   return $distance;
    }
}

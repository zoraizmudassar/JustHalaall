<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Deal;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cartSum = 0;
        $cartData = Cart::where('user_id',Auth()->user()->id)->get();
        $totalItem  = Cart::where('user_id',Auth()->user()->id)->sum('quantity');
        foreach($cartData as $item){
            $cartSum += $item->unit_price * $item->quantity;
        }
        return view('web/cart',compact('cartData','totalItem','cartSum'));
    }

    public function indexv1(){
        $cartSum = 0;
        $cartData = Cart::where('user_id',Auth()->user()->id)->get();
        $totalItem  = Cart::where('user_id',Auth()->user()->id)->sum('quantity');
        foreach($cartData as $item){
            $cartSum += $item->unit_price * $item->quantity;
        }
        return view('website.cart',compact('cartData','totalItem','cartSum'));
    }

    public function store(Request $request){
        $check = Cart::where('user_id',Auth()->user()->id)->where('product_id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if(isset($check)){
            $check->quantity = $check->quantity+1;
            $check->update();
            return back();
        }else{
            $cart = new Cart;
            $cart->user_id = Auth()->user()->id;
            $cart->restaurant_id = $product->restaurant_id;
            $cart->product_id = $request->product_id;
            $cart->unit_price = $product->price;
            $cart->quantity = 1;
            $cart->status = 'pending';
            $cart->save();
            return response();
        }
    }

    public function storev11(Request $request){
        $restaurant = Restaurant::where('status', 'approved')->get();
        $restaurantData = [];
        foreach($restaurant as $data){
            $timer = 1;
            $current_time = new \DateTime(); // Specify the global namespace
            $current_time_str = $current_time->format("H:i");
            $start_time = \DateTime::createFromFormat("H:i", $data->start_time);
            $end_time = \DateTime::createFromFormat("H:i", $data->end_time);
            if ($current_time >= $start_time && $current_time <= $end_time) {
                $timer = 1;
            } else {
                $timer = 0;
            }
            $restaurant_lat = $data->latitude;
            $restaurant_lng = $data->longitude;
            $user_lat = $request->latitude_val;
            $user_lng = $request->longitude_val;
            $earthRadius = 6371;

            // Convert latitude and longitude from degrees to radians
            $lat1 = deg2rad($restaurant_lat);
            $lon1 = deg2rad($restaurant_lng);
            $lat2 = deg2rad($user_lat);
            $lon2 = deg2rad($user_lng);

            // Haversine formula
            $dlat = $lat2 - $lat1;
            $dlon = $lon2 - $lon1;

            $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            // Calculate the distance
            $distance = $earthRadius * $c;
            $m = 0.621371;
            $miles = $distance * $m;
            // $roundedNumber = round($distance, 1);
            $roundedNumber = round($miles, 1);
            $restaurantData[] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'address' => $data['address'],
                'logo' => $data['logo'],
                'timer' => $timer,
                'distance' => $roundedNumber,
            ];
        }
        $filteredRestaurantData = array_filter($restaurantData, function ($item) {
            return $item['distance'] < 10;
        });
        $newArray = [];
        foreach ($restaurantData as $item) {
            $newArray[] = $item;
        }
        usort($newArray, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });
        return response()->json(['status' => 200, 'data' => $newArray]);
    }

    public function storev1(Request $request){
        $check = Cart::where('user_id',Auth()->user()->id)->where('product_id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if(isset($check)){
            $check->quantity = $check->quantity+1;
            $check->update();
            return back();
        }else{
            $cart = new Cart;
            $cart->user_id = Auth()->user()->id;
            $cart->restaurant_id = $product->restaurant_id;
            $cart->product_id = $request->product_id;
            $cart->unit_price = $product->price;
            $cart->quantity = 1;
            $cart->status = 'pending';
            $cart->save();
            return back();
        }
    }

    public function removeCart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }

    public function removeCartv1($id){
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function details($id)
    {
        $restaurantProducts=Product::where('status','approved')->where('restaurant_id',$id)->get();
        $restaurantDetail=Restaurant::select('name','aboutUs')->where('id',$id)->get();

        return view('web.restaurant-detail',compact('restaurantProducts', 'restaurantDetail'));
    }

    public function detailsv1($id)
    {
        $timer = 1;
        $restaurantProducts = Product::where('status','approved')->where('restaurant_id',$id)->with('category')->get();
        $restaurantDetail = Restaurant::select('name','aboutUs','start_time','end_time')->where('id',$id)->get();

        // Get the current time
        $current_time = new \DateTime(); // Specify the global namespace
        $current_time_str = $current_time->format("H:i");

        $end_timer = $restaurantDetail[0]->end_time;

        // Create DateTime objects for start and end times
        $start_time = \DateTime::createFromFormat("H:i", $restaurantDetail[0]->start_time);
        $end_time = \DateTime::createFromFormat("H:i", $restaurantDetail[0]->end_time);

        // Compare current time with start and end times
        if ($current_time >= $start_time && $current_time <= $end_time) {
            $timer = 1;
        } else {
            $timer = 0;
        }
        return view('website.restaurantDetail',compact('restaurantProducts', 'restaurantDetail', 'timer', 'end_timer'));
    }
}

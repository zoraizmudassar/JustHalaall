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
        $restaurantProducts = Product::where('status','approved')->where('restaurant_id',$id)->get();
        $restaurantDetail = Restaurant::select('name','aboutUs')->where('id',$id)->get();
        return view('website.restaurantDetail',compact('restaurantProducts', 'restaurantDetail'));
    }
}

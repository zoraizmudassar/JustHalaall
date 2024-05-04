<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\API\Restaurant\RestaurantServices;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function editProfile(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->editProfile($request);
  }

    public function getProfile(Request $request,RestaurantServices $restaurantServices)
    {

        return $restaurantServices->getProfile($request);
  }

    public function accountDetails(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->accountDetails($request);
    }

    public function getAccountDetails(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->getAccountDetails($request);
    }
}
